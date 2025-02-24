<?php

namespace App\Http\Controllers\Api\Mobile\Member\Notif;

use JWTAuth;
use App\Models\Member;
use App\Models\PromoUser;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostNotifMemberController extends Controller
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
        $memberId = Member::where('email', $userEmail)->first()->id;

        $notifications = Notification::where('member_id', $memberId)
            ->where('notification_status', 'Unread')
            ->get();

        $notifikasi = Notification::where('member_id', $memberId)
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();

        $jumlahUnread = $notifikasi->where('notification_status', 'Unread')->count();
        $promo = PromoUser::where('member_id', $memberId)->count();
        $totalNotif = $jumlahUnread + $promo;

        if ($notifications->count() > 0) {
            Notification::where('member_id', $memberId)
                ->where('notification_status', 'Unread')
                ->update(['notification_status' => 'Read']);

            return response()->json([
                'success' => true,
                'message' => 'Status notifikasi berhasil diubah menjadi Read',
                'notif' => $jumlahUnread,
                'totalNotif' => $totalNotif,
            ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Tidak ada notifikasi yang belum dibaca'
            ]);
        }
    }
}
