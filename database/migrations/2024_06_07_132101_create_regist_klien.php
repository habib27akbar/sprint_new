<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistKlien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regist_klien', function (Blueprint $table) {
            $table->id();
            $table->string('id_perusahaan', 25);
            $table->string('jenis_badan_usaha', 10);
            $table->string('nama_perusahaan', 100);
            $table->string('ln_dn', 20);
            $table->string('nama', 150);
            $table->string('posisi', 100);
            $table->string('perusahaan', 30);
            $table->string('email_regist', 200);
            $table->string('username', 10);
            $table->string('password');
            $table->text('salinan_akta_pendirian_perusahaan')->nullable();
            $table->text('salinan_akta_pendirian_perusahaan_tersumpah')->nullable();
            $table->text('nama_notaris_akta_pendiri')->nullable();
            $table->text('kedudukan_notaris_akta_pendiri')->nullable();
            $table->date('tanggal_akta_pendiri')->nullable();
            $table->text('nomor_akta_pendiri')->nullable();
            $table->text('salinan_akta_perubahan_perusahaan')->nullable();
            $table->text('salinan_akta_perubahan_perusahaan_tersumpah')->nullable();
            $table->text('nama_notaris')->nullable();
            $table->text('kedudukan_notaris')->nullable();
            $table->date('tanggal')->nullable();
            $table->text('nomor_akta')->nullable();
            $table->text('salinan_izin_industri')->nullable();
            $table->text('salinan_izin_industri_tersumpah')->nullable();
            $table->text('NIB')->nullable();
            $table->text('instansi_penerbit')->nullable();
            $table->text('jenis_angka_pengenal_importir')->nullable();
            $table->text('status_penanaman_modal')->nullable();
            $table->text('nomor_npwp')->nullable();
            $table->text('salinan_npwp')->nullable();
            $table->text('alamat')->nullable();
            $table->text('provinsi')->nullable();
            $table->text('negara')->nullable();
            $table->text('website')->nullable();
            $table->text('nomor_telepon')->nullable();
            $table->text('email')->nullable();
            $table->text('alamat_pabrik')->nullable();
            $table->text('provinsi_pabrik')->nullable();
            $table->text('negara_pabrik')->nullable();
            $table->text('website_pabrik')->nullable();
            $table->text('nomor_telepon_pabrik')->nullable();
            $table->text('email_pabrik')->nullable();

            $table->text('nama_direktur')->nullable();
            $table->text('negara_direktur')->nullable();
            $table->text('alamat_direktur')->nullable();
            $table->text('nomor_telepon_direktur')->nullable();
            $table->text('email_direktur')->nullable();
            $table->text('nama_sm')->nullable();
            $table->text('negara_sm')->nullable();
            $table->text('alamat_sm')->nullable();
            $table->text('nomor_telepon_sm')->nullable();
            $table->text('email_sm')->nullable();
            $table->text('jabatan_sm')->nullable();
            $table->text('nama_penghubung')->nullable();
            $table->text('negara_penghubung')->nullable();
            $table->text('alamat_penghubung')->nullable();
            $table->text('nomor_telepon_penghubung')->nullable();
            $table->text('email_penghubung')->nullable();
            $table->text('jabatan_penghubung')->nullable();
            $table->text('nama_koresponden')->nullable();
            $table->text('alamat_koresponden')->nullable();
            $table->text('nomor_telepon_koresponden')->nullable();
            $table->text('email_koresponden')->nullable();

            $table->text('alur_proses_produksi')->nullable();
            $table->text('peta_proses_bisnis')->nullable();
            $table->text('denah_lokasi_usaha')->nullable();
            $table->text('daftar_peralatan_produksi')->nullable();
            $table->text('daftar_peralatan_inspeksi')->nullable();
            $table->text('jumlah_tahapan_proses')->nullable();
            $table->text('jumlah_shift_per_hari')->nullable();
            $table->text('kapasitas_produksi_per_hari')->nullable();
            $table->text('line_produksi')->nullable();

            $table->text('total_proses_sub_kontrak')->nullable();
            $table->text('sistem_produksi')->nullable();
            $table->text('bahasa')->nullable();
            $table->text('menyediakan_penerjemah')->nullable();

            $table->text('sdm_dan_struktur_organisasi')->nullable();

            $table->text('jml_bag_mutu_quality')->nullable();
            $table->text('jml_bag_produksi')->nullable();
            $table->text('jml_selain_bag_mutu_produksi')->nullable();
            $table->text('jml_kary_produksi')->nullable();
            $table->text('jml_kerja_per_hari')->nullable();


            $table->text('pedoman_sistem_manajemen')->nullable();
            $table->text('kepemilikan_sertifikasi_ll')->nullable();
            $table->text('nama_lembaga')->nullable();

            $table->text('akta_pendiri_ppj')->nullable();
            $table->text('salinan_akta_pendiri_ppj')->nullable();
            $table->text('nama_notaris_pendiri_ppj')->nullable();
            $table->text('kedudukan_pendiri_notaris_ppj')->nullable();
            $table->date('tanggal_akta_pendiri_ppj')->nullable();
            $table->text('nomor_akta_pendiri_ppj')->nullable();


            $table->text('akta_pendiri_ppj_perubahan')->nullable();
            $table->text('salinan_akta_pendiri_ppj_perubahan')->nullable();
            $table->text('nama_notaris_pendiri_ppj_perubahan')->nullable();
            $table->text('kedudukan_pendiri_notaris_ppj_perubahan')->nullable();
            $table->date('tanggal_akta_pendiri_ppj_perubahan')->nullable();
            $table->text('nomor_akta_pendiri_ppj_perubahan')->nullable();


            $table->text('salinan_izin_industri_ppj')->nullable();
            $table->text('salinan_izin_industri_tersumpah_ppj')->nullable();
            $table->text('NIB_ppj')->nullable();
            $table->text('instansi_penerbit_ppj')->nullable();
            $table->text('jenis_angka_pengenal_importir_ppj')->nullable();
            $table->text('status_penanaman_modal_ppj')->nullable();


            $table->text('nomor_npwp_ppj')->nullable();
            $table->text('salinan_npwp_ppj')->nullable();
            $table->text('alamat_ppj')->nullable();
            $table->text('provinsi_ppj')->nullable();
            $table->text('negara_ppj')->nullable();
            $table->text('website_ppj')->nullable();
            $table->text('nomor_telepon_ppj')->nullable();
            $table->text('email_ppj')->nullable();

            $table->text('nama_ppj_kr')->nullable();
            $table->text('negara_ppj_kr')->nullable();
            $table->text('alamat_ppj_kr')->nullable();
            $table->text('nomor_telepon_ppj_kr')->nullable();
            $table->text('email_ppj_kr')->nullable();
            $table->text('jabatan_ppj_kr')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regist_klien');
    }
}
