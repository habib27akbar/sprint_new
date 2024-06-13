<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KlienController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RegistController;

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

Route::get('captcha', 'CaptchaController@showCaptcha');
Route::resource('regist', RegistController::class);
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
    Route::get('/unique-values', [KlienController::class, 'getUniqueValues'])->name('data-klien.getUniqueValues');
    //Route::get('data-klien/getUniqueValues', [KlienController::class, 'getUniqueValues'])->name('data-klien.getUniqueValues');
    //Route::get('/unique-values', [KlienController::class, 'getUniqueValues'])->name('data-klien.getUniqueValues');
});;
