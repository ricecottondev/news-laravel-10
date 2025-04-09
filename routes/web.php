<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\FrontHomeController;
use App\Http\Controllers\Front\FrontNewsController;
use App\Http\Controllers\StripeController;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Front\FrontSubscribesController;

use App\Http\Controllers\Front\NewsCommentController;


use App\Http\Controllers\WebsetupController;
// use App\Http\Controllers\RoleController;
// use App\Http\Controllers\UserController;
// use App\Http\Controllers\PermissionController;
// use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Back\UserController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Product\BrandController;
use App\Http\Controllers\QrCode\PageQrController;
use App\Http\Controllers\Auth\SocialiteController;

use App\Http\Controllers\Back\DashboardController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Auth\UserVerifyController;


use App\Http\Controllers\Back\ApiBuilderController;
use App\Http\Controllers\Front\FrontCartController;


use App\Http\Controllers\Front\FrontLandingController;


use App\Http\Controllers\FpdfController;

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Front\FrontCheckoutController;

use App\Http\Controllers\Back\DeepSeekChatController;
use App\Http\Controllers\Back\Subscribe\SubscribeController;

use App\Http\Controllers\AccountDeletionController;



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

use App\Http\Controllers\Front\Search\SearchController;

use App\Http\Controllers\Member\MemberProfilController;


use App\Http\Controllers\Back\Permissions\PermissionsController;
use App\Http\Controllers\Back\Setting_web\Setting_webController;
use App\Http\Controllers\Front\Member\ActivateVoucherController;
use App\Http\Controllers\Front\Profil\ChangeNameProfilController;
use App\Http\Controllers\Back\Setting_menu\Setting_menuController;
use App\Http\Controllers\Front\Profil\ChangeImageProfilController;


use App\Http\Controllers\Front\Member\PostProfilRequiredController;



use App\Http\Controllers\Back\OnepointSocialAccount\SocialAccountController;



use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Back\Categories\CategoryController;
use App\Http\Controllers\Back\News\NewsController;
use App\Http\Controllers\Back\Country\CountryController;

use App\Http\Controllers\Back\ChatGPTController;


Route::get('/detail-voucher', function () {
    return view('page-sdamember.snk');
});


Route::get('/request-delete-akun', function () {
    return view('page-sdamember.delete');
});

Route::post('/request-delete-account', [AccountDeletionController::class, 'requestDeletion'])->name('request-delete-account');

Route::get('/privacy-policy', function () {
    return view('page-sdamember.privacy');
});



Route::get('/apibuilder', [ApiBuilderController::class, 'index'])->name('apibuilder.index');
Route::post('/apibuilder', [ApiBuilderController::class, 'index'])->name('apibuilder.index');





//===================================================================================================front start===================================================================================================
Route::get('/', [FrontHomeController::class, 'index'])->name('home.index');
Route::get('/index', [FrontHomeController::class, 'index'])->name('home.index');
Route::get('/home', [FrontHomeController::class, 'index'])->name('home');
// ->middleware('guest');
Route::get('/login', [FrontHomeController::class, 'login'])->name('home.login');
// Route::get('/news',[FrontNewsController::class, 'index'])->name('home.index');


Route::get('/news', [FrontNewsController::class, 'index'])->middleware('limit.news')->name('home.index');

Route::get('/news/{slug}', [FrontNewsController::class, 'show'])->name('front.news.show');
Route::get('/newscategory/{category}', [FrontNewsController::class, 'shownewsbycategory'])->name('front.news.shownewsbycategory');

Route::get('/{country}/newscategory/{category}', [FrontNewsController::class, 'shownewsbycategoryandCountry'])->name('front.news.shownewsbycategoryandCountry');
Route::get('/{country}/news', [FrontNewsController::class, 'shownewsbyCountry'])->name('front.news.shownewsbyCountry');

Route::get('/search', [FrontNewsController::class, 'search'])->name('news.search');

Route::post('/news/{id}/comment', [NewsCommentController::class, 'store'])->name('news.comment');

//Route::post('/comments', [NewsCommentController::class, 'store'])->name('comments.store');
// Route::get('/subscribes',[FrontHomeController::class, 'subscribes'])->name('home.subscribes');
Route::get('/subscribes', function () {

    if (auth()->check()) {
        return view('front.subscribes.checkout');
    } else {
        return redirect()->route('login');
    }
})->name('subscribe');

Route::post('/checkout/session', [FrontSubscribesController::class, 'createCheckoutSession'])->name('checkout.session');
Route::get('/success', function () {
    return view('front.subscribes.success');
})->name('success.page');
Route::post('/billing-portal', [StripeController::class, 'billingPortal'])->name('billing.portal');

Route::get('/about', function () {
    return view('front.about');
});

Route::get('/privacy-policy', function () {
    return view('front.privacy_policy');
});

Route::get('/editorial-policy', function () {
    return view('front.editorial_policy');
});


//===================================================================================================front end===================================================================================================




Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('/email/verify/{token}', UserVerifyController::class)->name('user.verify');
Route::post('register-member', [RegisterController::class, 'store'])->name('registerstore');


Auth::routes();
Route::get('/auth/{provider}', [SocialiteController::class, 'redirectToProvider']);
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'handleProvideCallback']);


Route::get('/request-delete-account', function () {
    return view('front.request_member_delete');
});


Route::get('file', [FileController::class, 'create']);
Route::post('file', [FileController::class, 'store']);
// Route::get('/index', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/news', [App\Http\Controllers\NewsController::class, 'index']);
Route::get('/news', [App\Http\Controllers\NewsController::class, 'index']);

// Route::get('/get-categories/{country_id}', [CategoryController::class, 'getCategories']);



Route::get('/setting_web', [App\Http\Controllers\Back\Setting_web\SettingWebController::class, 'index']);

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('back/news/import', [NewsController::class, 'importForm'])->name('news.import.form');
Route::get('back/news/bulkcreate', [NewsController::class, 'bulkForm'])->name('news.bulk-form');

Route::post('loginas', [UserController::class, 'loginas'])->name('users.loginas');
Route::get('loginas', [UserController::class, 'loginas'])->name('users.loginas');


Route::group(['middleware' => ['auth']], function () {
    Route::get('/back/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Rute untuk Users
    Route::resource('back/users', UserController::class);
    // Rute untuk Country
    Route::resource('back/country', CountryController::class);
    // Rute untuk cateqgory
    Route::resource('back/categories', CategoryController::class);
    // Rute untuk berita
    Route::resource('back/news', NewsController::class);


    Route::post('back/news/import', [NewsController::class, 'import'])->name('news.import');


    // Rute untuk subscribe
    Route::resource('back/subscribe', SubscribeController::class);

    Route::resource('fpdf', FpdfController::class);
    Route::resource('roles', RoleController::class);


    Route::get('/back/profil', [MemberProfilController::class, 'index'])->name('profil.index');


    Route::resource('back/permissions', PermissionsController::class);

    Route::get('/back/chat-gpt', [ChatGPTController::class, 'index'])->name('chat-gpt.index');

    Route::get('/back/deepseekchat', [DeepSeekChatController::class, 'index'])->name('deepseekchat.form');

    // Rute untuk mengirim prompt
    Route::post('/back/deepseekchat/send', [DeepSeekChatController::class, 'sendPrompt'])->name('deepseekchat.send');
});

##ROUTE FOR ADMIN ONLY

Route::group(['middleware' => ['auth', 'isAdmin']], function () {});




// ============================================ UI TEMPLATE

Route::get('/waiters/', function () {
    return view('waiters/landing', [
        "title" => "Welcome",
        "pages" => "landing"
    ]);
});

Route::get('/waiters/menu', function () {
    return view('waiters/menu', [
        "title" => "Our Menu",
        "pages" => "menu"
    ]);
});

Route::get('/waiters/order', function () {
    return view('waiters/order', [
        "title" => "Order",
        "pages" => "order"
    ]);
});

Route::get('/waiters/checkout', function () {
    return view('waiters/checkout', [
        "res_allproduct" => "",
        "title" => "checkout",
        "pages" => "checkout"
    ]);
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
