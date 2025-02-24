<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

class ApiBuilderController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $USE_CASE = "";
        $res_tables = DB::select("SELECT table_name FROM information_schema.tables WHERE
        TABLE_SCHEMA = '" . env('DB_DATABASE') . "'");

        #setelah memeilih table
        if ((isset($_POST['table']))&&($_POST['table']!="")) {
            $message = "<p class='text text-info mb-3 mt-2'>Table " . $_POST['table'] . " Already Choosed, press button 'Create Endpoint'</p>";
            #cek field dari tabel yang dipilih
            $res_field = $this->show_field($_POST['table']);
            #modifikasi output tabel dengan output field tambahan
            for ($i=0; $i < count($res_field); $i++) {
              $res_field[$i]->type = ""; 
              $res_field[$i]->show_column_list = false;
              $res_field[$i]->show_add_forms = false;
              $res_field[$i]->show_edit_forms = false;
              $res_field[$i]->show_show_pages = false; 
              $res_field[$i]->validation = false;
            }
            $tabel = ($_POST['table']);
        } else {
            #jika tabel belum terpilih
            $tabel = "";
            $res_field = [];
            $message = "Choose your table";
        }


        #action ketika tombol create api di tekan
        if(isset($_POST['set_api'])&&(isset($_POST['name_api'])))
        {
            $subject = $_POST['subject'];
            $label = $_POST['label'];

            $res_field = $this->show_field($_POST['name_api']);
            #modifikasi output field disesuaikan dengan imputan user
            for ($i=0; $i < count($res_field); $i++) {
              $res_field[$i]->type = ""; 
              if(isset($_POST[$res_field[$i]->Field.'_field_label'])){$res_field[$i]->field_label = $_POST[$res_field[$i]->Field.'_field_label'];}else{$res_field[$i]->field_label = $res_field[$i]->Field;}
              if(isset($_POST[$res_field[$i]->Field.'_show_column_list'])){$res_field[$i]->show_column_list = true;}else{$res_field[$i]->show_column_list = false;}
              if(isset($_POST[$res_field[$i]->Field.'_show_add_forms'])){$res_field[$i]->show_add_forms = true;}else{$res_field[$i]->show_add_forms = false;}
              if(isset($_POST[$res_field[$i]->Field.'_show_edit_forms'])){$res_field[$i]->show_edit_forms = true;}else{$res_field[$i]->show_edit_forms = false;}
              if(isset($_POST[$res_field[$i]->Field.'_show_show_pages'])){$res_field[$i]->show_show_pages = true;}else{$res_field[$i]->show_show_pages = false;}
              if(isset($_POST[$res_field[$i]->Field.'_validation'])){$res_field[$i]->validation = $_POST[$res_field[$i]->Field.'_validation'];}else{$res_field[$i]->validation = "";}
              // $res_field[$i]->validation = "";
            }
            $tabel = ($_POST['name_api']);

            $statusmvc = $this->set_api($tabel, $res_field, $subject, $label);
            $message = '<h3>MVC '.ucfirst($_POST["name_api"]).' alredy Setup</h3>'.$statusmvc;
            
        }

        $route = 'use App\Http\Controllers\Api\\'. $USE_CASE.'\Get'. $USE_CASE.'\Controller;'."\n".'
        use App\Http\Controllers\Api\\'. $USE_CASE.'\Post'. $USE_CASE.'\Controller;'."\n".'
        use App\Http\Controllers\Api\\'. $USE_CASE.'\Update'. $USE_CASE.'\Controller;'."\n".'
        use App\Http\Controllers\Api\\'. $USE_CASE.'\Delete'. $USE_CASE.'\Controller;'."\n".'
        ';

        return view('apibuilder.index', compact('res_tables', 'message', 'res_field', 'tabel', 'route'));

    }

    function show_field($table)
    {
        $field = DB::select("SHOW FIELDS FROM $table FROM " . env('DB_DATABASE') . ";");
        return $field;
    }

    function set_api($USE_CASE,$res_field, $subject, $label)
    {
        $USE_CASE = ucfirst($USE_CASE);

        $page_file_temp = $_SERVER["PHP_SELF"];
        $page_directory = dirname($page_file_temp);

        $new_path = getcwd();
        $controller_path = str_replace("public", "app/Http/Controllers/Api/", $new_path);
        $controller_path = str_replace('\\', '/', $controller_path);

        $statusget = $this->create_get($USE_CASE, $controller_path,$res_field);
        $statuspost = $this->create_post($USE_CASE, $controller_path,$res_field);
        $statusupdate = $this->create_update($USE_CASE, $controller_path,$res_field);
        $statusdelete = $this->create_delete($USE_CASE, $controller_path,$res_field);

        $route = 'COPY THIS CODE ON ROUTE API'."<br>".'
        <code>'."<br>".'use App\Http\Controllers\Api\\'. $USE_CASE.'\Get'. $USE_CASE.'\Controller;'."<br>".'
        use App\Http\Controllers\Api\\'. $USE_CASE.'\Post'. $USE_CASE.'\Controller;'."<br>".'
        use App\Http\Controllers\Api\\'. $USE_CASE.'\Update'. $USE_CASE.'\Controller;'."<br>".'
        use App\Http\Controllers\Api\\'. $USE_CASE.'\Delete'. $USE_CASE.'\Controller;'."<br>".'
        </code>';

        $route = $route.''."<br>".''."<br>".'COPY THIS CODE ON ROUTE API'."<br>".'
        <code>'."<br>".'Route::get("get'. $USE_CASE.'", [Get'. $USE_CASE.'Controller::class, "Index"]);'."<br>".'
        Route::post("post'. $USE_CASE.'", [Post'. $USE_CASE.'Controller::class, "Index"]);'."<br>".'
        Route::post("update'. $USE_CASE.'", [Update'. $USE_CASE.'Controller::class, "Index"]);'."<br>".'
        Route::post("delete'. $USE_CASE.'", [Delete'. $USE_CASE.'Controller::class, "Index"]);'."<br>".'
        </code>';

        $messages = $statusget.$statuspost.$statusupdate.$statusdelete.$route;
        

        return $messages;

    }

    public function create_get($USE_CASE, $controller_PATH, $res_field)
    {
        $domain_controller = $controller_PATH . $USE_CASE . '/';
        if (!is_dir($domain_controller)) {
            mkdir($domain_controller, 0777, true);
        }

        #VALUE CONTENT CONTROLLER
        $content_controller = '<?php
        namespace App\Http\Controllers\Api\\' . $USE_CASE . ';
        use Illuminate\Support\Facades\App;
        use Illuminate\Support\Facades\Session;
        use Illuminate\Http\Request;
        use App\Http\Controllers\Controller;
        use App\Models\\' . $USE_CASE . ';
        use Illuminate\Support\Facades\DB;
        use Hash;
        use Illuminate\Support\Arr;

        class Get' . $USE_CASE . 'Controller extends Controller
        {
            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function Index()
            {
        
             $' . $USE_CASE . ' = [];
             $response =  DB::select("select * from ' . strtolower($USE_CASE) . '");
             for ($v = 0; $v < count($response); $v++) {
                 $res_' . $USE_CASE . ' = $response[$v];
                 array_push($' . $USE_CASE . ', $res_' . $USE_CASE . ');
             }
             return response([
                 "data" => $response,
                 "msg" => "success"
             ], 200);
            }

        }
        
        ?>';


        $mycontroller = fopen($domain_controller ."Get".$USE_CASE . "Controller.php", "w");
        if (!$mycontroller) {
            $messages = "cannot write file";
        } else {
            fwrite($mycontroller, $content_controller);
            fclose($mycontroller);
            //chmod($path . $USE_CASE."Controller.php", 0777); 
            $messages = "<p class='text text-success mb-3 mt-2'>Success writing Endpoint GET</p>";
        }

        return $messages ;

    }

    public function create_post($USE_CASE, $controller_PATH, $res_field)
    {
        $domain_controller = $controller_PATH . $USE_CASE . '/';
        if (!is_dir($domain_controller)) {
            mkdir($domain_controller, 0777, true);
        }

        $field ="";

        for ($i=0; $i < count($res_field); $i++) { 
            if (($i!=0)&&($res_field[$i]->Field != "created_at")&&($res_field[$i]->Field != "updated_at")) {
                  $field = $field.'"'.$res_field[$i]->Field.'" => "$request->'.$res_field[$i]->Field.'",'."\n"; 
            }
           }

        #VALUE CONTENT CONTROLLER
        $content_controller = '<?php
        namespace App\Http\Controllers\Api\\' . $USE_CASE . ';
        use Illuminate\Support\Facades\App;
        use Illuminate\Support\Facades\Session;
        use Illuminate\Http\Request;
        use App\Http\Controllers\Controller;
        use App\Models\\' . $USE_CASE . ';
        use Illuminate\Support\Facades\DB;
        use Hash;
        use Illuminate\Support\Arr;

        class Get' . $USE_CASE . 'Controller extends Controller
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
            $post = ' . $USE_CASE . '::create([
               '.$field.'
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
        
        ?>';


        $mycontroller = fopen($domain_controller ."Post".$USE_CASE . "Controller.php", "w");
        if (!$mycontroller) {
            $messages = "cannot write file";
        } else {
            fwrite($mycontroller, $content_controller);
            fclose($mycontroller);
            //chmod($path . $USE_CASE."Controller.php", 0777); 
            $messages = "<p class='text text-success mb-3 mt-2'>Success writing Endpoint POST</p>";
        }

        return $messages ;
        
    }

    public function create_update($USE_CASE, $controller_PATH, $res_field)
    {
        $domain_controller = $controller_PATH . $USE_CASE . '/';
        if (!is_dir($domain_controller)) {
            mkdir($domain_controller, 0777, true);
        }

        $field ="";

        for ($i=0; $i < count($res_field); $i++) { 
            if (($i!=0)&&($res_field[$i]->Field != "created_at")&&($res_field[$i]->Field != "updated_at")) {
                  $field = $field.'$update->'.$res_field[$i]->Field.' = $request->'.$res_field[$i]->Field.';'."\n"; 
            }
           }

        #VALUE CONTENT CONTROLLER
        $content_controller = '<?php
        namespace App\Http\Controllers\Api\\' . $USE_CASE . ';
        use Illuminate\Support\Facades\App;
        use Illuminate\Support\Facades\Session;
        use Illuminate\Http\Request;
        use App\Http\Controllers\Controller;
        use App\Models\\' . $USE_CASE . ';
        use Illuminate\Support\Facades\DB;
        use Hash;
        use Illuminate\Support\Arr;

        class Get' . $USE_CASE . 'Controller extends Controller
        {
            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function Index(Request $request)
            {
                     #update member
                     $update = ' . $USE_CASE . '::where("id", $request->id)->first();
                     '.$field.'
             
                     try {
                         $update->save();
                         return response("Your member data sucessfully updated");
                     } catch (\Throwable $th) {
                         return response("ERROR update data " . $th->getMessage(), 400);
                     }
        
              
            }
        }
        
        ?>';


        $mycontroller = fopen($domain_controller ."Update".$USE_CASE . "Controller.php", "w");
        if (!$mycontroller) {
            $messages = "cannot write file";
        } else {
            fwrite($mycontroller, $content_controller);
            fclose($mycontroller);
            //chmod($path . $USE_CASE."Controller.php", 0777); 
            $messages = "<p class='text text-success mb-3 mt-2'>Success writing Endpoint UPDATE</p>";
        }

        return $messages ;
        
    }

    public function create_delete($USE_CASE, $controller_PATH, $res_field)
    {
        $domain_controller = $controller_PATH . $USE_CASE . '/';
        if (!is_dir($domain_controller)) {
            mkdir($domain_controller, 0777, true);
        }

        $field ="";


        #VALUE CONTENT CONTROLLER
        $content_controller = '<?php
        namespace App\Http\Controllers\Api\\' . $USE_CASE . ';
        use Illuminate\Support\Facades\App;
        use Illuminate\Support\Facades\Session;
        use Illuminate\Http\Request;
        use App\Http\Controllers\Controller;
        use App\Models\\' . $USE_CASE . ';
        use Illuminate\Support\Facades\DB;
        use Hash;
        use Illuminate\Support\Arr;

        class Get' . $USE_CASE . 'Controller extends Controller
        {
            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function Index(Request $request)
            {
                     #update ' . $USE_CASE . '
                     $update = ' . $USE_CASE . '::where("id", $request->id)->first();
                     $update->deleted = true;
             
                     try {
                         $update->save();
                         return response("Your data sucessfully deleted");
                     } catch (\Throwable $th) {
                         return response("ERROR deleted data " . $th->getMessage(), 400);
                     }
        
              
            }
        }
        
        ?>';


        $mycontroller = fopen($domain_controller ."Delete".$USE_CASE . "Controller.php", "w");
        if (!$mycontroller) {
            $messages = "cannot write file";
        } else {
            fwrite($mycontroller, $content_controller);
            fclose($mycontroller);
            //chmod($path . $USE_CASE."Controller.php", 0777); 
            $messages = "<p class='text text-success mb-3 mt-2'>Success writing Endpoint DELETE</p>";
        }

        return $messages ;
    }

}
