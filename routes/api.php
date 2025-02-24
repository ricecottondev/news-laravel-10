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

#Merchant
use App\Http\Controllers\Api\Merchant\GetMerchantController;
use App\Http\Controllers\Api\Merchant\PostMerchantController;
use App\Http\Controllers\Api\Merchant\UpdateMerchantController;
use App\Http\Controllers\Api\Merchant\DeleteMerchantController;
use App\Http\Controllers\Api\Mobile\Merchant\GetMerchantController as GetMerchantMobileController;

#Promo
use App\Http\Controllers\Api\Setting_Web\UpdateImageBannerController;
use App\Http\Controllers\Api\Promo\GetPromoController;
#Uniquecode
use App\Http\Controllers\Api\Setting_Web\UpdateImageWebController;
#Voucher
use App\Http\Controllers\Api\Uniquecode\GetUniquecodeController;

#News
use App\Http\Controllers\Api\Vouchers\GetVouchersController;
use App\Http\Controllers\Api\News\GetNewsController;

#Setting Web
use App\Http\Controllers\Api\Vouchers\UpdateVoucherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

#Product Shop
use App\Http\Controllers\Api\ProductShop\GetProductShopController;
use App\Http\Controllers\Api\ProductShop\PostProductShopController;
use App\Http\Controllers\Api\ProductShop\UpdateProductShopController;
use App\Http\Controllers\Api\ProductShop\DeleteProductShopController;

#Brand
use App\Http\Controllers\Api\Brand\GetBrandController;
use App\Http\Controllers\Api\Brand\PostBrandController;
use App\Http\Controllers\Api\Brand\UpdateBrandController;
use App\Http\Controllers\Api\Brand\DeleteBrandController;

#Beranda
use App\Http\Controllers\Api\Beranda\GetBerandaController;

#Seacrh
use App\Http\Controllers\Api\Seacrh\GetSeacrhController;
use App\Http\Controllers\Api\Seacrh\PostSeacrhController;

#Offering
use App\Http\Controllers\Api\Offering\GetOfferingController;
use App\Http\Controllers\Api\Offering\PostOfferingController;
use App\Http\Controllers\Api\Offering\DeleteOfferingController;
use App\Http\Controllers\Api\Offering\UpdateOfferingController;

#Recommend
use App\Http\Controllers\Api\Recommend\GetRecommendController;
use App\Http\Controllers\Api\Recommend\PostRecommendController;
use App\Http\Controllers\Api\Recommend\UpdateRecommendController;
use App\Http\Controllers\Api\Recommend\DeleteRecommendController;

#Notification
use App\Http\Controllers\Api\Mobile\Member\Notif\GetNotifMemberController;
use App\Http\Controllers\Api\Mobile\Member\Notif\GetNotifListMemberController;
use App\Http\Controllers\Api\Mobile\Member\Notif\PostNotifByIdMemberController;
use App\Http\Controllers\Api\Mobile\Member\Notif\PostNotifMemberController;

#Promo
use App\Http\Controllers\Api\Mobile\Member\Promo\GetPromoListMemberController;
use App\Http\Controllers\Api\Mobile\Member\Promo\PostPromoByIdMemberController;


#Token
use App\Http\Controllers\Api\Member\UpdateTokenFirebaseController;

use App\Http\Controllers\Api\Notif\SendNotifMobile;
use App\Http\Controllers\Api\Member\MemberProfileController;
use App\Http\Controllers\Api\Mobile\Auth\LoginGoogleController;
use App\Http\Controllers\Api\Mobile\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Mobile\Jne\GetCityController;
use App\Http\Controllers\Api\Mobile\Jne\GetDistrictController;
use App\Http\Controllers\Api\Mobile\Jne\GetProvinceController;
use App\Http\Controllers\Api\Mobile\Jne\GetSubDistrictController;
use App\Http\Controllers\Api\Mobile\Promo\GetPromoController as PromoCollection;
use App\Http\Controllers\Api\Mobile\Member\Profil\PostProfilRequiredMemberController;
use App\Http\Controllers\Api\Mobile\Member\DataDiri\DataDiriMemberController;
use App\Http\Controllers\Api\Mobile\Member\Voucher\ActivateVoucherController;
use App\Http\Controllers\Api\MasterMerchant\Auth\RegisterMemberMerchantController;
use App\Http\Controllers\Api\MasterMerchant\Point\PostPointBonusController;













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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('apilogin', [ApiController::class, 'index']);

#AUTH
Route::post('/login', [ApiController::class, 'authenticate']);
Route::post('logout', [ApiController::class, 'logout']);
Route::post('register', [ApiController::class, 'register']);
Route::post('register-member', [RegisterMemberController::class, 'index']);
Route::post('OAuthGoogle', [LoginGoogleController::class, 'index']);
Route::post('forgetPassword', [ForgotPasswordController::class, 'submitForgetPasswordForm']);
Route::post('registerMemberMerchant', RegisterMemberMerchantController::class);
Route::post('postPointMerchant', PostPointBonusController::class);


#Members
Route::get('allmembers', [GetMemberController::class, 'index']);
Route::post('pointmember', [GetPointMemberController::class, 'index']);
Route::post('claimvouchermember', [ClaimVoucherMemberController::class, 'index']);
Route::post('vouchermember', [GetMemberVoucherController::class, 'index']);
Route::post('leadermember', [GetLeaderController::class, 'index']);
Route::post('updatepasswordmember', [UpdatePasswordMemberController::class, 'index']);
Route::post('updateimagemember', [UpdateImageMemberController::class, 'index']);
Route::post('updateusedvouchermember', [UpdateMemberVoucherController::class, 'index']);
Route::post('memberinfo', [GetMemberInfoController::class, 'index']);
Route::post('membermigration', [MigrationMemberController::class, 'index']);


#Merchant
Route::get('allmerchant', [GetMerchantController::class, 'index']);
#Promo
Route::get('allpromo', [GetPromoController::class, 'index']);
#Uniquecode
Route::post('uniquecode', [GetUniquecodeController::class, 'index']);
#Voucher
Route::get('allvouchers', [GetVouchersController::class, 'index']);


#News
Route::post('news', [GetNewsController::class, 'index']);

Route::get('member-profile', [MemberProfileController::class, 'index']);


#Setting Web
Route::post('updateimageweb', [UpdateImageWebController::class, 'index']);
Route::post('updateimagebanner', [UpdateImageBannerController::class, 'index']);

Route::post('updateMember', [UpdateMemberController::class, 'update']);
Route::post('updateimage', [UpdateMemberController::class, 'updateimage']);
Route::post('postmachines', [PostMachinesMemberController::class, 'store']);

#update status voucher
Route::post('updatestatusvoucher', [UpdateVoucherController::class, 'index']);

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('logout', [ApiController::class, 'logout']);
    Route::get('get_user', [ApiController::class, 'get_user']);

    #Beranda
    Route::get('getBeranda', [GetBerandaController::class, 'index']);

    #Brand
    Route::get('getBrand', [GetBrandController::class, 'index']);
    Route::post('postBrand', [PostBrandController::class, 'index']);
    Route::post('updateBrand', [UpdateBrandController::class, 'index']);
    Route::delete('deleteBrand', [DeleteBrandController::class, 'index']);

    #Offering
    Route::get('getOffering', [GetOfferingController::class, 'index']);
    Route::post('postOffering', [PostOfferingController::class, 'index']);
    Route::post('updateOffering', [UpdateOfferingController::class, 'index']);
    Route::delete('deleteOffering', [DeleteOfferingController::class, 'index']);

    #Recommend
    Route::get('getRecommend', [GetRecommendController::class, 'index']);
    Route::post('postRecommend', [PostRecommendController::class, 'index']);
    Route::post('updateRecommend', [UpdateRecommendController::class, 'index']);
    Route::delete('deleteRecommend', [DeleteRecommendController::class, 'index']);

    #Member
    Route::get('getVoucherMemberList', [GetMemberVoucherController::class, 'indexMobile']);
    Route::get('getLogPointMember', [GetLogPointMemberController::class, 'index']);
    Route::post('postClaimvouchermember', [ClaimVoucherMemberController::class, 'indexMobile']);
    Route::post('postUpdateProfil', [UpdateImageMemberController::class, 'indexMobile']);
    Route::post('updateDataDiri', PostProfilRequiredMemberController::class);
    Route::post('checkDataDiri', DataDiriMemberController::class);
    Route::post('aktifkanVoucher', ActivateVoucherController::class);

    #Voucher
    Route::get('getVouchersList', [GetVouchersController::class, 'IndexMobile']);

    #Point
    Route::post('postClaimPoint', [PostPointMemberController::class, 'Index']);
    #Token FIrebase
    Route::post('updateTokenFirebase', [UpdateTokenFirebaseController::class, 'Index']);

    //buatkan route post


    #Seacrh
    Route::post('postSearch', [PostSeacrhController::class, 'Index']);
    Route::get('getSearch', [GetSeacrhController::class, 'Index']);

    #List
    Route::get('getPromoNews', [GetNewsController::class, 'indexMobile']);

    #Notif
    Route::get('getNotif', GetNotifMemberController::class);
    Route::post('postNotifById', PostNotifByIdMemberController::class);
    Route::get('getNotifList', GetNotifListMemberController::class);
    Route::post('postNotifAll', PostNotifMemberController::class);


    #Promo
    Route::get('getPromoList', GetPromoListMemberController::class);
    Route::get('getPromo', PromoCollection::class);
    Route::post('postPromoById', PostPromoByIdMemberController::class);

    #FIREBASE
    Route::get('sendNotif', [SendNotifMobile::class, 'index']);

    #JNE
    Route::get('getCity', GetCityController::class);
    Route::get('getDistrict', GetDistrictController::class);
    Route::get('getProvince', GetProvinceController::class);
    Route::get('getSubDistrict', GetSubDistrictController::class);



    #Merchant
    Route::get('getMerchant', [GetMerchantController::class, 'indexMobile']);
    Route::get('getMerchantV2', [GetMerchantMobileController::class, 'index']);
    Route::post('postMerchant', [PostMerchantController::class, 'index']);
    Route::post('updateMerchant', [UpdateMerchantController::class, 'index']);
    Route::delete('deleteMerchant', [DeleteMerchantController::class, 'index']);

    #Product Shop
    Route::get('getProduct', [GetProductShopController::class, 'indexMobile']);
    // Route::get('getProductV2', [GetProductShopController::class, 'indexMobile']);
    Route::post('postProduct', [PostProductShopController::class, 'index']);
    Route::post('updateProduct', [UpdateProductShopController::class, 'index']);
    Route::delete('deleteProduct', [DeleteProductShopController::class, 'index']);
});
