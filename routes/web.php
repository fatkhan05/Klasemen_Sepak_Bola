
<?php

use App\Http\Controllers\ClubController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KlasemenController;
use Illuminate\Database\Query\IndexHint;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(array('prefix' => 'data-club'), function () {
    Route::get('/', [ClubController::class, 'index'])->name('data-club');
    Route::post('/form', [ClubController::class, 'form'])->name('club-form');
    Route::post('/store', [ClubController::class, 'store'])->name('club-store');
});

Route::group(array('prefix' => 'data-klasemen'), function () {
    Route::get('/', [KlasemenController::class, 'index'])->name('data-klasemen');
    Route::post('/form', [KlasemenController::class, 'form'])->name('form-tambah-data');
    Route::post('/store', [KlasemenController::class, 'store'])->name('klasemen-store');
    Route::post('/destroy', [KlasemenController::class, 'destroy'])->name('klasemen-destroy');
});