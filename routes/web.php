<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Back\Onepoint;
use App\Http\Controllers\HomeController;


use App\Http\Controllers\RoleController;
use App\Http\Controllers\PaymentController;

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

use App\Http\Controllers\Back\AddMember\AddMemberController;
use App\Http\Controllers\QrCode\GenerateUniqueCodeController;

use App\Http\Controllers\Admin\FileController;

use App\Http\Controllers\Back\Categories\CategoryController;
use App\Http\Controllers\Back\News\NewsController;
use App\Http\Controllers\Back\Country\CountryController;




Route::get('/detail-voucher', function () {
    return view('page-sdamember.snk');
});
Route::get('/request-delete-akun', function () {
    return view('page-sdamember.delete');
});
Route::get('/privacy-policy', function () {
    return view('page-sdamember.privacy');
});



Route::get('/apibuilder', [ApiBuilderController::class, 'index'])->name('apibuilder.index');
Route::post('/apibuilder', [ApiBuilderController::class, 'index'])->name('apibuilder.index');


// Route::get('/', [FrontLandingController::class, 'index'])->name('landing');
Route::get('/', function () {
    return view('auth.landing');
})->middleware('guest');



Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('/email/verify/{token}', UserVerifyController::class)->name('user.verify');
Route::post('register-member', [RegisterController::class, 'store'])->name('registerstore');


Auth::routes();
Route::get('/auth/{provider}', [SocialiteController::class, 'redirectToProvider']);
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'handleProvideCallback']);





Route::get('file', [FileController::class, 'create']);
Route::post('file', [FileController::class, 'store']);
Route::get('/index', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/news', [App\Http\Controllers\NewsController::class, 'index']);
Route::get('/news', [App\Http\Controllers\NewsController::class, 'index']);
Route::get('/setting_web', [App\Http\Controllers\Back\Setting_web\SettingWebController::class, 'index']);

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


// Route::get('/memberaddress', [App\Http\Controllers\Member\MemberAddressBoardController::class, 'index'])->name('memberaddress.list');;
// Route::post('/memberaddress', [App\Http\Controllers\Member\MemberAddressBoardController::class, 'store'])->name('memberaddress.store');;

Route::post('loginas', [UserController::class, 'loginas'])->name('users.loginas');
Route::get('loginas', [UserController::class, 'loginas'])->name('users.loginas');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route::resource('admin/dashboard', DashboardController::class);
    // Route::resource('admin/websetup', WebsetupController::class);
    Route::resource('fpdf', FpdfController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    // Rute untuk kategori
    Route::resource('categories', CategoryController::class);

    Route::resource('country', CountryController::class);

    // Rute untuk berita
    Route::resource('news', NewsController::class);
    Route::resource('permissions', PermissionsController::class);
});

##ROUTE FOR ADMIN ONLY

Route::group(['middleware' => ['auth', 'isAdmin']], function () {



    // $res_setting_route = DB::select('select * from setting_route where deleted = "false"');

    // for ($r = 0; $r < count($res_setting_route); $r++) {
    //     Route::resource($res_setting_route[$r]->route_name, $res_setting_route[$r]->controller_name);
    // }

    // $dataresource = array(
    //     ["setting_menu", "Setting_menuController::class"],
    //     ["permissions", "PermissionsController::class"],

    // );
});




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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
