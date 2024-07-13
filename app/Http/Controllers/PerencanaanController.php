<?php

namespace App\Http\Controllers;

use App\Models\Perencanaan;
use App\Models\Permohonan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class PerencanaanController extends Controller
{
    public function index()
    {
        return view('perencanaan.index');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = Permohonan::select('permohonan.*', 'mst_ruang_lingkup.nomor_standar', 'mst_ruang_lingkup.judul_standar', 'mst_tujuan_audit.nama_tujuan_audit', 'mst_proses_lain.nama_proses', 'mst_klien.id_perusahaan', 'mst_klien.jenis_badan_usaha', 'mst_klien.nama_perusahaan', 'mst_sertifikat.no_sertifikat', 'mst_skema_sertifikasi.nama_skema_sertifikasi')
                ->leftJoin('mst_ruang_lingkup', 'permohonan.id_standar', '=', 'mst_ruang_lingkup.id')
                ->leftJoin('mst_tujuan_audit', 'permohonan.tujuan_audit', '=', 'mst_tujuan_audit.id')
                ->leftJoin('mst_proses_lain', 'permohonan.proses_lain', '=', 'mst_proses_lain.id')
                ->leftJoin('mst_klien', 'permohonan.id_perusahaan', '=', 'mst_klien.id_perusahaan')
                ->leftJoin('mst_sertifikat', 'permohonan.no_sertifikat_referensi', '=', 'mst_sertifikat.id')
                ->leftJoin('mst_skema_sertifikasi', 'permohonan.menu', '=', 'mst_skema_sertifikasi.kode_skema_sertifikasi')
                ->whereNotNull('permohonan.id_perencanaan')
                ->where('permohonan.sts', '=', 8)
                ->get()
                ->map(function ($item) {
                    $item->full_nama_perusahaan = "{$item->id_perusahaan} {$item->jenis_badan_usaha} {$item->nama_perusahaan}";
                    return $item;
                });

            return Datatables::of($data)
                ->addColumn('action', function ($row) {
                    $editRoute = route('perencanaan.edit', ['perencanaan' => $row->id_perencanaan]);
                    $deleteRoute = route('perencanaan.destroy', ['perencanaan' => $row->id_perencanaan]);

                    $btn = '<div class="btn-group"><a href="' . $editRoute . '" class="btn btn-warning"><i class="fas fa-edit"></i></a>';
                    $btn .= '<form method="POST" action="' . $deleteRoute . '" style="display: inline-block; margin-left: 10px;" onsubmit="return confirm(\'Apakah anda yakin?\')">';
                    $btn .= '<button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>';
                    $btn .= csrf_field(); // Blade directive for CSRF token
                    $btn .= method_field("DELETE"); // Blade directive for HTTP method spoofing
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
        if ($column == 'full_nama_perusahaan') {
            $query = Permohonan::select('mst_klien.id_perusahaan', 'mst_klien.jenis_badan_usaha', 'mst_klien.nama_perusahaan')
                ->leftJoin('mst_ruang_lingkup', 'permohonan.id_standar', '=', 'mst_ruang_lingkup.id')
                ->leftJoin('mst_tujuan_audit', 'permohonan.tujuan_audit', '=', 'mst_tujuan_audit.id')
                ->leftJoin('mst_proses_lain', 'permohonan.proses_lain', '=', 'mst_proses_lain.id')
                ->leftJoin('mst_klien', 'permohonan.id_perusahaan', '=', 'mst_klien.id_perusahaan')
                ->leftJoin('mst_sertifikat', 'permohonan.no_sertifikat_referensi', '=', 'mst_sertifikat.id')
                ->leftJoin('mst_skema_sertifikasi', 'permohonan.menu', '=', 'mst_skema_sertifikasi.kode_skema_sertifikasi')
                ->whereNotNull('permohonan.id_perencanaan')
                ->where('permohonan.sts', '=', 8);

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

            $uniqueValues = $query->distinct()->get()->map(function ($item) {
                return "{$item->id_perusahaan} {$item->jenis_badan_usaha} {$item->nama_perusahaan}";
            })->unique()->values();

            return response()->json($uniqueValues);
        } else {

            // Periksa dan tambahkan alias jika kolom yang diminta ambigu
            $column = $this->qualifyColumn($column);

            $query = Permohonan::select($column)->distinct()
                ->leftJoin('mst_ruang_lingkup', 'permohonan.id_standar', '=', 'mst_ruang_lingkup.id')
                ->leftJoin('mst_tujuan_audit', 'permohonan.tujuan_audit', '=', 'mst_tujuan_audit.id')
                ->leftJoin('mst_proses_lain', 'permohonan.proses_lain', '=', 'mst_proses_lain.id')
                ->leftJoin('mst_klien', 'permohonan.id_perusahaan', '=', 'mst_klien.id_perusahaan')
                ->leftJoin('mst_sertifikat', 'permohonan.no_sertifikat_referensi', '=', 'mst_sertifikat.id')
                ->leftJoin('mst_skema_sertifikasi', 'permohonan.menu', '=', 'mst_skema_sertifikasi.kode_skema_sertifikasi')
                ->whereNotNull('permohonan.id_perencanaan')
                ->where('permohonan.sts', '=', 8);

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

        $klien = Permohonan::select('mst_klien.id_perusahaan', 'mst_klien.nama_perusahaan', 'mst_klien.jenis_badan_usaha', 'mst_klien.id')
            ->join('mst_klien', 'permohonan.id_perusahaan', '=', 'mst_klien.id_perusahaan')
            ->where('permohonan.sts', '=', 2)
            ->groupBy('mst_klien.id_perusahaan', 'mst_klien.nama_perusahaan', 'mst_klien.jenis_badan_usaha', 'mst_klien.id')
            ->get();
        return view('perencanaan.create', compact('klien'));
    }

    public function edit($id)
    {
        $data = Perencanaan::findOrFail($id);
        $klien = Permohonan::select('mst_klien.id_perusahaan', 'mst_klien.nama_perusahaan', 'mst_klien.jenis_badan_usaha', 'mst_klien.id', 'mst_klien.provinsi_pabrik', 'mst_klien.jumlah_tahapan_proses', 'mst_klien.line_produksi', 'mst_klien.jumlah_shift_per_hari', 'mst_klien.jml_kerja_per_hari', 'mst_klien.kapasitas_produksi_per_hari', 'mst_klien.jml_kary_produksi')
            ->join('mst_klien', 'permohonan.id_perusahaan', '=', 'mst_klien.id_perusahaan')
            ->where('permohonan.id_perencanaan', '=', $id)
            ->groupBy('mst_klien.id_perusahaan', 'mst_klien.nama_perusahaan', 'mst_klien.jenis_badan_usaha', 'mst_klien.id')
            ->first();

        $permohonanPerusahaan = Permohonan::select('permohonan.*', 'mst_ruang_lingkup.nomor_standar', 'mst_ruang_lingkup.judul_standar', 'mst_tujuan_audit.nama_tujuan_audit', 'mst_sertifikat.no_sertifikat', 'mst_skema_sertifikasi.nama_skema_sertifikasi')
            ->leftJoin('mst_ruang_lingkup', 'permohonan.id_standar', '=', 'mst_ruang_lingkup.id')
            ->leftJoin('mst_tujuan_audit', 'permohonan.tujuan_audit', '=', 'mst_tujuan_audit.id')
            ->leftJoin('mst_sertifikat', 'permohonan.no_sertifikat_referensi', '=', 'mst_sertifikat.id')
            ->leftJoin('mst_skema_sertifikasi', 'mst_sertifikat.menu', '=', 'mst_skema_sertifikasi.id')
            ->where('permohonan.id_perusahaan', '=', $klien['id_perusahaan'])
            ->whereNull('no_proses')
            ->get(); // Adjust this query as needed

        $permohonan = Permohonan::select('permohonan.*', 'mst_ruang_lingkup.nomor_standar', 'mst_ruang_lingkup.judul_standar', 'mst_tujuan_audit.nama_tujuan_audit', 'mst_sertifikat.no_sertifikat', 'mst_skema_sertifikasi.nama_skema_sertifikasi')
            ->leftJoin('mst_ruang_lingkup', 'permohonan.id_standar', '=', 'mst_ruang_lingkup.id')
            ->leftJoin('mst_tujuan_audit', 'permohonan.tujuan_audit', '=', 'mst_tujuan_audit.id')
            ->leftJoin('mst_sertifikat', 'permohonan.no_sertifikat_referensi', '=', 'mst_sertifikat.id')
            ->leftJoin('mst_skema_sertifikasi', 'mst_sertifikat.menu', '=', 'mst_skema_sertifikasi.id')
            ->where('permohonan.id_perencanaan', '=', $id)
            ->get(); // Adjust this query as needed
        return view('perencanaan.edit', compact('klien', 'data', 'permohonanPerusahaan', 'permohonan'));
    }

    public function store(Request $request)
    {
        if ($request->no_proses_baru) {
            $no_proses = $request->no_proses_baru;
        } else {
            $no_proses = $request->no_proses;
        }
        $storeData = [

            'id_perusahaan' => $request->input('id_perusahaan'),
            'no_proses' => $no_proses,
            'jml_auditor_kepala' => $request->input('jml_auditor_kepala'),
            'hari_kerja_auditor_kepala' => $request->input('hari_kerja_auditor_kepala'),
            'jumlah_perdiem_auditor_kepala' => $request->input('jumlah_perdiem_auditor_kepala'),
            'jumlah_auditor' => $request->input('jumlah_auditor'),
            'hari_kerja_auditor' => $request->input('hari_kerja_auditor'),
            'hari_perdiem_auditor' => $request->input('hari_perdiem_auditor'),
            'jumlah_mandays_auditor' => $request->input('jumlah_mandays_auditor'),
            'jumlah_tenaga_ahli' => $request->input('jumlah_tenaga_ahli'),
            'jumlah_mandays_tenaga_ahli' => $request->input('jumlah_mandays_tenaga_ahli'),
            'jumlah_observer' => $request->input('jumlah_observer'),
            'jumlah_mandays_observer' => $request->input('jumlah_mandays_observer'),
            'jumlah_ppc' => $request->input('jumlah_ppc'),
            'jumlah_mandays_ppc' => $request->input('jumlah_mandays_ppc'),
            'jumlah_perdiem' => $request->input('jumlah_perdiem'),
            'jumlah_perdiem_personel' => $request->input('jumlah_perdiem_personel'),
            'jumlah_sni' => $request->input('jumlah_sni'),
            'jumlah_sertifikat' => $request->input('jumlah_sertifikat'),
            'id_user' => Session::get('id_user'),

        ];
        $perencanaan = Perencanaan::create($storeData);
        $idPerencanaan = $perencanaan->id;
        if ($no_proses) {
            if (isset($request->pilihNoProses)) {
                foreach ($request->pilihNoProses as $id_permohonan) {
                    $dataPermohonan = [
                        'no_proses' => $no_proses,
                        'sts_permohonan' => 'Perencanaan',
                        'sts' => 8,
                        'id_perencanaan' => $idPerencanaan
                    ];
                    Permohonan::where('id', $id_permohonan)->update($dataPermohonan);
                }
            }
        }


        return redirect('perencanaan')->with('alert-success', 'Success Tambah Data');
    }

    public function update(Request $request, $id)
    {

        $updateData = [
            'id_perusahaan' => $request->input('id_perusahaan'),
            'no_proses' => $request->input('no_proses'),
            'jml_auditor_kepala' => $request->input('jml_auditor_kepala'),
            'hari_kerja_auditor_kepala' => $request->input('hari_kerja_auditor_kepala'),
            'jumlah_perdiem_auditor_kepala' => $request->input('jumlah_perdiem_auditor_kepala'),
            'jumlah_auditor' => $request->input('jumlah_auditor'),
            'hari_kerja_auditor' => $request->input('hari_kerja_auditor'),
            'hari_perdiem_auditor' => $request->input('hari_perdiem_auditor'),
            'jumlah_mandays_auditor' => $request->input('jumlah_mandays_auditor'),
            'jumlah_tenaga_ahli' => $request->input('jumlah_tenaga_ahli'),
            'jumlah_mandays_tenaga_ahli' => $request->input('jumlah_mandays_tenaga_ahli'),
            'jumlah_observer' => $request->input('jumlah_observer'),
            'jumlah_mandays_observer' => $request->input('jumlah_mandays_observer'),
            'jumlah_ppc' => $request->input('jumlah_ppc'),
            'jumlah_mandays_ppc' => $request->input('jumlah_mandays_ppc'),
            'jumlah_perdiem' => $request->input('jumlah_perdiem'),
            'jumlah_perdiem_personel' => $request->input('jumlah_perdiem_personel'),
            'jumlah_sni' => $request->input('jumlah_sni'),
            'jumlah_sertifikat' => $request->input('jumlah_sertifikat'),
            'id_user_update' => Session::get('id_user'),
        ];
        Perencanaan::where('id', $id)->update($updateData);

        $data = Permohonan::where('id_perencanaan', $id)->get();
        foreach ($data as $key) {
            $dataPermohonanBatal = [
                'no_proses' => null,
                'sts_permohonan' => 'Diproses',
                'sts' => 2,
                'id_perencanaan' => null
            ];
            //dd($key['id_permohonan']);
            //dd($dataPermohonanBatal);
            Permohonan::where('id', $key['id'])->update($dataPermohonanBatal);
        }
        if (isset($request->pilihNoProses)) {
            foreach ($request->pilihNoProses as $id_permohonan) {
                $dataPermohonan = [
                    'no_proses' => $request->input('no_proses'),
                    'sts_permohonan' => 'Perencanaan',
                    'sts' => 8,
                    'id_perencanaan' => $id
                ];
                Permohonan::where('id', $id_permohonan)->update($dataPermohonan);
            }
        }


        return redirect('perencanaan')->with('alert-success', 'Success Update Data');
    }

    public function destroy($id)
    {
        Perencanaan::findOrFail($id)->delete();
        $data = Permohonan::where('id_perencanaan', $id)->get();
        foreach ($data as $key) {
            $dataPermohonanBatal = [
                'no_proses' => null,
                'sts_permohonan' => 'Diproses',
                'sts' => 2,
                'id_perencanaan' => null
            ];
            //dd($key['id_permohonan']);
            //dd($dataPermohonanBatal);
            Permohonan::where('id', $key['id'])->update($dataPermohonanBatal);
        }
        return redirect('perencanaan')->with('alert-success', 'Success deleted data');
    }
}
