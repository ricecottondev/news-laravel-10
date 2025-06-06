<?php

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Api\Mobile\Auth\LoginGoogleController;
use App\Http\Controllers\Api\Mobile\Auth\ForgotPasswordController;

#AUTH
use App\Http\Controllers\Api\Member\ClaimVoucherMemberController;
use App\Http\Controllers\Api\Member\RegisterMemberController;

#User
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\User\UserUdidController;

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
use App\Http\Controllers\Api\News\CountryController;
use App\Http\Controllers\Api\News\NewsCommentController;
use App\Http\Controllers\Api\News\CountryCategoryNewsController;


#Firebase
use App\Http\Controllers\NotificationController;


use App\Http\Controllers\Api\Subscribes\SubscribesController;

use App\Http\Controllers\Front\ContributorSignupController;








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


 Route::post('apilogin', [ApiController::class, 'index']);

 Route::post('/contributor-signup', [ContributorSignupController::class, 'store']);


 #AUTH
Route::post('login', [ApiController::class, 'authenticate']);
Route::post('logout', [ApiController::class, 'logout']);
Route::post('register', [ApiController::class, 'register']);
Route::post('register-member', [RegisterMemberController::class, 'index']);
Route::post('OAuthGoogle', [LoginGoogleController::class, 'index']);
Route::post('forgetPassword', [ForgotPasswordController::class, 'submitForgetPasswordForm']);

#User
Route::get('getProfile', [UserController::class, 'getProfile']);
Route::post('postEditProfile', [UserController::class, 'postEditProfile']);
Route::post('postUUID', [UserController::class, 'postUUID']);
Route::post('postFirebase', [UserController::class, 'postFirebase']);
Route::post('postUserSelectionCategory', [UserController::class, 'postUserSelectionCategory']);



Route::post('postUDID', [UserUdidController::class, 'postUDID']);

// Rute untuk kategori
Route::get('getAllCategories', [CategoryController::class, 'index']); // GET: Menampilkan semua kategori
Route::get('getFullCategory', [CategoryController::class, 'getFullCategory']);
Route::get('categories/{id}', [CategoryController::class, 'show']); // GET: Menampilkan kategori berdasarkan ID
Route::post('postCategory', [CategoryController::class, 'store']); // POST: Menambahkan kategori baru
Route::post('postBatchCategory', [CategoryController::class, 'batchstore']); // POST: Menambahkan kategori baru
Route::put('categories/{id}', [CategoryController::class, 'update']); // PUT: Memperbarui kategori berdasarkan ID
Route::delete('categories/{id}', [CategoryController::class, 'destroy']); // DELETE: Menghapus kategori berdasarkan ID
Route::get('getCategories', [CategoryController::class, 'categoriesWithNews']);


// Rute untuk berita
Route::get('getAllNews', [NewsController::class, 'index']); // GET: Menampilkan semua berita
Route::get('getDetailNews', [NewsController::class, 'show']); // GET: Menampilkan berita berdasarkan ID
Route::post('news', [NewsController::class, 'store']); // POST: Menambahkan berita baru
Route::put('news/{id}', [NewsController::class, 'update']); // PUT: Memperbarui berita berdasarkan ID
Route::delete('news/{id}', [NewsController::class, 'destroy']); // DELETE: Menghapus berita berdasarkan ID
Route::get('getSearchNews', [NewsController::class, 'getSearchNews']);
Route::get('getBreakingNews', [NewsController::class, 'getBreakingNews']);
Route::get('getNewsVoice', [NewsController::class, 'getNewsVoice']);
Route::post('back/news/bulk-save', [NewsController::class, 'bulkStore'])->name('news.bulk-save');




// Rute untuk country
Route::get('getAllCountries', [CountryController::class, 'index']); // GET: Menampilkan semua country

Route::get('getAllCountry', function () {
    $countries = \App\Models\Country::orderBy('country_name', 'asc')->get();
    return response()->json($countries);
});


Route::get('getCategoriesCountry', [CountryController::class, 'getCategorieCountry']); // GET: Menampilkan semua country

Route::get('/get-categories/{country_id}', function ($country_id) {
    $categories = \App\Models\CountriesCategories::where('country_id', $country_id)
        ->with('category')
        ->get()
        ->pluck('category');

    return response()->json($categories);
});

Route::post('/postComment', [NewsCommentController::class, 'postComment']); // Post comment
Route::get('/getComment', [NewsCommentController::class, 'getComment']); // Get comment
Route::post('/postTrackVisit', [\App\Http\Controllers\Api\News\MobileVisitController::class, 'trackVisit']);




Route::post('/SaveDataCountriesCategoriesNews', [CountryCategoryNewsController::class, 'SaveDataCountriesCategoriesNews']);
Route::get('/getSavedDataCountriesCategoriesNews/{id}', [CountryCategoryNewsController::class, 'getSavedDataCountriesCategoriesNews']);
Route::delete('/deleteDataCountriesCategoriesNews/{id}', [CountryCategoryNewsController::class, 'deleteDataCountriesCategoriesNews']);





#Firebase
Route::post('/send-notification', [NotificationController::class, 'send']);

#Reset-Limit
Route::post('/reset-limit', [App\Http\Controllers\Api\User\UserController::class, 'resetlimit']);


Route::post('/api-checkout/session', [App\Http\Controllers\Api\Subscribes\SubscribesController::class, 'CheckoutSession']);
