<?php

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;


use App\Http\Controllers\ApiController;

#AUTH
use App\Http\Controllers\Api\Member\ClaimVoucherMemberController;
use App\Http\Controllers\Api\Member\RegisterMemberController;

#Member
use App\Http\Controllers\Api\Member\GetLeaderController;
use App\Http\Controllers\Api\Member\GetMemberController;
use App\Http\Controllers\Api\Member\GetMemberInfoController;
use App\Http\Controllers\Api\Member\GetMemberVoucherController;
use App\Http\Controllers\Api\Member\GetPointMemberController;
use App\Http\Controllers\Api\Member\MigrationMemberController;
use App\Http\Controllers\Api\Member\UpdateImageMemberController;
use App\Http\Controllers\Api\Member\UpdateMemberVoucherController;
use App\Http\Controllers\Api\Member\GetLogPointMemberController;
use App\Http\Controllers\Api\Member\PostPointMemberController;



#News
use App\Http\Controllers\Api\Vouchers\GetVouchersController;
use App\Http\Controllers\Api\News\GetNewsController;

#Setting Web
use App\Http\Controllers\Api\Vouchers\UpdateVoucherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



#Beranda
use App\Http\Controllers\Api\Beranda\GetBerandaController;




#Token
use App\Http\Controllers\Api\Member\UpdateTokenFirebaseController;






use App\Http\Controllers\Api\News\CategoryController;
use App\Http\Controllers\Api\News\NewsController;





/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

// Rute untuk kategori
Route::get('categories', [CategoryController::class, 'index']); // GET: Menampilkan semua kategori
Route::get('categories/{id}', [CategoryController::class, 'show']); // GET: Menampilkan kategori berdasarkan ID
Route::post('categories', [CategoryController::class, 'store']); // POST: Menambahkan kategori baru
Route::put('categories/{id}', [CategoryController::class, 'update']); // PUT: Memperbarui kategori berdasarkan ID
Route::delete('categories/{id}', [CategoryController::class, 'destroy']); // DELETE: Menghapus kategori berdasarkan ID

// Rute untuk berita
Route::get('news', [NewsController::class, 'index']); // GET: Menampilkan semua berita
Route::get('news/{id}', [NewsController::class, 'show']); // GET: Menampilkan berita berdasarkan ID
Route::post('news', [NewsController::class, 'store']); // POST: Menambahkan berita baru
Route::put('news/{id}', [NewsController::class, 'update']); // PUT: Memperbarui berita berdasarkan ID
Route::delete('news/{id}', [NewsController::class, 'destroy']); // DELETE: Menghapus berita berdasarkan ID


