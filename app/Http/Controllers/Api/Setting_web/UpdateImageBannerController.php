<?php

namespace App\Http\Controllers\Api\Setting_web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Arr;

class UpdateImageBannerController extends Controller
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
        $bannerid = $request->bannerid;
        if($bannerid==1)
        {
            $namefile = 'banner-1';
        }
        else
        { 
            $namefile = 'banner-2';
        }
       
        // $password = $request->password;
       
        // date_default_timezone_set('Asia/Jakarta');
        // $dateymd = date('Y-m-d');
        // $datedmy = date('d-m-Y');
        // $tglhariini = date('Y-m-d');
        // $jamhis = date('H:i:s');
        // $jamhi = date('H:i');
        // $day = date('d');
        // $year = date('Y');

        // $gambar = $request->gambar;
        // $tglsubmit =  $tglhariini;


        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:jpg,png,jpeg,doc,docx,pdf,txt,csv,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
// dd("masuk");

        if ($file = $request->file('file')) {
            // $name = $file->getClientOriginalName();
            // $name = $request->filename.".".$file->clientExtension();;
            $name = $namefile.".jpg";
            $request->file->move(public_path('files/info-images'), $name);

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
}

