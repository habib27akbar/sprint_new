<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KlienController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RegistController;
use App\Http\Controllers\PermohonanController;
use App\Http\Controllers\ProsesLainController;
use App\Http\Controllers\SeritifikatController;
use App\Http\Controllers\TujuanAuditController;
use App\Http\Controllers\PermohonanUserController;
use App\Http\Controllers\SkemaSertifikasiController;
use App\Http\Controllers\PemeriksaanRegistrasiController;
use App\Http\Controllers\PenugasanPersonilController;
use App\Http\Controllers\PerencanaanController;
use App\Http\Controllers\PerjanjianSertifikasiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('index');
// });

Auth::routes();


Route::get('/login', [AuthController::class, 'form_login'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('authenticate');
Route::get('/register', [AuthController::class, 'form_regist']);
Route::get('/forget', [AuthController::class, 'forget'])->name('forget');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/forget-password', [AuthController::class, 'forget_password'])->name('forget_password');
Route::get('captcha', 'CaptchaController@showCaptcha');
Route::resource('regist', RegistController::class);
Route::post('regist', [RegistController::class, 'store'])->name('regist');
Route::get('get-klien', [AjaxController::class, 'get_klien'])->name('get_klien');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('/profil-pelanggan', ProfilController::class, ['names' => [
        'index' => 'profil-pelanggan.index',
        'create' => 'profil-pelanggan.create',
        'store' => 'profil-pelanggan.store',
        'show' => 'profil-pelanggan.show',
        'edit' => 'profil-pelanggan.edit',
        'update' => 'profil-pelanggan.update',
        'destroy' => 'profil-pelanggan.destroy'
    ]]);
    Route::get('data-klien', [KlienController::class, 'index'])->name('data_klien');
    Route::get('data-klien/getData', [KlienController::class, 'getData'])->name('data-klien.getData');
    Route::get('data-klien/getUniqueValues', [KlienController::class, 'getUniqueValues'])->name('data-klien.getUniqueValues');
    //Route::get('/unique-values', [KlienController::class, 'getUniqueValues'])->name('data-klien.getUniqueValues');
    Route::resource('perjanjian_sertifikasi', PerjanjianSertifikasiController::class);
    Route::get('perjanjian-sertifikasi/getData', [PerjanjianSertifikasiController::class, 'getData'])->name('perjanjian-sertifikasi.getData');
    Route::get('perjanjian-sertifikasi/getUniqueValues', [PerjanjianSertifikasiController::class, 'getUniqueValues'])->name('perjanjian-sertifikasi.getUniqueValues');
    Route::get('get-klien-list', [AjaxController::class, 'get_klien_list'])->name('get_klien_list');
    Route::resource('pemeriksaan_regist', PemeriksaanRegistrasiController::class);
    Route::get('pemeriksaan_registrasi/getData', [PemeriksaanRegistrasiController::class, 'getData'])->name('pemeriksaan_registrasi.getData');
    Route::get('pemeriksaan_registrasi/getUniqueValues', [PemeriksaanRegistrasiController::class, 'getUniqueValues'])->name('pemeriksaan_registrasi.getUniqueValues');
    Route::resource('skema_sertifikasi', SkemaSertifikasiController::class);
    Route::get('skema-sertifikasi/getData', [SkemaSertifikasiController::class, 'getData'])->name('skema-sertifikasi.getData');
    Route::get('skema-sertifikasi/getUniqueValues', [SkemaSertifikasiController::class, 'getUniqueValues'])->name('skema-sertifikasi.getUniqueValues');
    Route::get('cek-no-order', [AjaxController::class, 'cek_no_order'])->name('cek_no_order');
    Route::resource('tujuan_audit', TujuanAuditController::class);
    Route::get('tujuan-audit/getData', [TujuanAuditController::class, 'getData'])->name('tujuan-audit.getData');
    Route::get('tujuan-audit/getUniqueValues', [TujuanAuditController::class, 'getUniqueValues'])->name('tujuan-audit.getUniqueValues');
    Route::resource('proses_lain', ProsesLainController::class);
    Route::get('proses-lain/getData', [ProsesLainController::class, 'getData'])->name('proses-lain.getData');
    Route::get('proses-lain/getUniqueValues', [ProsesLainController::class, 'getUniqueValues'])->name('proses-lain.getUniqueValues');
    Route::resource('permohonan', PermohonanController::class);
    Route::get('permohonan-data/getData', [PermohonanController::class, 'getData'])->name('permohonan-data.getData');
    Route::get('permohonan-data/getUniqueValues', [PermohonanController::class, 'getUniqueValues'])->name('permohonan-data.getUniqueValues');
    Route::post('get-no-standar', [AjaxController::class, 'get_standar_sni'])->name('get_standar_sni');
    Route::post('get-no-sertifikat', [AjaxController::class, 'get_no_sertifikat'])->name('get_no_sertifikat');
    Route::resource('permohonan_user', PermohonanUserController::class);
    Route::get('permohonan-user/getData', [PermohonanUserController::class, 'getData'])->name('permohonan-user.getData');
    Route::get('permohonan-user/getUniqueValues', [PermohonanUserController::class, 'getUniqueValues'])->name('permohonan-user.getUniqueValues');
    Route::resource('sertifikat', SeritifikatController::class);
    Route::get('sertifikat-data/getData', [SeritifikatController::class, 'getData'])->name('sertifikat-data.getData');
    Route::get('sertifikat-data/getUniqueValues', [SeritifikatController::class, 'getUniqueValues'])->name('sertifikat-data.getUniqueValues');
    Route::get('get-ruang-lingkup', [AjaxController::class, 'get_ruang_lingkup'])->name('get_ruang_lingkup');
    Route::resource('perencanaan', PerencanaanController::class);
    Route::get('perencanaan-data/getData', [PerencanaanController::class, 'getData'])->name('perencanaan-data.getData');
    Route::get('perencanaan-data/getUniqueValues', [PerencanaanController::class, 'getUniqueValues'])->name('perencanaan-data.getUniqueValues');
    Route::post('get-permohonan-client', [AjaxController::class, 'get_permohonan_client'])->name('get_permohonan_client');
    Route::post('get-permohonan-no-proses', [AjaxController::class, 'get_permohonan_no_proses'])->name('get_permohonan_no_proses');
    Route::post('no-proses-client-null', [AjaxController::class, 'no_proses_client_null'])->name('no_proses_client_null');
    Route::post('get-klien-where', [AjaxController::class, 'get_klien_where'])->name('get_klien_where');
    Route::resource('penugasan_personil', PenugasanPersonilController::class);
    Route::get('penugasan-data/getData', [PenugasanPersonilController::class, 'getData'])->name('penugasan-data.getData');
    Route::get('penugasan-data/getUniqueValues', [PenugasanPersonilController::class, 'getUniqueValues'])->name('penugasan-data.getUniqueValues');
    Route::get('get-mst-personil', [AjaxController::class, 'get_mst_personil'])->name('get_mst_personil');
    //Route::get('/penugasan_personil/{id}/edit', [PenugasanPersonilController::class, 'edit'])->name('penugasan_personil.edit');
});;
