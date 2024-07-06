<?php

use App\Http\Controllers\AjaxController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KlienController;
use App\Http\Controllers\PemeriksaanRegistrasiController;
use App\Http\Controllers\PerjanjianSertifikasiController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RegistController;
use App\Http\Controllers\SkemaSertifikasiController;

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
});;
