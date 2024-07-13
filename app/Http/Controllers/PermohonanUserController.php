<?php

namespace App\Http\Controllers;

use App\Models\Klien;
use App\Models\DataFile;
use App\Models\DataTipe;
use App\Models\DataMerek;
use App\Models\Permohonan;
use App\Models\ProsesLain;
use App\Models\TujuanAudit;
use App\Models\RuangLingkup;
use Illuminate\Http\Request;
use App\Models\SkemaSertifikasi;
use App\Models\SertifikatReferensi;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class PermohonanUserController extends Controller
{
    public function index()
    {
        return view('permohonan_user.index');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = Permohonan::select('permohonan.*', 'mst_ruang_lingkup.nomor_standar', 'mst_ruang_lingkup.judul_standar', 'mst_tujuan_audit.nama_tujuan_audit', 'mst_proses_lain.nama_proses')
                ->leftJoin('mst_ruang_lingkup', 'permohonan.id_standar', '=', 'mst_ruang_lingkup.id')
                ->leftJoin('mst_tujuan_audit', 'permohonan.tujuan_audit', '=', 'mst_tujuan_audit.id')
                ->leftJoin('mst_proses_lain', 'permohonan.proses_lain', '=', 'mst_proses_lain.id')
                ->where('permohonan.sts', '>', 1)
                ->get();

            return Datatables::of($data)
                ->addColumn('action', function ($row) {
                    $editRoute = route('permohonan_user.edit', ['permohonan_user' => $row->id]);
                    $deleteRoute = route('permohonan_user.destroy', ['permohonan_user' => $row->id]);

                    $btn = '<div class="btn-group"><a href="' . $editRoute . '" class="btn btn-warning"><i class="fas fa-edit"></i></a>';
                    //$btn .= '<form method="POST" action="' . $deleteRoute . '" style="display: inline-block; margin-left: 10px;" onsubmit="return confirm(\'Apakah anda yakin?\')">';
                    //$btn .= '<button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>';
                    //$btn .= csrf_field(); // Blade directive for CSRF token
                    //$btn .= method_field("DELETE"); // Blade directive for HTTP method spoofing
                    $btn .= '</div>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function getUniqueValues(Request $request)
    {
        $column = $request->get('column');

        // Periksa dan tambahkan alias jika kolom yang diminta ambigu
        $column = $this->qualifyColumn($column);

        $query = Permohonan::select($column)->distinct()
            ->leftJoin('mst_ruang_lingkup', 'permohonan.id_standar', '=', 'mst_ruang_lingkup.id')
            ->leftJoin('mst_tujuan_audit', 'permohonan.tujuan_audit', '=', 'mst_tujuan_audit.id')
            ->leftJoin('mst_proses_lain', 'permohonan.proses_lain', '=', 'mst_proses_lain.id')
            ->where('permohonan.sts', '>', 1);

        // Apply filters if provided
        if ($request->has('filtered') && $request->get('filtered') == 'true') {
            if ($request->get('filters')) {
                foreach ($request->get('filters') as $key => $value) {
                    if (!empty($value)) {
                        $query->where($key, $value);
                    }
                }
            }
        }

        $results = $query->get();

        // Format date fields if they exist in the results
        foreach ($results as $result) {
            if (isset($result->tgl_surat_permohonan)) {
                $result->tgl_surat_permohonan = Carbon::parse($result->tgl_surat_permohonan)->format('d/m/Y');
            }
            if (isset($result->tanggal_terima)) {
                $result->tanggal_terima = Carbon::parse($result->tanggal_terima)->format('d/m/Y');
            }
            if (isset($result->tanggal_input)) {
                $result->tanggal_input = Carbon::parse($result->tanggal_input)->format('d/m/Y');
            }
        }

        $uniqueValues = $results->pluck($column);
        return response()->json($uniqueValues);
    }

    private function qualifyColumn($column)
    {
        $ambiguousColumns = ['status', 'id']; // Tambahkan nama kolom lain yang mungkin ambigu di sini

        if (in_array($column, $ambiguousColumns)) {
            return 'mst_ruang_lingkup.' . $column;
        }

        return $column;
    }

    public function create()
    {
        $skema = SkemaSertifikasi::where('status', 'Aktif')->get();
        $tujuan_audit = TujuanAudit::where('status', 'Aktif')->get();
        $proses_lain = ProsesLain::where('status', 'Aktif')->get();
        $ruang_lingkup = RuangLingkup::where('status', 'Aktif')->get();
        $mst_sertifikat = SertifikatReferensi::where('id_perusahaan', Session::get('id_perusahaan'))->get();
        $klien = Klien::where('id_perusahaan', Session::get('id_perusahaan'))->get();
        return view('permohonan_user.create', compact('skema', 'tujuan_audit', 'proses_lain', 'mst_sertifikat', 'ruang_lingkup', 'klien'));
    }

    public function edit($id)
    {
        $data = Permohonan::findOrFail($id);
        //dd($data['id_perusahaan']);
        $skema = SkemaSertifikasi::where('status', 'Aktif')->get();
        $tujuan_audit = TujuanAudit::where('status', 'Aktif')->get();
        $proses_lain = ProsesLain::where('status', 'Aktif')->get();
        $ruang_lingkup = RuangLingkup::where('status', 'Aktif')->get();
        $mst_sertifikat = SertifikatReferensi::select('mst_sertifikat.*', 'mst_klien.id_perusahaan', 'mst_klien.jenis_badan_usaha', 'mst_klien.nama_perusahaan', 'mst_ruang_lingkup.nomor_standar', 'mst_ruang_lingkup.judul_standar', 'mst_skema_sertifikasi.nama_skema_sertifikasi', 'mst_produk.nama_produk')
            ->leftJoin('mst_klien', 'mst_sertifikat.id_perusahaan', '=', 'mst_klien.id_perusahaan')
            ->leftJoin('mst_ruang_lingkup', 'mst_sertifikat.id_ruang_lingkup', '=', 'mst_ruang_lingkup.id')
            ->leftJoin('mst_produk', 'mst_ruang_lingkup.id_produk', '=', 'mst_produk.id')
            ->leftJoin('mst_skema_sertifikasi', 'mst_sertifikat.menu', '=', 'mst_skema_sertifikasi.id')
            ->where('mst_sertifikat.id_perusahaan', '=', $data['id_perusahaan'])
            ->get();
        $klien = Klien::where('id_perusahaan', $data['id_perusahaan'])->get();
        $data_merek = DataMerek::where('id_permohonan', $id)->get();
        $data_tipe = DataTipe::where('id_permohonan', $id)->get();
        $data_file = DataFile::where('id_permohonan', $id)->get();
        return view('permohonan_user.edit', compact('skema', 'tujuan_audit', 'proses_lain', 'mst_sertifikat', 'ruang_lingkup', 'klien', 'data', 'data_merek', 'data_tipe', 'data_file'));
    }



    public function update(Request $request, $id)
    {
        $sts_permohonan = '';
        if ($request->input('sts') == 2) {
            $sts_permohonan = 'Diproses';
        } elseif ($request->input('sts') == 3) {
            $sts_permohonan = 'Perlu Perbaikan';
        } elseif ($request->input('sts') == 4) {
            $sts_permohonan = 'Ditolak';
        }

        $updateData = [
            'id_perusahaan' => $request->input('id_perusahaan'),
            'no_surat_permohonan' => $request->input('no_surat_permohonan'),
            'tgl_surat_permohonan' => $request->input('tgl_surat_permohonan'),
            'menu' => $request->input('menu'),
            'tujuan_audit' => $request->input('tujuan_audit'),
            'proses_lain' => $request->input('proses_lain'),
            'no_order' => $request->input('no_order'),
            'tanggal_order' => $request->input('tanggal_order'),
            'tanggal_order' => $request->input('tanggal_order'),
            'tanggal_terima' => $request->input('tanggal_terima'),
            'sts_permohonan' => $sts_permohonan,
            'sts' => $request->input('sts'),
        ];
        //$permohonan = Permohonan::create($storeData);
        Permohonan::where('id', $id)->update($updateData);
        // Mendapatkan ID dari entri yang baru saja dibuat
        $idPermohonan = $id;


        return redirect('permohonan_user')->with('alert-success', 'Success Update Data');
    }
}
