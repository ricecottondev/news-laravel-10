<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Back\Onepoint;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;

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

use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Voucher\VoucherController;
use App\Http\Controllers\webhook\WebhookController;

use App\Http\Controllers\Back\CrudBuilderController;
use App\Http\Controllers\Product\CategoryController;
use App\Http\Controllers\Front\Jne\GetCityController;

use App\Http\Controllers\Front\Notif\NotifController;
use App\Http\Controllers\Merchant\MerchantController;


use App\Http\Controllers\Front\FrontLandingController;
use App\Http\Controllers\Front\FrontProductController;
use App\Http\Controllers\Member\MemberPointController;



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
use App\Http\Controllers\Koperasifront\FrontController;
use App\Http\Controllers\Member\MemberProfilController;
use App\Http\Controllers\Product\SubCategoryController;
use App\Http\Controllers\Front\FrontUniquecodeController;
use App\Http\Controllers\Front\Jne\GetDistrictController;
use App\Http\Controllers\Front\Jne\GetProvinceController;
use App\Http\Controllers\Member\RecomendMemberController;
use App\Http\Controllers\Member\ShoppingMemberController;
use App\Http\Controllers\Front\Jne\GetSubDistrictController;
use App\Http\Controllers\Front\MenuPromo\MenuPromoController;
use App\Http\Controllers\Member\ClaimVoucherMemberController;
use App\Http\Controllers\Product\ProductAdditionalController;
use App\Http\Controllers\Front\FrontCategoryProductController;
use App\Http\Controllers\Front\Member\CheckDataDiriController;
use App\Http\Controllers\Front\Member\VocuherMemberController;
use App\Http\Controllers\Front\Member\OfferingMemberController;

use App\Http\Controllers\Back\Permissions\PermissionsController;
use App\Http\Controllers\Back\Setting_web\Setting_webController;
use App\Http\Controllers\Front\Member\ActivateVoucherController;
use App\Http\Controllers\Front\Profil\ChangeNameProfilController;
use App\Http\Controllers\Back\Setting_menu\Setting_menuController;
use App\Http\Controllers\Front\Profil\ChangeImageProfilController;
use App\Http\Controllers\QrCode\TableGenerateUniqueCodeController;
use App\Http\Controllers\Back\OnepointUsers\GetTableUserController;
use App\Http\Controllers\Front\Member\PostProfilRequiredController;
use App\Http\Controllers\Front\Notif\PostNotifByIdMemberController;
use App\Http\Controllers\Front\Notif\PostPromoByIdMemberController;
use App\Http\Controllers\Back\Onepoint_brand\GetTableBrandController;
use App\Http\Controllers\Back\Onepoint_member\GetTableMemberController;
use App\Http\Controllers\Back\OnePopularSearch\PopularSearchController;
use App\Http\Controllers\Back\Onepoint_member\Onepoint_memberController;
use App\Http\Controllers\Back\OnepointProduct\GetTableProductController;
use App\Http\Controllers\Back\Onepoint_voucher\Onepoint_voucherController;
use App\Http\Controllers\Back\OnePointOffering\GetTableOfferingController;
use App\Http\Controllers\Back\Onepoint_merchant\GetTableMerchantController;
use App\Http\Controllers\Back\Onepoint_merchant\Onepoint_merchantController;
use App\Http\Controllers\Back\OnepointMenuPromo\GetTableMenuPromorController;
use App\Http\Controllers\Back\OnePointRecomendation\GetTableRecomendController;
use App\Http\Controllers\Back\OnePopularSearch\GetTablePopularSearchController;
use App\Http\Controllers\Back\Onepoint_uniquecode\Onepoint_uniquecodeController;
use App\Http\Controllers\Back\Onepoint_member\GetLogClaimVoucherMemberController;
use App\Http\Controllers\Back\OnepointLogVoucher\GetTableLogClaimVoucherController;
use App\Http\Controllers\Back\Onepoint_member\GetLogClaimUniquecodeMemberController;
use App\Http\Controllers\Back\OnepointSocialAccount\GetTableSocialAccountController;
use App\Http\Controllers\Back\OnepointLogClaimUniqueCode\GetTableLogClaimUniqueCodeController;



use App\Http\Controllers\Back\OnePointRecomendation\RecomendationController;
use App\Http\Controllers\Back\OnePointOffering\OfferingController;

use App\Http\Controllers\Back\OnepointLogClaimUniqueCode\LogClaimUniqueCodeController;
use App\Http\Controllers\Back\OnepointLogVoucher\LogClaimVoucherController;

use App\Http\Controllers\Back\OnepointMenuPromo\MenuPromorController;
use App\Http\Controllers\Back\OnepointSocialAccount\SocialAccountController;

use App\Http\Controllers\Back\AddMember\AddMemberController;
use App\Http\Controllers\QrCode\GenerateUniqueCodeController;

#Tampilan Saja
// Route::get('/register-new', function () {
//     return view('auth.registerNew');
// });
// Route::get('/login-new', function () {
//     return view('auth.loginNew');
// });
// Route::get('/landing-page', function () {
//     return view('auth.landing');
// });
// Route::get('/beranda', function () {
//     return view('page-sdamember.beranda');
// });
// Route::get('/profil-a', function () {
//     return view('page-sdamember.profil');
// });
// Route::get('/belanjaa', function () {
//     return view('page-sdamember.belanja');
// });
// Route::get('/merchant-page', function () {
//     return view('page-sdamember.merchant');
// });
// Route::get('/notif-page', function () {
//     return view('page-sdamember.notif');
// });
// Route::get('/voucher-page', function () {
//     return view('page-sdamember.voucher');
// });

Route::get('/detail-voucher', function () {
    return view('page-sdamember.snk');
});
Route::get('/request-delete-akun', function () {
    return view('page-sdamember.delete');
});
Route::get('/privacy-policy', function () {
    return view('page-sdamember.privacy');
});

Route::get('/crud', [CrudBuilderController::class, 'index'])->name('crud.index');
Route::post('/crud', [CrudBuilderController::class, 'index'])->name('crud.index');

Route::get('/apibuilder', [ApiBuilderController::class, 'index'])->name('apibuilder.index');
Route::post('/apibuilder', [ApiBuilderController::class, 'index'])->name('apibuilder.index');


// Route::get('/', [FrontLandingController::class, 'index'])->name('landing');
Route::get('/', function () {
    return view('auth.landing');
})->middleware('guest');


Route::get('generate-qr-member/{id}', [PageQrController::class, 'index']);
Route::get('generate-qr-admin/{id}', [PageQrController::class, 'admin']);
Route::get('fcategoryproduct', [FrontCategoryProductController::class, 'index'])->name('fcategoryproduct.index');
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
Route::get('/crudbuilder', [CrudBuilderController::class, 'index']);
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


Route::get('/memberaddress', [App\Http\Controllers\Member\MemberAddressBoardController::class, 'index'])->name('memberaddress.list');;
Route::post('/memberaddress', [App\Http\Controllers\Member\MemberAddressBoardController::class, 'store'])->name('memberaddress.store');;

Route::post('loginas', [UserController::class, 'loginas'])->name('users.loginas');
Route::get('loginas', [UserController::class, 'loginas'])->name('users.loginas');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route::resource('admin/dashboard', DashboardController::class);
    Route::resource('admin/websetup', WebsetupController::class);
    Route::resource('fpdf', FpdfController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    Route::resource('news', NewsController::class);
    Route::resource('newscategory', NewsCategoryController::class);
    Route::resource('permissions', PermissionsController::class);

    Route::resource('admin/brand', BrandController::class);
    Route::resource('admin/category', CategoryController::class);
    Route::resource('admin/subcategory', SubCategoryController::class);
    Route::resource('admin/additionalproduct', AdditionalProductController::class);
    Route::resource('admin/product', ProductController::class);

    #Jne
    Route::get('/get-province', GetProvinceController::class)->name('getjne');
    Route::get('/get-city', GetCityController::class)->name('getcity');
    Route::get('/get-district', GetDistrictController::class)->name('getdistrict');
    Route::get('/get-sub-district', GetSubDistrictController::class)->name('getsubdistrict');

    Route::post('/notifications/mark-as-read/{id}', PostNotifByIdMemberController::class)->name('notif.markread');
    Route::post('/promo/mark-as-read/{id}', PostPromoByIdMemberController::class)->name('promo.markread');

    Route::get('/notifikasi', [NotifController::class, 'index'])->name('notifikasi.index');
    Route::get('/belanja', [ShoppingMemberController::class, 'index'])->name('belanja.index');
    Route::get('/promo', [MenuPromoController::class, 'index'])->name('promo.index');
    Route::get('/merchants', [MerchantController::class, 'index'])->name('merchant.index');
    Route::get('/voucher', [VoucherController::class, 'index'])->name('voucher.index');
    Route::get('/profil', [MemberProfilController::class, 'index'])->name('profil.index');
    Route::post('/klaim-point', [MemberPointController::class, 'index'])->name('klaimpoint.index');
    Route::post('/klaim-voucher', [ClaimVoucherMemberController::class, 'index'])->name('klaimvoucher.index');
    Route::get('/rekomendasi', [RecomendMemberController::class, 'index'])->name('recomendations.index');
    Route::get('/penawaran', [OfferingMemberController::class, 'index'])->name('penawaran.index');
    Route::get('/search/{keyword?}', [SearchController::class, 'index'])->name('search.index');
    Route::post('/change-profil', [ChangeImageProfilController::class, 'index'])->name('changeprofil.index');
    Route::post('/change-name-profil', [ChangeNameProfilController::class, 'index'])->name('changeNameProfil.index');
    Route::get('/member-voucher', [VocuherMemberController::class, 'index'])->name('member-voucher.index');
    Route::post('/gunakan-voucher', ActivateVoucherController::class)->name('gunakan-voucher');

    Route::get('/check-data-diri', [CheckDataDiriController::class, 'index'])->name('check-data-diri.index');
    Route::post('/post-data-diri', PostProfilRequiredController::class)->name('post.datadiri');

    Route::get('/menu', [FrontProductController::class, 'menu'])->name('menu.index');
    Route::get('/submenu', [FrontProductController::class, 'submenu'])->name('submenu.index');

    Route::get('/cart', [FrontCartController::class, 'cartList'])->name('cart.list');
    Route::post('fcart', [FrontCartController::class, 'addToCart'])->name('cart.store');
    Route::post('fcart-modal', [FrontCartController::class, 'addToCartModal'])->name('cartmodal.store');
    Route::post('update-cart', [FrontCartController::class, 'updateCart'])->name('cart.update');
    Route::post('update-cart-gifting', [FrontCartController::class, 'updateCartGifting'])->name('cart.update.gifting');
    Route::post('remove', [FrontCartController::class, 'removeCart'])->name('cart.remove');
    Route::post('clear', [FrontCartController::class, 'clearAllCart'])->name('cart.clear');
    Route::post('cart-update-discount', [FrontCartController::class, 'updateDiscountCart'])->name('cart.updatediscount');

    Route::get('/cart', [FrontCartController::class, 'cartList'])->name('cart.list');
    Route::post('/checkout', [FrontCheckoutController::class, 'index'])->name('checkout.list');
    // Route::post('/checkout', [FrontCheckoutController::class, 'index'])->name('checkout.list');


    Route::resource('onepoint_recomendation',RecomendationController::class);
    Route::resource('onepoint_offering',OfferingController::class);
    Route::resource('onepoint_popularsearch',PopularSearchController::class);
    Route::resource('onepoint_user',UserController::class);
    Route::resource('onepoint_log/claim_uniquecode',LogClaimUniqueCodeController::class);
    Route::resource('onepoint_log/claim_voucher',LogClaimVoucherController::class);
    Route::resource('onepoint_product',ProductController::class);
    Route::resource('onepoint_menu_promo',MenuPromorController::class);
    Route::resource('onepoint_social_accounts',SocialAccountController::class);
    Route::resource('onepoint_brand',BrandController::class);
    Route::resource('add_member',AddMemberController::class);
    Route::resource('uniquecode_member',GenerateUniqueCodeController::class);


    //Route::get('/logclaimuniquecodemember/{idmember}', [GetLogClaimUniquecodeMemberController::class, 'index'])->name('getlogclaimuniquecodemember.index');
    //Route::resource('logclaimvouchermember', GetLogClaimVoucherMemberController::class);

    //Recomended

});

##ROUTE FOR ADMIN ONLY

Route::group(['middleware' => ['auth', 'isAdmin']], function () {

    Route::get('/funiquecode', [FrontUniquecodeController::class, 'index'])->name('funiquecode.index');


    Route::get('/listlogclaimvouchermember/{idmember}', [GetLogClaimVoucherMemberController::class, 'index'])->name('logclaimvouchermember.index');
    Route::get('/createlogclaimvouchermember/{idmember}', [GetLogClaimVoucherMemberController::class, 'create'])->name('logclaimvouchermember.create');
    Route::post('/storelogclaimvouchermember', [GetLogClaimVoucherMemberController::class, 'store'])->name('logclaimvouchermember.store');

    Route::get('/listlogclaimuniquecodemember/{idmember}', [GetLogClaimUniquecodeMemberController::class, 'index'])->name('logclaimuniquecodemember.index');
    Route::get('/createlogclaimuniquecodemember/{idmember}', [GetLogClaimUniquecodeMemberController::class, 'create'])->name('logclaimuniquecodemember.create');
    Route::post('/storelogclaimuniquecodemember', [GetLogClaimUniquecodeMemberController::class, 'store'])->name('logclaimuniquecodemember.store');




    Route::get('/recomended-table', [GetTableRecomendController::class, 'index'])->name('recomended.table');
    Route::post('recomend-delete/{id}', [GetTableRecomendController::class, 'destroy'])->name('recomended.destroy');

    Route::get('/offering-table', [GetTableOfferingController::class, 'index'])->name('offering.table');
    Route::post('offering-delete/{id}', [GetTableOfferingController::class, 'destroy'])->name('offering.destroy');

    Route::get('/member-table', [GetTableMemberController::class, 'index'])->name('member.table');
    Route::get('/member-table-manager', [GetTableMemberController::class, 'addmember'])->name('member.table.manager');
    Route::post('member-delete/{id}', [GetTableMemberController::class, 'destroy'])->name('member.destroy');

    Route::get('/member-uniquecode-table', [TableGenerateUniqueCodeController::class, 'index'])->name('uniquecode.member.table');

    Route::get('/popularsearch-table', [GetTablePopularSearchController::class, 'index'])->name('popularsearch.table');
    Route::post('popularsearch-delete/{id}', [GetTablePopularSearchController::class, 'destroy'])->name('popularsearch.destroy');


    Route::get('/user-table', [GetTableUserController::class, 'index'])->name('user.table');
    Route::post('user-delete/{id}', [GetTableUserController::class, 'destroy'])->name('user.destroy');
    Route::get('/generate-qr/{id}', [Onepoint_memberController::class, 'GenerateQr'])->name('generate.qr');
    Route::get('/generate-qr-all', [Onepoint_memberController::class, 'GenerateQrAll'])->name('generate.qr.all');
    Route::get('/brand-table', [GetTableBrandController::class, 'index'])->name('brand.table');
    Route::post('brand-delete/{id}', [GetTableBrandController::class, 'destroy'])->name('brand.destroy');

    Route::get('/log-claim-uniquecode-table', [GetTableLogClaimUniqueCodeController::class, 'index'])->name('log-claim-uniquecode.table');
    Route::get('/log-claim-vouhcer-table', [GetTableLogClaimVoucherController::class, 'index'])->name('log-claim-vouhcer.table');

    Route::get('/product-table', [GetTableProductController::class, 'index'])->name('product.table');
    Route::post('product-delete/{id}', [GetTableProductController::class, 'destroy'])->name('product.destroy');

    Route::get('/menu-promo-table', [GetTableMenuPromorController::class, 'index'])->name('menupromo.table');
    Route::post('menu-promo-delete/{id}', [GetTableMenuPromorController::class, 'destroy'])->name('menupromo.destroy');

    Route::get('/social-account-table', [GetTableSocialAccountController::class, 'index'])->name('socialaccount.table');
    Route::post('social-account-delete/{id}', [GetTableSocialAccountController::class, 'destroy'])->name('socialaccount.destroy');

    Route::get('/merchant-table', [GetTableMerchantController::class, 'index'])->name('merchant.table');
    Route::post('merchant-delete/{id}', [GetTableMerchantController::class, 'destroy'])->name('merchant.destroy');

Route::resource('onepoint_member',Onepoint_memberController::class);
Route::resource('onepoint_uniquecode',Onepoint_uniquecodeController::class);
Route::resource('onepoint_merchant',Onepoint_merchantController::class);
Route::resource('onepoint_voucher',Onepoint_voucherController::class);
// Route::resource('onepoint_log_claim_uniquecode',Onepoint_log_claim_uniquecodeController::class);
Route::resource('onepoint_recomendation',RecomendationController::class);
Route::resource('onepoint_offering',OfferingController::class);
Route::resource('onepoint_popularsearch',PopularSearchController::class);
Route::resource('onepoint_user',UserController::class);
Route::resource('onepoint_log/claim_uniquecode',LogClaimUniqueCodeController::class);
Route::resource('onepoint_log/claim_voucher',LogClaimVoucherController::class);
Route::resource('onepoint_product',ProductController::class);
Route::resource('onepoint_menu_promo',MenuPromorController::class);
Route::resource('onepoint_social_accounts',SocialAccountController::class);
Route::resource('onepoint_brand',BrandController::class);
Route::resource('add_member',AddMemberController::class);
Route::resource('uniquecode_member',GenerateUniqueCodeController::class);


    // $res_setting_route = DB::select('select * from setting_route where deleted = "false"');

    // for ($r = 0; $r < count($res_setting_route); $r++) {
    //     Route::resource($res_setting_route[$r]->route_name, $res_setting_route[$r]->controller_name);
    // }

    // $dataresource = array(
    //     ["setting_menu", "Setting_menuController::class"],
    //     ["permissions", "PermissionsController::class"],

    // );
});




// generateuniquecode
Route::post('generateuniquecode', [Onepoint_uniquecode\Onepoint_uniquecodeController::class, 'generatecode'])->name('uniquecode.generate');

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
