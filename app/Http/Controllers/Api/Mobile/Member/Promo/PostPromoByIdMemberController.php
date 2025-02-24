<?php

namespace App\Http\Controllers\Api\Mobile\Member\Promo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member as MemberModel;
use App\Models\Notification;
use App\Models\PromoUser;
use JWTAuth;


class PostPromoByIdMemberController extends Controller
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
        $notificationId =  $request->id;

        $promoUserUpdate = PromoUser::where('id', $notificationId)
            ->where('member_id', $memberId)
            ->where('promo_status', 'Unread')
            ->first();




        $notifikasi = Notification::where('member_id', $memberId)
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();
        $jumlahUnreadNotif = $notifikasi->where('notification_status', 'Unread')->count();



        if ($promoUserUpdate) {
            $promoUserUpdate->promo_status = 'Read';
            $promoUserUpdate->save();

            $promoUser = PromoUser::where('member_id', $memberId)
                ->orderBy('created_at', 'desc')
                ->take(20)
                ->get();
            $jumlahUnreadPromo = $promoUser->where('promo_status', 'Unread')->count();

            $totalNotif = $jumlahUnreadPromo + $jumlahUnreadNotif;

            return response()->json([
                'success' => true,
                'message' => 'Status Promo berhasil diubah menjadi Read',
                'promo' => $jumlahUnreadPromo,
                'totalNotif' => $totalNotif,
            ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Promo tidak ditemukan atau statusnya sudah Read'
            ]);
        }
    }
}
