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

class PermohonanController extends Controller
{
    public function index()
    {
        return view('permohonan.index');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = Permohonan::select('permohonan.*', 'mst_ruang_lingkup.nomor_standar', 'mst_ruang_lingkup.judul_standar', 'mst_tujuan_audit.nama_tujuan_audit', 'mst_proses_lain.nama_proses')
                ->leftJoin('mst_ruang_lingkup', 'permohonan.id_standar', '=', 'mst_ruang_lingkup.id')
                ->leftJoin('mst_tujuan_audit', 'permohonan.tujuan_audit', '=', 'mst_tujuan_audit.id')
                ->leftJoin('mst_proses_lain', 'permohonan.proses_lain', '=', 'mst_proses_lain.id')
                ->get();
            return Datatables::of($data)
                ->addColumn('action', function ($row) {
                    $editRoute = route('permohonan.edit', ['permohonan' => $row->id]);
                    $deleteRoute = route('permohonan.destroy', ['permohonan' => $row->id]);

                    $btn = '<a href="' . $editRoute . '" class="btn btn-warning"><i class="fas fa-edit"></i></a>';
                    $btn .= '<form method="POST" action="' . $deleteRoute . '" style="display: inline-block; margin-left: 10px;" onsubmit="return confirm(\'Apakah anda yakin?\')">';
                    $btn .= '<button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>';
                    $btn .= csrf_field(); // Blade directive for CSRF token
                    $btn .= method_field("DELETE"); // Blade directive for HTTP method spoofing
                    $btn .= '</form>';

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
            ->leftJoin('mst_proses_lain', 'permohonan.proses_lain', '=', 'mst_proses_lain.id');

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
        return view('permohonan.create', compact('skema', 'tujuan_audit', 'proses_lain', 'mst_sertifikat', 'ruang_lingkup', 'klien'));
    }

    public function store(Request $request)
    {
        $dir = 'doc/klien';

        $nama_surat_permohonan = null;
        if ($request->file('surat_permohonan')) {
            $surat_permohonan = $request->file('surat_permohonan');
            $nama_surat_permohonan = 'sp-' . uniqid() . '-' . $surat_permohonan->getClientOriginalName();
            $surat_permohonan->move(public_path($dir), $nama_surat_permohonan);
        }

        $nama_formulir_pendaftaran = null;
        if ($request->file('formulir_pendaftaran')) {
            $formulir_pendaftaran = $request->file('formulir_pendaftaran');
            $nama_formulir_pendaftaran = 'sp-' . uniqid() . '-' . $formulir_pendaftaran->getClientOriginalName();
            $formulir_pendaftaran->move(public_path($dir), $nama_formulir_pendaftaran);
        }

        $nama_illustrasi_penandaan_standar = null;
        if ($request->file('illustrasi_penandaan_standar')) {
            $illustrasi_penandaan_standar = $request->file('illustrasi_penandaan_standar');
            $nama_illustrasi_penandaan_standar = 'sp-' . uniqid() . '-' . $illustrasi_penandaan_standar->getClientOriginalName();
            $illustrasi_penandaan_standar->move(public_path($dir), $nama_illustrasi_penandaan_standar);
        }

        $storeData = [
            'id_perusahaan' => Session::get('id_perusahaan'),
            'surat_permohonan' => $nama_surat_permohonan,
            'formulir_pendaftaran' => $nama_formulir_pendaftaran,
            'no_surat_permohonan' => $request->input('no_surat_permohonan'),
            'tgl_surat_permohonan' => $request->input('tgl_surat_permohonan'),
            'menu' => $request->input('menu'),
            'tujuan_audit' => $request->input('tujuan_audit'),
            'proses_lain' => $request->input('proses_lain'),
            'no_sertifikat_referensi' => $request->input('no_sertifikat_referensi'),
            'masa_berlaku' => $request->input('masa_berlaku'),
            'masa_berlaku_akhir' => $request->input('masa_berlaku_akhir'),
            'id_standar' => $request->input('id_standar'),
            'status_komoditi' => $request->input('status_komoditi'),
            'illustrasi_penandaan_standar' => $nama_illustrasi_penandaan_standar,
            'status_penerapan_smm' => $request->input('status_penerapan_smm'),
            'akreditasi_lssm' => $request->input('akreditasi_lssm'),
            'keterangan' => $request->input('keterangan'),
            'sts_permohonan' => $request->input('status'),
        ];
        $permohonan = Permohonan::create($storeData);
        // Mendapatkan ID dari entri yang baru saja dibuat
        $idPermohonan = $permohonan->id;

        if (isset($_POST['data_post'])) {
            $fieldNames = array("merek", "illustrasi_merek", "no_pendaftaran", "tgl_pendaftaran", "dokumen_pendaftaran_merek", "no_permohonan_merek", "tgl_penerimaan", "tgl_dimulai_perlindungan", "tgl_berakhir_perlindungan", "sertifikat_merek", "status_pemilik_merek", "alamat", "pelimpahan_merek", "tgl_berakhir_pelimpahan_merek", "dokumen_pelimpahan_merek");
            for ($i = 0; $i < count($_POST['data_post'][$fieldNames[0]]); $i++) {
                if (!empty($_POST['data_post']['merek'][$i])) {
                    $nama_dokumen_pendaftaran_merek = null;
                    if ($request->file('data_post')['dokumen_pendaftaran_merek'][$i]) {
                        $dokumen_pendaftaran_merek = $request->file('data_post')['dokumen_pendaftaran_merek'][$i];
                        $nama_dokumen_pendaftaran_merek = 'dpm-' . uniqid() . '-' . $dokumen_pendaftaran_merek->getClientOriginalName();
                        $dokumen_pendaftaran_merek->move(public_path($dir), $nama_dokumen_pendaftaran_merek);
                    }

                    $nama_dokumen_pelimpahan_merek = null;
                    if ($request->file('data_post')['dokumen_pendaftaran_merek'][$i]) {
                        $dokumen_pelimpahan_merek = $request->file('data_post')['dokumen_pelimpahan_merek'][$i];
                        $nama_dokumen_pelimpahan_merek = 'pm-' . uniqid() . '-' . $dokumen_pelimpahan_merek->getClientOriginalName();
                        $dokumen_pelimpahan_merek->move(public_path($dir), $nama_dokumen_pelimpahan_merek);
                    }

                    $store = [
                        'id_permohonan' => $idPermohonan,
                        'id_perusahaan' => Session::get('id_perusahaan'),
                        'merek' => $_POST['data_post']['merek'][$i],
                        'illustrasi_merek' => $_POST['data_post']['illustrasi_merek'][$i],
                        'no_pendaftaran' => $_POST['data_post']['no_pendaftaran'][$i],
                        'tgl_pendaftaran' => $_POST['data_post']['tgl_pendaftaran'][$i],
                        'dokumen_pendaftaran_merek' => $nama_dokumen_pendaftaran_merek,
                        'no_permohonan_merek' => $_POST['data_post']['no_permohonan_merek'][$i],
                        'tgl_penerimaan' => $_POST['data_post']['tgl_penerimaan'][$i],
                        'tgl_dimulai_perlindungan' => $_POST['data_post']['tgl_dimulai_perlindungan'][$i],
                        'tgl_berakhir_perlindungan' => $_POST['data_post']['tgl_berakhir_perlindungan'][$i],
                        'sertifikat_merek' => $_POST['data_post']['sertifikat_merek'][$i],
                        'status_pemilik_merek' => $_POST['data_post']['status_pemilik_merek'][$i],
                        'alamat' => $_POST['data_post']['alamat'][$i],
                        'pelimpahan_merek' => $_POST['data_post']['pelimpahan_merek'][$i],
                        'tgl_berakhir_pelimpahan_merek' => $_POST['data_post']['tgl_berakhir_pelimpahan_merek'][$i],
                        'dokumen_pelimpahan_merek' => $nama_dokumen_pelimpahan_merek,
                    ];

                    DataMerek::create($store);
                }
            }
        }

        if (isset($_POST['post_merek'])) {
            $fieldNames = array("merek", "tipe", "foto");
            for ($i = 0; $i < count($_POST['post_merek'][$fieldNames[0]]); $i++) {
                if (!empty($_POST['post_merek']['merek'][$i])) {
                    $nama_foto = null;
                    if ($request->file('post_merek')['foto'][$i]) {
                        $foto = $request->file('post_merek')['foto'][$i];
                        $nama_foto = 'f-' . uniqid() . '-' . $foto->getClientOriginalName();
                        $foto->move(public_path($dir), $nama_foto);
                    }



                    $store = [
                        'id_permohonan' => $idPermohonan,
                        'id_perusahaan' => Session::get('id_perusahaan'),
                        'merek' => $_POST['post_merek']['merek'][$i],
                        'tipe' => $_POST['post_merek']['tipe'][$i],
                        'foto' => $nama_foto
                    ];

                    DataTipe::create($store);
                }
            }
        }

        if (isset($_POST['post_file'])) {
            $fieldNames = array("nama_file", "file");
            for ($i = 0; $i < count($_POST['post_file'][$fieldNames[0]]); $i++) {

                $nama_foto = null;
                if ($request->file('post_file')['foto'][$i]) {
                    $foto = $request->file('post_file')['foto'][$i];
                    $nama_foto = 'f-' . uniqid() . '-' . $foto->getClientOriginalName();
                    $foto->move(public_path($dir), $nama_foto);
                }


                $store = [
                    'id_permohonan' => $idPermohonan,
                    'id_perusahaan' => Session::get('id_perusahaan'),
                    'nama_file' => $_POST['post_merek']['nama_file'][$i],
                    'tipe' => 1,
                    'foto' => $nama_foto
                ];

                DataFile::create($store);
            }
        }

        return redirect('permohonan')->with('alert-success', 'Success Tambah Data');
    }
}
