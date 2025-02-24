<?php

namespace App\Http\Controllers\Api\Mobile\Member\Promo;

use JWTAuth;
use App\Models\PromoUser;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Member as MemberModel;

class GetPromoListMemberController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {


        $user = JWTAuth::parseToken()->authenticate();
        $userEmail = $user->email;
        $memberId = MemberModel::where('email', $userEmail)->first()->id;

        $promo = PromoUser::select('onepoint_promo_users.id', 'promo_name as title', 'promo_desc  as content', 'onepoint_promo_users.created_at as date', 'promo_status as status')->join('onepoint_promo_notif', 'onepoint_promo_users.promo_notif_id', '=', 'onepoint_promo_notif.id')
            ->where('onepoint_promo_users.member_id', $memberId)->orderBy('onepoint_promo_users.created_at', 'desc')->take(20)->get();

        foreach ($promo as $key => $value) {
            $promo[$key]['tag'] = 'promo';
        }

        return response()->json([
            'success' => true,
            'message' => 'Get List Promo',
            'promo' => $promo,
        ], 200);
    }
}
