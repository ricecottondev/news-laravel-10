<?php
        namespace App\Http\Controllers\Api\Setting_menu;
        use Illuminate\Support\Facades\App;
        use Illuminate\Support\Facades\Session;
        use Illuminate\Http\Request;
        use App\Http\Controllers\Controller;
        use App\Models\Setting_menu;
        use Illuminate\Support\Facades\DB;
        use Hash;
        use Illuminate\Support\Arr;

        class GetSetting_menuController extends Controller
        {
            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function Index()
            {
        
             $Setting_menu = [];
             $response =  DB::select("select * from setting_menu");
             for ($v = 0; $v < count($response); $v++) {
                 $res_Setting_menu = $response[$v];
                 array_push($Setting_menu, $res_Setting_menu);
             }
             return response([
                 "data" => $response,
                 "msg" => "success"
             ], 200);
            }

        }
        
        ?>