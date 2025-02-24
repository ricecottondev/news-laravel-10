<?php

namespace App\Http\Controllers\Api\Mobile\Member\Notif;

use JWTAuth;
use App\Models\PromoUser;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Member as MemberModel;

class GetNotifMemberController extends Controller
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

        // $notif = Notification::where('member_id', $memberId)->where('notification_status', 'Unread')->count();

        $notifikasi = Notification::where('member_id', $memberId)
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();

        $jumlahUnread = $notifikasi->where('notification_status', 'Unread')->count();

        $promoUser = PromoUser::where('member_id', $memberId)
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();
        $jumlahUnreadPromo = $promoUser->where('promo_status', 'Unread')->count();


        $totalNotif = $jumlahUnread + $jumlahUnreadPromo;

        return response()->json([
            'success' => true,
            'message' => 'Get Total Notif',
            'totalNotif' => $totalNotif,
            'notif' =>  $jumlahUnread,
            'promo' => $jumlahUnreadPromo,
        ], 200);
    }
}
