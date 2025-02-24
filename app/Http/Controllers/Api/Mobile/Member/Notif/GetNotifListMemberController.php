<?php

namespace App\Http\Controllers\Api\Mobile\Member\Notif;

use JWTAuth;
use App\Models\PromoUser;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Member as MemberModel;

class GetNotifListMemberController extends Controller
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


        $notif = Notification::select('id', 'notification_title as title', 'notification_content as content', 'created_at as date', 'notification_status as status')
            ->where('member_id', $memberId)
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get()
            ->toArray();


        foreach ($notif as $key => $value) {
            $notif[$key]['tag'] = 'notif';
        }


        return response()->json([
            'success' => true,
            'message' => 'Get List Notif',
            'notif' =>  $notif,
        ], 200);
    }
}
