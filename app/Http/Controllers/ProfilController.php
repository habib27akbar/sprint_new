<?php

namespace App\Http\Controllers;

use App\Models\KBLI;
use App\Models\Klien;
use App\Models\Country;
use App\Models\SPPTSNI;
use App\Models\Provinsi;
use App\Models\RegistKlien;
use App\Models\Transportasi;
use Illuminate\Http\Request;
use App\Models\ProsesSubKontrak;
use App\Models\PedomanSertifikasi;
use App\Models\StrukturOrganisasi;
use Illuminate\Support\Facades\Session;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinsi = Provinsi::all();
        $klien = Klien::where('id_perusahaan', Session::get('id_perusahaan'))->get();
        $kbli = KBLI::where('id_perusahaan', Session::get('id_perusahaan'))->get();
        $proses_sub_kontrak = ProsesSubKontrak::where('id_perusahaan', Session::get('id_perusahaan'))->get();
        $transportasi = Transportasi::where('id_perusahaan', Session::get('id_perusahaan'))->get();
        $struktur_organisasi = StrukturOrganisasi::where('id_perusahaan', Session::get('id_perusahaan'))->get();
        $pedoman_sertifikasi = PedomanSertifikasi::where('id_perusahaan', Session::get('id_perusahaan'))->get();
        $sppt_sni = SPPTSNI::where('id_perusahaan', Session::get('id_perusahaan'))->get();
        $getData = true;
        //var_dump($klien);
        if ($klien->isEmpty()) {
            //echo "a";
            $getData = false;
            $klien = RegistKlien::where('id_perusahaan', Session::get('id_perusahaan'))->get();
        }
        //dd($getData);
        $country = Country::all();
        return view('profil_pelanggan.index', compact('provinsi', 'country', 'klien', 'getData', 'kbli', 'proses_sub_kontrak', 'transportasi', 'struktur_organisasi', 'pedoman_sertifikasi', 'sppt_sni'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_perusahaan = Session::get('id_perusahaan');
        $klien = Klien::where('id_perusahaan', $id_perusahaan)->get();
        $id = '';
        if (isset($klien)) {
            $id = $klien[0]['id'];
        }


        $dir = 'doc/klien';
        $nama_salinan_akta_pendirian_perusahaan = $request->input('salinan_akta_pendirian_perusahaan_old');
        if ($request->file('salinan_akta_pendirian_perusahaan')) {
            $salinan_akta_pendirian_perusahaan = $request->file('salinan_akta_pendirian_perusahaan');
            $nama_salinan_akta_pendirian_perusahaan = 'klien-' . uniqid() . '-' . $salinan_akta_pendirian_perusahaan->getClientOriginalName();
            $salinan_akta_pendirian_perusahaan->move(public_path($dir), $nama_salinan_akta_pendirian_perusahaan);
        }

        $nama_salinan_akta_pendirian_perusahaan_tersumpah = $request->input('salinan_akta_pendirian_perusahaan_tersumpah_old');
        if ($request->file('salinan_akta_pendirian_perusahaan_tersumpah')) {
            $salinan_akta_pendirian_perusahaan_tersumpah = $request->file('salinan_akta_pendirian_perusahaan_tersumpah');
            $nama_salinan_akta_pendirian_perusahaan_tersumpah = 'klien-' . uniqid() . '-' . $salinan_akta_pendirian_perusahaan_tersumpah->getClientOriginalName();
            $salinan_akta_pendirian_perusahaan_tersumpah->move(public_path($dir), $nama_salinan_akta_pendirian_perusahaan_tersumpah);
        }

        $nama_salinan_akta_perubahan_perusahaan = $request->input('salinan_akta_perubahan_perusahaan_old');
        if ($request->file('salinan_akta_perubahan_perusahaan')) {
            $salinan_akta_perubahan_perusahaan = $request->file('salinan_akta_perubahan_perusahaan');
            $nama_salinan_akta_perubahan_perusahaan = 'klien-' . uniqid() . '-' . $salinan_akta_perubahan_perusahaan->getClientOriginalName();
            $salinan_akta_perubahan_perusahaan->move(public_path($dir), $nama_salinan_akta_perubahan_perusahaan);
        }

        $nama_salinan_akta_perubahan_perusahaan_tersumpah = $request->input('salinan_akta_perubahan_perusahaan_tersumpah_old');
        if ($request->file('salinan_akta_perubahan_perusahaan_tersumpah')) {
            $salinan_akta_perubahan_perusahaan_tersumpah = $request->file('salinan_akta_perubahan_perusahaan_tersumpah');
            $nama_salinan_akta_perubahan_perusahaan_tersumpah = 'klien-' . uniqid() . '-' . $salinan_akta_perubahan_perusahaan_tersumpah->getClientOriginalName();
            $salinan_akta_perubahan_perusahaan_tersumpah->move(public_path($dir), $nama_salinan_akta_perubahan_perusahaan_tersumpah);
        }

        $nama_salinan_izin_industri = $request->input('salinan_izin_industri_old');
        if ($request->file('salinan_izin_industri')) {
            $salinan_izin_industri = $request->file('salinan_izin_industri');
            $nama_salinan_izin_industri = 'klien-' . uniqid() . '-' . $salinan_izin_industri->getClientOriginalName();
            $salinan_izin_industri->move(public_path($dir), $nama_salinan_izin_industri);
        }

        $nama_salinan_izin_industri_tersumpah = $request->input('salinan_izin_industri_tersumpah_old');
        if ($request->file('salinan_izin_industri_tersumpah')) {
            $salinan_izin_industri_tersumpah = $request->file('salinan_izin_industri_tersumpah');
            $nama_salinan_izin_industri_tersumpah = 'klien-' . uniqid() . '-' . $salinan_izin_industri_tersumpah->getClientOriginalName();
            $salinan_izin_industri_tersumpah->move(public_path($dir), $nama_salinan_izin_industri_tersumpah);
        }

        $nama_salinan_npwp = $request->input('salinan_npwp_old');
        if ($request->file('salinan_npwp')) {
            $salinan_npwp = $request->file('salinan_npwp');
            $nama_salinan_npwp = 'klien-' . uniqid() . '-' . $salinan_npwp->getClientOriginalName();
            $salinan_npwp->move(public_path($dir), $nama_salinan_npwp);
        }

        $nama_alur_proses_produksi = $request->input('alur_proses_produksi_old');
        if ($request->file('alur_proses_produksi')) {
            $alur_proses_produksi = $request->file('alur_proses_produksi');
            $nama_alur_proses_produksi = 'klien-' . uniqid() . '-' . $alur_proses_produksi->getClientOriginalName();
            $alur_proses_produksi->move(public_path($dir), $nama_alur_proses_produksi);
        }

        $nama_peta_proses_bisnis = $request->input('peta_proses_bisnis_old');
        if ($request->file('peta_proses_bisnis')) {
            $peta_proses_bisnis = $request->file('peta_proses_bisnis');
            $nama_peta_proses_bisnis = 'klien-' . uniqid() . '-' . $peta_proses_bisnis->getClientOriginalName();
            $peta_proses_bisnis->move(public_path($dir), $nama_peta_proses_bisnis);
        }

        $nama_denah_lokasi_usaha = $request->input('denah_lokasi_usaha_old');
        if ($request->file('denah_lokasi_usaha')) {
            $denah_lokasi_usaha = $request->file('denah_lokasi_usaha');
            $nama_denah_lokasi_usaha = 'klien-' . uniqid() . '-' . $denah_lokasi_usaha->getClientOriginalName();
            $denah_lokasi_usaha->move(public_path($dir), $nama_denah_lokasi_usaha);
        }

        $nama_daftar_peralatan_produksi = $request->input('daftar_peralatan_produksi_old');
        if ($request->file('daftar_peralatan_produksi')) {
            $daftar_peralatan_produksi = $request->file('daftar_peralatan_produksi');
            $nama_daftar_peralatan_produksi = 'klien-' . uniqid() . '-' . $daftar_peralatan_produksi->getClientOriginalName();
            $daftar_peralatan_produksi->move(public_path($dir), $nama_daftar_peralatan_produksi);
        }

        $nama_daftar_peralatan_inspeksi = $request->input('daftar_peralatan_inspeksi_old');
        if ($request->file('daftar_peralatan_inspeksi')) {
            $daftar_peralatan_inspeksi = $request->file('daftar_peralatan_inspeksi');
            $nama_daftar_peralatan_inspeksi = 'klien-' . uniqid() . '-' . $daftar_peralatan_inspeksi->getClientOriginalName();
            $daftar_peralatan_inspeksi->move(public_path($dir), $nama_daftar_peralatan_inspeksi);
        }

        $nama_akta_pendiri_ppj = $request->input('akta_pendiri_ppj_old');
        if ($request->file('akta_pendiri_ppj')) {
            $akta_pendiri_ppj = $request->file('akta_pendiri_ppj');
            $nama_akta_pendiri_ppj = 'klien-' . uniqid() . '-' . $akta_pendiri_ppj->getClientOriginalName();
            $akta_pendiri_ppj->move(public_path($dir), $nama_akta_pendiri_ppj);
        }

        $nama_salinan_akta_pendiri_ppj = $request->input('salinan_akta_pendiri_ppj_old');
        if ($request->file('salinan_akta_pendiri_ppj')) {
            $salinan_akta_pendiri_ppj = $request->file('salinan_akta_pendiri_ppj');
            $nama_salinan_akta_pendiri_ppj = 'klien-' . uniqid() . '-' . $salinan_akta_pendiri_ppj->getClientOriginalName();
            $salinan_akta_pendiri_ppj->move(public_path($dir), $nama_salinan_akta_pendiri_ppj);
        }

        $nama_akta_pendiri_ppj_perubahan = $request->input('akta_pendiri_ppj_perubahan_old');
        if ($request->file('akta_pendiri_ppj_perubahan')) {
            $akta_pendiri_ppj_perubahan = $request->file('akta_pendiri_ppj_perubahan');
            $nama_akta_pendiri_ppj_perubahan = 'klien-' . uniqid() . '-' . $akta_pendiri_ppj_perubahan->getClientOriginalName();
            $akta_pendiri_ppj_perubahan->move(public_path($dir), $nama_akta_pendiri_ppj_perubahan);
        }

        $nama_salinan_akta_pendiri_ppj_perubahan = $request->input('salinan_akta_pendiri_ppj_perubahan_old');
        if ($request->file('salinan_akta_pendiri_ppj_perubahan')) {
            $salinan_akta_pendiri_ppj_perubahan = $request->file('salinan_akta_pendiri_ppj_perubahan');
            $nama_salinan_akta_pendiri_ppj_perubahan = 'klien-' . uniqid() . '-' . $salinan_akta_pendiri_ppj_perubahan->getClientOriginalName();
            $salinan_akta_pendiri_ppj_perubahan->move(public_path($dir), $nama_salinan_akta_pendiri_ppj_perubahan);
        }

        $nama_salinan_izin_industri_ppj = $request->input('salinan_izin_industri_ppj_old');
        if ($request->file('salinan_izin_industri_ppj')) {
            $salinan_izin_industri_ppj = $request->file('salinan_izin_industri_ppj');
            $nama_salinan_izin_industri_ppj = 'klien-' . uniqid() . '-' . $salinan_izin_industri_ppj->getClientOriginalName();
            $salinan_izin_industri_ppj->move(public_path($dir), $nama_salinan_izin_industri_ppj);
        }

        $nama_salinan_izin_industri_tersumpah_ppj = $request->input('salinan_izin_industri_tersumpah_ppj_old');
        if ($request->file('salinan_izin_industri_tersumpah_ppj')) {
            $salinan_izin_industri_tersumpah_ppj = $request->file('salinan_izin_industri_tersumpah_ppj');
            $nama_salinan_izin_industri_tersumpah_ppj = 'klien-' . uniqid() . '-' . $salinan_izin_industri_tersumpah_ppj->getClientOriginalName();
            $salinan_izin_industri_tersumpah_ppj->move(public_path($dir), $nama_salinan_izin_industri_tersumpah_ppj);
        }

        $nama_salinan_npwp_ppj = $request->input('salinan_npwp_ppj_old');
        if ($request->file('salinan_npwp_ppj')) {
            $salinan_npwp_ppj = $request->file('salinan_npwp_ppj');
            $nama_salinan_npwp_ppj = 'klien-' . uniqid() . '-' . $salinan_npwp_ppj->getClientOriginalName();
            $salinan_npwp_ppj->move(public_path($dir), $nama_salinan_npwp_ppj);
        }

        $nama_sdm_dan_struktur_organisasi = $request->input('sdm_dan_struktur_organisasi_old');
        if ($request->file('sdm_dan_struktur_organisasi')) {
            $sdm_dan_struktur_organisasi = $request->file('sdm_dan_struktur_organisasi');
            $nama_sdm_dan_struktur_organisasi = 'klien-' . uniqid() . '-' . $sdm_dan_struktur_organisasi->getClientOriginalName();
            $sdm_dan_struktur_organisasi->move(public_path($dir), $nama_sdm_dan_struktur_organisasi);
        }

        $nama_pedoman_sistem_manajemen = $request->input('pedoman_sistem_manajemen_old');
        if ($request->file('pedoman_sistem_manajemen')) {
            $pedoman_sistem_manajemen = $request->file('pedoman_sistem_manajemen');
            $nama_pedoman_sistem_manajemen = 'klien-' . uniqid() . '-' . $pedoman_sistem_manajemen->getClientOriginalName();
            $pedoman_sistem_manajemen->move(public_path($dir), $nama_pedoman_sistem_manajemen);
        }

        $storeData = [
            'id_perusahaan' => $id_perusahaan,
            'jenis_badan_usaha' => $request->input('jenis_badan_usaha'),
            'nama_perusahaan' => $request->input('nama_perusahaan'),
            'ln_dn' => $request->input('ln_dn'),
            'salinan_akta_pendirian_perusahaan' => $nama_salinan_akta_pendirian_perusahaan,
            'salinan_akta_pendirian_perusahaan_tersumpah' => $nama_salinan_akta_pendirian_perusahaan_tersumpah,
            'nama_notaris_akta_pendiri' => $request->input('nama_notaris_akta_pendiri'),
            'kedudukan_notaris_akta_pendiri' => $request->input('kedudukan_notaris_akta_pendiri'),
            'tanggal_akta_pendiri' => $request->input('tanggal_akta_pendiri'),
            'nomor_akta_pendiri' => $request->input('nomor_akta_pendiri'),
            'salinan_akta_perubahan_perusahaan' => $nama_salinan_akta_perubahan_perusahaan,
            'salinan_akta_perubahan_perusahaan_tersumpah' => $nama_salinan_akta_perubahan_perusahaan_tersumpah,
            'nama_notaris' => $request->input('nama_notaris'),
            'kedudukan_notaris' => $request->input('kedudukan_notaris'),
            'tanggal' => $request->input('tanggal'),
            'nomor_akta' => $request->input('nomor_akta'),
            'salinan_izin_industri' => $nama_salinan_izin_industri,
            'salinan_izin_industri_tersumpah' => $nama_salinan_izin_industri_tersumpah,
            'NIB' => $request->input('NIB'),
            'instansi_penerbit' => $request->input('instansi_penerbit'),
            'jenis_angka_pengenal_importir' => $request->input('jenis_angka_pengenal_importir'),
            'status_penanaman_modal' => $request->input('status_penanaman_modal'),
            'nomor_npwp' => $request->input('nomor_npwp'),
            'salinan_npwp' => $nama_salinan_npwp,
            'alamat' => $request->input('alamat'),
            'provinsi' => $request->input('provinsi'),
            'negara' => $request->input('negara'),
            'website' => $request->input('website'),
            'nomor_telepon' => $request->input('nomor_telepon'),
            'email' => $request->input('email'),
            'alamat_pabrik' => $request->input('alamat_pabrik'),
            'provinsi_pabrik' => $request->input('provinsi_pabrik'),
            'negara_pabrik' => $request->input('negara_pabrik'),
            'website_pabrik' => $request->input('website_pabrik'),
            'nomor_telepon_pabrik' => $request->input('nomor_telepon_pabrik'),
            'email_pabrik' => $request->input('email_pabrik'),
            'nama_direktur' => $request->input('nama_direktur'),
            'negara_direktur' => $request->input('negara_direktur'),
            'alamat_direktur' => $request->input('alamat_direktur'),
            'nomor_telepon_direktur' => $request->input('nomor_telepon_direktur'),
            'email_direktur' => $request->input('email_direktur'),
            'nama_sm' => $request->input('nama_sm'),
            'negara_sm' => $request->input('negara_sm'),
            'alamat_sm' => $request->input('alamat_sm'),
            'nomor_telepon_sm' => $request->input('nomor_telepon_sm'),
            'email_sm' => $request->input('email_sm'),
            'jabatan_sm' => $request->input('jabatan_sm'),
            'nama_penghubung' => $request->input('nama_penghubung'),
            'negara_penghubung' => $request->input('negara_penghubung'),
            'alamat_penghubung' => $request->input('alamat_penghubung'),
            'nomor_telepon_penghubung' => $request->input('nomor_telepon_penghubung'),
            'email_penghubung' => $request->input('email_penghubung'),
            'jabatan_penghubung' => $request->input('jabatan_penghubung'),
            'nama_koresponden' => $request->input('nama_koresponden'),
            'alamat_koresponden' => $request->input('alamat_koresponden'),
            'nomor_telepon_koresponden' => $request->input('nomor_telepon_koresponden'),
            'email_koresponden' => $request->input('email_koresponden'),
            'alur_proses_produksi' => $nama_alur_proses_produksi,
            'peta_proses_bisnis' => $nama_peta_proses_bisnis,
            'denah_lokasi_usaha' => $nama_denah_lokasi_usaha,
            'daftar_peralatan_produksi' => $nama_daftar_peralatan_produksi,
            'daftar_peralatan_inspeksi' => $nama_daftar_peralatan_inspeksi,
            'jumlah_tahapan_proses' => $request->input('jumlah_tahapan_proses'),
            'jumlah_shift_per_hari' => $request->input('jumlah_shift_per_hari'),
            'kapasitas_produksi_per_hari' => $request->input('kapasitas_produksi_per_hari'),
            'line_produksi' => $request->input('line_produksi'),
            'total_proses_sub_kontrak' => $request->input('total_proses_sub_kontrak'),
            'sistem_produksi' => $request->input('sistem_produksi'),
            'bahasa' => $request->input('bahasa'),
            'menyediakan_penerjemah' => $request->input('menyediakan_penerjemah'),
            'sdm_dan_struktur_organisasi' => $nama_sdm_dan_struktur_organisasi,
            'jml_bag_mutu_quality' => $request->input('jml_bag_mutu_quality'),
            'jml_bag_produksi' => $request->input('jml_bag_produksi'),
            'jml_selain_bag_mutu_produksi' => $request->input('jml_selain_bag_mutu_produksi'),
            'jml_kary_produksi' => $request->input('jml_kary_produksi'),
            'jml_kerja_per_hari' => $request->input('jml_kerja_per_hari'),
            'pedoman_sistem_manajemen' => $nama_pedoman_sistem_manajemen,
            'kepemilikan_sertifikasi_ll' => $request->input('kepemilikan_sertifikasi_ll'),
            'nama_lembaga' => $request->input('nama_lembaga'),
            'akta_pendiri_ppj' => $nama_akta_pendiri_ppj,
            'salinan_akta_pendiri_ppj' => $nama_salinan_akta_pendiri_ppj,
            'nama_notaris_pendiri_ppj' => $request->input('nama_notaris_pendiri_ppj'),
            'kedudukan_pendiri_notaris_ppj' => $request->input('kedudukan_pendiri_notaris_ppj'),
            'tanggal_akta_pendiri_ppj' => $request->input('tanggal_akta_pendiri_ppj'),
            'nomor_akta_pendiri_ppj' => $request->input('nomor_akta_pendiri_ppj'),
            'akta_pendiri_ppj_perubahan' => $nama_akta_pendiri_ppj_perubahan,
            'salinan_akta_pendiri_ppj_perubahan' => $nama_salinan_akta_pendiri_ppj_perubahan,
            'nama_notaris_pendiri_ppj_perubahan' => $request->input('nama_notaris_pendiri_ppj_perubahan'),
            'kedudukan_pendiri_notaris_ppj_perubahan' => $request->input('kedudukan_pendiri_notaris_ppj_perubahan'),
            'tanggal_akta_pendiri_ppj_perubahan' => $request->input('tanggal_akta_pendiri_ppj_perubahan'),
            'nomor_akta_pendiri_ppj_perubahan' => $request->input('nomor_akta_pendiri_ppj_perubahan'),
            'salinan_izin_industri_ppj' => $nama_salinan_izin_industri_ppj,
            'salinan_izin_industri_tersumpah_ppj' => $nama_salinan_izin_industri_tersumpah_ppj,
            'NIB_ppj' => $request->input('NIB_ppj'),
            'instansi_penerbit_ppj' => $request->input('instansi_penerbit_ppj'),
            'jenis_angka_pengenal_importir_ppj' => $request->input('jenis_angka_pengenal_importir_ppj'),
            'status_penanaman_modal_ppj' => $request->input('status_penanaman_modal_ppj'),
            'nomor_npwp_ppj' => $request->input('nomor_npwp_ppj'),
            'salinan_npwp_ppj' => $nama_salinan_npwp_ppj,
            'alamat_ppj' => $request->input('alamat_ppj'),
            'provinsi_ppj' => $request->input('provinsi_ppj'),
            'negara_ppj' => $request->input('negara_ppj'),
            'website_ppj' => $request->input('website_ppj'),
            'nomor_telepon_ppj' => $request->input('nomor_telepon_ppj'),
            'email_ppj' => $request->input('email_ppj'),
            'nama_ppj_kr' => $request->input('nama_ppj_kr'),
            'negara_ppj_kr' => $request->input('negara_ppj_kr'),
            'alamat_ppj_kr' => $request->input('alamat_ppj_kr'),
            'nomor_telepon_ppj_kr' => $request->input('nomor_telepon_ppj_kr'),
            'email_ppj_kr' => $request->input('email_ppj_kr'),
            'jabatan_ppj_kr' => $request->input('jabatan_ppj_kr')
        ];
        if ($id) {
            Klien::where('id', $id)->update($storeData);
        } else {
            Klien::create($storeData);
            //return redirect('profil-pelanggan')->with('alert-success', 'Success Tambah Data');
        }


        if (isset($_POST['data_post'])) {
            $kbli = KBLI::where('id_perusahaan', $id_perusahaan)->get();
            if (count($kbli)) {
                foreach ($kbli as $k) {
                    KBLI::findOrFail($k['id'])->delete();
                }
            }
            $fieldNames = array("kode_kbli", "nama_kbli", "lokasi_usaha", "tipe");
            for ($i = 0; $i < count($_POST['data_post'][$fieldNames[0]]); $i++) {
                if (!empty($_POST['data_post']['kode_kbli'][$i]) or !empty($_POST['data_post']['nama_kbli'][$i]) or !empty($_POST['data_post']['lokasi_usaha'][$i])) {
                    $storeKBLI = [
                        'id_perusahaan' => $id_perusahaan,
                        'kode_kbli' => $_POST['data_post']['kode_kbli'][$i],
                        'nama_kbli' => $_POST['data_post']['nama_kbli'][$i],
                        'lokasi_usaha' => $_POST['data_post']['lokasi_usaha'][$i],
                        'tipe' => $_POST['data_post']['tipe'][$i],
                    ];

                    KBLI::create($storeKBLI);
                }
            }
        }

        if (isset($_POST['post_sub'])) {
            $proses_sub_kontrak = ProsesSubKontrak::where('id_perusahaan', $id_perusahaan)->get();
            if (count($proses_sub_kontrak)) {
                foreach ($proses_sub_kontrak as $s) {
                    ProsesSubKontrak::findOrFail($s['id'])->delete();
                }
            }

            $fieldPost = array("proses_sub_kontrak", "nama_perusahaan", "alamat_perusahaan", "persentase");
            for ($i = 0; $i < count($_POST['post_sub'][$fieldPost[0]]); $i++) {
                if (!empty($_POST['post_sub']['proses_sub_kontrak'][$i]) or !empty($_POST['post_sub']['nama_perusahaan'][$i]) or !empty($_POST['post_sub']['alamat_perusahaan'][$i])) {
                    $storeSub = [
                        'id_perusahaan' => $id_perusahaan,
                        'proses_sub_kontrak' => $_POST['post_sub']['proses_sub_kontrak'][$i],
                        'nama_perusahaan' => $_POST['post_sub']['nama_perusahaan'][$i],
                        'alamat_perusahaan' => $_POST['post_sub']['alamat_perusahaan'][$i],
                        'persentase' => $_POST['post_sub']['persentase'][$i],
                    ];

                    ProsesSubKontrak::create($storeSub);
                }
            }
        }
        if (isset($_POST['post_trans'])) {
            $transportasi = Transportasi::where('id_perusahaan', $id_perusahaan)->get();
            if (count($transportasi)) {
                foreach ($transportasi as $st) {
                    Transportasi::findOrFail($st['id'])->delete();
                }
            }

            $fieldPost = array("asal", "tujuan", "rute", "moda", "jarak_tempuh", "waktu");
            for ($i = 0; $i < count($_POST['post_trans'][$fieldPost[0]]); $i++) {
                if (!empty($_POST['post_trans']['asal'][$i]) or !empty($_POST['post_trans']['tujuan'][$i]) or !empty($_POST['post_trans']['rute'][$i]) or !empty($_POST['post_trans']['moda'][$i]) or !empty($_POST['post_trans']['jarak_tempuh'][$i]) or !empty($_POST['post_trans']['waktu'][$i])) {
                    $storeSub = [
                        'id_perusahaan' => $id_perusahaan,
                        'asal' => $_POST['post_trans']['asal'][$i],
                        'tujuan' => $_POST['post_trans']['tujuan'][$i],
                        'rute' => $_POST['post_trans']['rute'][$i],
                        'moda' => $_POST['post_trans']['moda'][$i],
                        'jarak_tempuh' => $_POST['post_trans']['jarak_tempuh'][$i],
                        'waktu' => $_POST['post_trans']['waktu'][$i],
                    ];

                    Transportasi::create($storeSub);
                }
            }
        }
        if (isset($_POST['post_struktur'])) {
            $struktur_organisasi = StrukturOrganisasi::where('id_perusahaan', $id_perusahaan)->get();
            if (count($struktur_organisasi)) {
                foreach ($struktur_organisasi as $st) {
                    StrukturOrganisasi::findOrFail($st['id'])->delete();
                }
            }

            $fieldPost = array("nama_divisi", "tanggung_jawab", "jumlah_personil");
            for ($i = 0; $i < count($_POST['post_struktur'][$fieldPost[0]]); $i++) {
                if (!empty($_POST['post_struktur']['nama_divisi'][$i]) or !empty($_POST['post_struktur']['tanggung_jawab'][$i]) or !empty($_POST['post_struktur']['jumlah_personil'][$i])) {
                    $storeSub = [
                        'id_perusahaan' => $id_perusahaan,
                        'nama_divisi' => $_POST['post_struktur']['nama_divisi'][$i],
                        'tanggung_jawab' => $_POST['post_struktur']['tanggung_jawab'][$i],
                        'jumlah_personil' => $_POST['post_struktur']['jumlah_personil'][$i]
                    ];

                    StrukturOrganisasi::create($storeSub);
                }
            }
        }
        if (isset($_POST['post_pedoman'])) {
            $pedoman_sertifikasi = PedomanSertifikasi::where('id_perusahaan', $id_perusahaan)->get();
            if (count($pedoman_sertifikasi)) {
                foreach ($pedoman_sertifikasi as $st) {
                    PedomanSertifikasi::findOrFail($st['id'])->delete();
                }
            }

            $fieldPost = array("jenis_sistem_manajemen", "versi_standar_sistem", "lembaga_sertifikasi", "nomor_sertifikat", "masa_berlaku", "logo_sertifikat", "ruang_lingkup", "penerapan", "nama_konsultan", "tahun_konsultan", "sertifikat", "sertifikat_old");
            for ($i = 0; $i < count($_POST['post_pedoman'][$fieldPost[0]]); $i++) {
                if (!empty($_POST['post_pedoman']['jenis_sistem_manajemen'][$i]) or !empty($_POST['post_pedoman']['versi_standar_sistem'][$i]) or !empty($_POST['post_pedoman']['lembaga_sertifikasi'][$i]) or !empty($_POST['post_pedoman']['nomor_sertifikat'][$i]) or !empty($_POST['post_pedoman']['masa_berlaku'][$i]) or !empty($_POST['post_pedoman']['logo_sertifikat'][$i]) or !empty($_POST['post_pedoman']['ruang_lingkup'][$i]) or !empty($_POST['post_pedoman']['penerapan'][$i]) or !empty($_POST['post_pedoman']['nama_konsultan'][$i]) or !empty($_POST['post_pedoman']['tahun_konsultan'][$i])) {
                    //dd($request->file('post_pedoman')['sertifikat'][$i]);
                    $nama_sertifikat = $_POST['post_pedoman']['sertifikat_old'][$i];
                    if ($request->file('post_pedoman')['sertifikat'][$i]) {
                        $sertifikat = $request->file('post_pedoman')['sertifikat'][$i];
                        $nama_sertifikat = 'se-' . uniqid() . '-' . $sertifikat->getClientOriginalName();
                        $sertifikat->move(public_path($dir), $nama_sertifikat);
                    }

                    $storeSub = [
                        'id_perusahaan' => $id_perusahaan,
                        'jenis_sistem_manajemen' => $_POST['post_pedoman']['jenis_sistem_manajemen'][$i],
                        'versi_standar_sistem' => $_POST['post_pedoman']['versi_standar_sistem'][$i],
                        'lembaga_sertifikasi' => $_POST['post_pedoman']['lembaga_sertifikasi'][$i],
                        'nomor_sertifikat' => $_POST['post_pedoman']['nomor_sertifikat'][$i],
                        'masa_berlaku' => $_POST['post_pedoman']['masa_berlaku'][$i],
                        'logo_sertifikat' => $_POST['post_pedoman']['logo_sertifikat'][$i],
                        'ruang_lingkup' => $_POST['post_pedoman']['ruang_lingkup'][$i],
                        'penerapan' => $_POST['post_pedoman']['penerapan'][$i],
                        'nama_konsultan' => $_POST['post_pedoman']['nama_konsultan'][$i],
                        'tahun_konsultan' => $_POST['post_pedoman']['tahun_konsultan'][$i],
                        'sertifikat' => $nama_sertifikat

                    ];

                    PedomanSertifikasi::create($storeSub);
                }
            }
        }

        if (isset($_POST['post_sppt'])) {
            $sppt_sni = SPPTSNI::where('id_perusahaan', $id_perusahaan)->get();
            if (count($sppt_sni)) {
                foreach ($sppt_sni as $st) {
                    SPPTSNI::findOrFail($st['id'])->delete();
                }
            }

            $fieldPost = array("nomor_sertifikat", "masa_berlaku");
            for ($i = 0; $i < count($_POST['post_sppt'][$fieldPost[0]]); $i++) {
                if (!empty($_POST['post_sppt']['nomor_sertifikat'][$i]) or !empty($_POST['post_sppt']['masa_berlaku'][$i])) {
                    $storeSub = [
                        'id_perusahaan' => $id_perusahaan,
                        'nomor_sertifikat' => $_POST['post_sppt']['nomor_sertifikat'][$i],
                        'masa_berlaku' => $_POST['post_sppt']['masa_berlaku'][$i]
                    ];

                    SPPTSNI::create($storeSub);
                }
            }
        }

        return redirect('profil-pelanggan')->with('alert-success', 'Success Update Data');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
