<?php

namespace App\Http\Controllers;

use App\Models\Klien;
use App\Models\Permohonan;
use App\Models\RegistKlien;
use App\Models\RegistStatus;
use App\Models\RuangLingkup;
use App\Models\SertifikatReferensi;
use App\Models\SkemaSertifikasi;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function get_klien(Request $request)
    {
        $klien = Klien::where('id_perusahaan', $request->id_perusahaan)->get();
        $regist = RegistKlien::where('id_perusahaan', $request->id_perusahaan)->get();
        $regist_status = RegistStatus::where('id_pelanggan', $request->id_perusahaan)->get();
        $from_data = '';
        if (count($regist) > 0) {
            $data_klien = $regist;
            $from_data =  'regist';
        } else {
            $data_klien = $klien;
            $from_data = 'klien';
        }
        //echo $klien;
        return response()->json(['status' => true, 'data' => $data_klien, 'data_regist' => $regist_status, 'from_data' => $from_data], 200);
    }

    public function get_klien_list()
    {

        $klien = Klien::select('id', 'id_perusahaan', 'nama_perusahaan', 'jenis_badan_usaha')->get(); // Adjust this query as needed


        return response()->json($klien);
    }

    public function get_klien_where(Request $request)
    {
        if ($request->id_perusahaan) {
            $klien = Klien::select('id', 'id_perusahaan', 'nama_perusahaan', 'jenis_badan_usaha', 'provinsi_pabrik', 'jumlah_tahapan_proses', 'line_produksi', 'jumlah_shift_per_hari', 'jml_kerja_per_hari', 'kapasitas_produksi_per_hari', 'jml_kary_produksi')

                ->where('id_perusahaan', $request->id_perusahaan)
                ->get(); // Adjust this query as needed
        } else {
            $klien = Klien::select('id', 'id_perusahaan', 'nama_perusahaan', 'jenis_badan_usaha')->get(); // Adjust this query as needed
        }

        return response()->json($klien);
    }

    public function cek_no_order(Request $request)
    {
        $skema = SkemaSertifikasi::where('kode_no_order', $request->kode_no_order); // Adjust this query as needed
        //var_dump($skema);
        //return response()->json($skema);
    }

    public function get_standar_sni(Request $request)
    {
        $ruang_lingkup = RuangLingkup::where('id', $request->id_standar)->first();
        //$data = response()->json($ruang_lingkup);
        //echo $data['id_skema'];
?>
        <div class="form-group row">
            <label for="text" class="col-sm-2 col-form-label">Ruang Lingkup</label>
            <div class="col-sm-4">
                <?= $ruang_lingkup['ruang_lingkup'] ?>
            </div>

            <label for="text" class="col-sm-2 col-form-label">Kode IAF</label>
            <div class="col-sm-4">
                <?= $ruang_lingkup['kode_iaf'] ?>
            </div>

        </div>


        <div class="form-group row">
            <label for="text" class="col-sm-2 col-form-label">Penjabaran IAF</label>
            <div class="col-sm-10">
                <?= $ruang_lingkup['penjabaran_iaf'] ?>
            </div>
        </div>

<?php
    }
    public function get_no_sertifikat(Request $request)
    {
        $sertifikat_refrensi = SertifikatReferensi::where('id', $request->no_sertifikat_referensi)->first();
        return response()->json(['status' => true, 'data' => $sertifikat_refrensi], 200);
        //$data = response()->json($ruang_lingkup);
        //echo $data['id_skema'];

    }

    public function get_ruang_lingkup()
    {
        $ruang_lingkup = RuangLingkup::where('status', 'Aktif')->get(); // Adjust this query as needed
        return response()->json($ruang_lingkup);
    }

    public function get_permohonan_client(Request $request)
    {
        $permohonan = Permohonan::where('id_perusahaan', $request->id_perusahaan)
            ->whereNotNull('no_proses')
            ->get(); // Adjust this query as needed
        return response()->json($permohonan);
    }

    public function no_proses_client_null(Request $request)
    {
        $permohonan = Permohonan::select('permohonan.*', 'mst_ruang_lingkup.nomor_standar', 'mst_ruang_lingkup.judul_standar', 'mst_tujuan_audit.nama_tujuan_audit', 'mst_sertifikat.no_sertifikat', 'mst_skema_sertifikasi.nama_skema_sertifikasi')
            ->leftJoin('mst_ruang_lingkup', 'permohonan.id_standar', '=', 'mst_ruang_lingkup.id')
            ->leftJoin('mst_tujuan_audit', 'permohonan.tujuan_audit', '=', 'mst_tujuan_audit.id')
            ->leftJoin('mst_sertifikat', 'permohonan.no_sertifikat_referensi', '=', 'mst_sertifikat.id')
            ->leftJoin('mst_skema_sertifikasi', 'mst_sertifikat.menu', '=', 'mst_skema_sertifikasi.id')
            ->where('permohonan.id_perusahaan', '=', $request->id_perusahaan)
            ->whereNull('no_proses')
            ->get(); // Adjust this query as needed
        return response()->json($permohonan);
    }

    public function get_permohonan_no_proses(Request $request)
    {
        $permohonan = Permohonan::select('permohonan.*', 'mst_ruang_lingkup.nomor_standar', 'mst_ruang_lingkup.judul_standar', 'mst_tujuan_audit.nama_tujuan_audit', 'mst_sertifikat.no_sertifikat', 'mst_skema_sertifikasi.nama_skema_sertifikasi')
            ->leftJoin('mst_ruang_lingkup', 'permohonan.id_standar', '=', 'mst_ruang_lingkup.id')
            ->leftJoin('mst_tujuan_audit', 'permohonan.tujuan_audit', '=', 'mst_tujuan_audit.id')
            ->leftJoin('mst_sertifikat', 'permohonan.no_sertifikat_referensi', '=', 'mst_sertifikat.id')
            ->leftJoin('mst_skema_sertifikasi', 'mst_sertifikat.menu', '=', 'mst_skema_sertifikasi.id')
            ->where('permohonan.id_perusahaan', '=', $request->id_perusahaan)
            ->where('permohonan.no_proses', '=', $request->no_proses)
            ->get();
        return response()->json($permohonan);
    }
}
