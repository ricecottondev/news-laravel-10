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
            public function Index(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     "product_id" =>  $request->product_id,
        // ]);

        try 
        {
        //save to database
            $post = Setting_menu::create([
               "menu_name" => "$request->menu_name",
"menu_label" => "$request->menu_label",
"menu_url" => "$request->menu_url",
"menu_color" => "$request->menu_color",
"menu_parent" => "$request->menu_parent",
"menu_icon" => "$request->menu_icon",
"type" => "$request->type",
"ord" => "$request->ord",
"extensiontarget" => "$request->extensiontarget",
"status" => "$request->status",
"deleted" => "$request->deleted",

            ]);

            return response([
                "msg" => "success"
                ], 200);
        }
        catch (\Exception $e) 
        {
            return response([
                "msg" => "failed"
                ], 200);
        }
    }

        }
        
        ?>