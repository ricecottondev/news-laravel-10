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
                     #update Setting_menu
                     $update = Setting_menu::where("id", $request->id)->first();
                     $update->deleted = true;
             
                     try {
                         $update->save();
                         return response("Your data sucessfully deleted");
                     } catch (\Throwable $th) {
                         return response("ERROR deleted data " . $th->getMessage(), 400);
                     }
        
              
            }
        }
        
        ?>