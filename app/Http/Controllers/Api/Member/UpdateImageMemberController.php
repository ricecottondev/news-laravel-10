<?php

namespace App\Http\Controllers\Api\Member;

use JWTAuth;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UpdateImageMemberController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $id = $request->iduser;
        $namefile = $request->name;
        $password = $request->password;

        date_default_timezone_set('Asia/Jakarta');
        $dateymd = date('Y-m-d');
        $datedmy = date('d-m-Y');
        $tglhariini = date('Y-m-d');
        $jamhis = date('H:i:s');
        $jamhi = date('H:i');
        $day = date('d');
        $year = date('Y');

        $gambar = $request->gambar;
        $tglsubmit =  $tglhariini;


        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:jpg,png,jpeg,doc,docx,pdf,txt,csv|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }


        if ($file = $request->file('file')) {
            // $name = $file->getClientOriginalName();
            // $name = $request->filename.".".$file->clientExtension();;
            $name = $id . "_" . $namefile . "." . $file->clientExtension();
            $request->file->move(public_path('images/users'), $name);

            $updateimage = DB::update('update users set image="' . $name . '" where id=' . $id);

            return response()->json([
                "success" => true,
                "message" => "File successfully uploaded",
                "file" => $file
            ]);
        }


        return response()->json([
            "success" => true,
            "message" => "File un successfully uploaded",
            "file" => $file
        ]);
    }
    public function indexMobile(Request $request)
    {
        $userLogin = JWTAuth::parseToken()->authenticate();
        $id = $userLogin->id;

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'file' => 'mimes:jpg,png,jpeg',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 200);
        }

        $namefile = $request->input('name');
        $user = User::find($id);
        if ($file = $request->file('file')) {

            $timestamp = now()->timestamp;
            $extension = $file->getClientOriginalExtension();
            $name = $id . "_" . $timestamp . "." . $extension;


            if (!empty($user->image) && file_exists(public_path('images/users/' . $user->image))) {
                unlink(public_path('images/users/' . $user->image));
            }
            $file->move(public_path('images/users'), $name);
            $user->image = $name;
        } else {
            $name = '';
        }

        $user->name = $namefile;
        $user->save();

        if ($name) {

            $fullUrl = url('/') . '/images/users/' . $name;
        } else {
            $fullUrl = '';
        }
        return response()->json([
            "success" => true,
            "message" => "Profile successfully updated",
            "name" => $namefile,
            "file" => $fullUrl
        ]);
    }
}
