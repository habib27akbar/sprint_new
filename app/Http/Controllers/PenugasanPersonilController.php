<?php

namespace App\Http\Controllers;

use App\Models\MstPejabat;
use App\Models\PenugasanPersonil;
use App\Models\Permohonan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PenugasanPersonilController extends Controller
{
    public function index()
    {
        return view('tinjauan_permohonan.penugasan_personil.index');
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
                ->where('permohonan.sts', '>=', 8)
                ->get()
                ->map(function ($item) {
                    $item->full_nama_perusahaan = "{$item->jenis_badan_usaha} {$item->nama_perusahaan}";
                    $item->tanggal_order = $item->tanggal_order ? \Carbon\Carbon::parse($item->tanggal_order)->format('d/m/Y') : null;
                    if ($item->sts_permohonan == 'Perencanaan') {
                        $item->sts_permohonan = 'Dilanjutkan';
                    }
                    return $item;
                });

            return Datatables::of($data)
                ->addColumn('action', function ($row) {
                    $editRoute = route('penugasan_personil.edit', ['penugasan_personil' => $row->id]);
                    $deleteRoute = route('penugasan_personil.destroy', ['penugasan_personil' => $row->id]);

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
                return "{$item->jenis_badan_usaha} {$item->nama_perusahaan}";
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
                ->where('permohonan.sts', '>=', 8);

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
                if (isset($result->tanggal_order)) {
                    $result->tanggal_order = Carbon::parse($result->tanggal_order)->format('d/m/Y');
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

    public function edit($id)
    {

        $klien = Permohonan::select('permohonan.id AS id_permohonan', 'permohonan.id_penugasan_personil', 'mst_klien.id_perusahaan', 'mst_klien.nama_perusahaan', 'mst_klien.jenis_badan_usaha', 'mst_klien.id', 'mst_klien.provinsi_pabrik', 'mst_klien.jumlah_tahapan_proses', 'mst_klien.line_produksi', 'mst_klien.jumlah_shift_per_hari', 'mst_klien.jml_kerja_per_hari', 'mst_klien.kapasitas_produksi_per_hari', 'mst_klien.jml_kary_produksi')
            ->join('mst_klien', 'permohonan.id_perusahaan', '=', 'mst_klien.id_perusahaan')
            ->where('permohonan.id', '=', $id)
            ->first();

        $data_penugasan = PenugasanPersonil::where('id', $klien->id_penugasan_personil)->get();
        if ($data_penugasan->isEmpty()) {
            $data_penugasan = null;
        }
        //dd($data_penugasan);
        // DB::enableQueryLog();

        // // Get the SQL query and bindings
        // $query = Permohonan::select('permohonan.id AS id_permohonan', 'mst_klien.id_perusahaan', 'mst_klien.nama_perusahaan', 'mst_klien.jenis_badan_usaha', 'mst_klien.id', 'mst_klien.provinsi_pabrik', 'mst_klien.jumlah_tahapan_proses', 'mst_klien.line_produksi', 'mst_klien.jumlah_shift_per_hari', 'mst_klien.jml_kerja_per_hari', 'mst_klien.kapasitas_produksi_per_hari', 'mst_klien.jml_kary_produksi')
        //     ->join('mst_klien', 'permohonan.id_perusahaan', '=', 'mst_klien.id_perusahaan')
        //     ->where('permohonan.id', '=', $id);

        // $sql = $query->toSql();
        // $bindings = $query->getBindings();

        // // Get the executed query log
        // $queryLog = DB::getQueryLog();

        // // Display the results
        // dd($sql, $bindings, $queryLog);

        // $sql = $query->toSql();
        // $bindings = $query->getBindings();

        // dd(
        //     $sql,
        //     $bindings
        // );


        $permohonan = Permohonan::select('permohonan.*', 'mst_ruang_lingkup.nomor_standar', 'mst_ruang_lingkup.judul_standar', 'mst_tujuan_audit.nama_tujuan_audit', 'mst_sertifikat.no_sertifikat', 'mst_skema_sertifikasi.nama_skema_sertifikasi', 'mst_proses_lain.nama_proses')
            ->leftJoin('mst_ruang_lingkup', 'permohonan.id_standar', '=', 'mst_ruang_lingkup.id')
            ->leftJoin('mst_tujuan_audit', 'permohonan.tujuan_audit', '=', 'mst_tujuan_audit.id')
            ->leftJoin('mst_proses_lain', 'permohonan.proses_lain', '=', 'mst_proses_lain.id')
            ->leftJoin('mst_sertifikat', 'permohonan.no_sertifikat_referensi', '=', 'mst_sertifikat.id')
            ->leftJoin('mst_skema_sertifikasi', 'mst_sertifikat.menu', '=', 'mst_skema_sertifikasi.id')
            ->whereIn('permohonan.sts', [8, 9])
            ->get(); // Adjust this query as needed

        $pejabat = MstPejabat::where('status', 'Aktif')->where('jabatan', 'like', '%Ketua Tim%')->get();

        return view('tinjauan_permohonan.penugasan_personil.edit', compact('klien', 'permohonan', 'pejabat', 'data_penugasan'));
    }

    public function update(Request $request, $id)
    {
        $permohonan = Permohonan::where('id', '=', $id)
            ->first(); // Adjust this query as needed
        //dd($permohonan);
        $id_penugasan_personil = null;
        if (!empty($permohonan['id_penugasan_personil'])) {
            $id_penugasan_personil = $permohonan['id_penugasan_personil'];
        }
        $id_perusahaan = $permohonan['id_perusahaan'];
        if ($id_penugasan_personil) {
            $updateData = [
                'id_perusahaan' => $id_perusahaan,
                'id_personil' => $request->input('id_personil'),
                'pemeriksaan_kelengkapan_kebenaran_dokumen' => $request->input('pemeriksaan_kelengkapan_kebenaran_dokumen'),
                'pemeriksaan_kebenaran_persyaratan' => $request->input('pemeriksaan_kebenaran_persyaratan'),
                'kajian_permohonan' => $request->input('kajian_permohonan'),
                'audit' => $request->input('audit'),
                'no_disposisi' => $request->input('no_disposisi'),
                'tgl_disposisi' => $request->input('tgl_disposisi'),
                'id_pejabat' => $request->input('id_pejabat'),
                'id_user_update' => Session::get('id_user'),
                'status' => 1,
            ];
            PenugasanPersonil::where('id', $id_penugasan_personil)->update($updateData);
        } else {
            $storeData = [
                'id_perusahaan' => $id_perusahaan,
                'id_personil' => $request->input('id_personil'),
                'pemeriksaan_kelengkapan_kebenaran_dokumen' => $request->input('pemeriksaan_kelengkapan_kebenaran_dokumen'),
                'pemeriksaan_kebenaran_persyaratan' => $request->input('pemeriksaan_kebenaran_persyaratan'),
                'kajian_permohonan' => $request->input('kajian_permohonan'),
                'audit' => $request->input('audit'),
                'no_disposisi' => $request->input('no_disposisi'),
                'tgl_disposisi' => $request->input('tgl_disposisi'),
                'id_pejabat' => $request->input('id_pejabat'),
                'id_user' => Session::get('id_user'),
                'status' => 1,
            ];
            PenugasanPersonil::create($storeData);
            $penugasan_personil = PenugasanPersonil::create($storeData);
            // Mendapatkan ID dari entri yang baru saja dibuat
            $id_penugasan_personil = $penugasan_personil->id;

            foreach ($request->input('pilihPermohonan') as $permohonan) {
                $updateData = [
                    'id_penugasan_personil' => $id_penugasan_personil,
                    'sts' => 9,
                    'sts_permohonan' => 'Penugasan Personil',
                ];
                Permohonan::where('id', $permohonan)->update($updateData);
            }
        }



        return redirect('penugasan_personil/' . $id . '/edit')->with('alert-success', 'Success Update Data');

        // return redirect()->route('penugasan_personil.edit', ['id' => $id])
        //     ->with('alert-success', 'Success Tambah Data');
    }
}
