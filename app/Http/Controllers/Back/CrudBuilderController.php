<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

class CrudBuilderController extends Controller
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
        $USE_CASE = "Menumakanan";
        $res_tables = DB::select("SELECT table_name FROM information_schema.tables WHERE
        TABLE_SCHEMA = '" . env('DB_DATABASE') . "'");

        if ((isset($_POST['table']))&&($_POST['table']!="")) {
            //dd($_POST['table']);
            $message = "<p class='text text-info mb-3 mt-2'>Table " . $_POST['table'] . " Already Choosed, press button 'Create MVC'</p>";
            // dd("test");
            $res_field = $this->show_field($_POST['table']);
            for ($i=0; $i < count($res_field); $i++) {
              $res_field[$i]->type = ""; 
              $res_field[$i]->show_column_list = false;
              $res_field[$i]->show_add_forms = false;
              $res_field[$i]->show_edit_forms = false;
              $res_field[$i]->show_show_pages = false; 
              $res_field[$i]->validation = false;
            }
            //dd($res_field);

            $tabel = ($_POST['table']);
        } else {
          // dd("test 2");
            $tabel = "";
            $res_field = [];
            $message = "Choose your table";
        }

        if(isset($_POST['set_mvc'])&&(isset($_POST['name_mvc'])))
        {
            $subject = $_POST['subject'];
            $label = $_POST['label'];
            $res_field = $this->show_field($_POST['name_mvc']);
            for ($i=0; $i < count($res_field); $i++) {
              $res_field[$i]->type =  $_POST[$res_field[$i]->Field.'_type']; 
              if(isset($_POST[$res_field[$i]->Field.'_field_label'])){$res_field[$i]->field_label = $_POST[$res_field[$i]->Field.'_field_label'];}else{$res_field[$i]->field_label = $res_field[$i]->Field;}
              if(isset($_POST[$res_field[$i]->Field.'_show_column_list'])){$res_field[$i]->show_column_list = true;}else{$res_field[$i]->show_column_list = false;}
              if(isset($_POST[$res_field[$i]->Field.'_show_add_forms'])){$res_field[$i]->show_add_forms = true;}else{$res_field[$i]->show_add_forms = false;}
              if(isset($_POST[$res_field[$i]->Field.'_show_edit_forms'])){$res_field[$i]->show_edit_forms = true;}else{$res_field[$i]->show_edit_forms = false;}
              if(isset($_POST[$res_field[$i]->Field.'_show_show_pages'])){$res_field[$i]->show_show_pages = true;}else{$res_field[$i]->show_show_pages = false;}
              if(isset($_POST[$res_field[$i]->Field.'_validation'])){$res_field[$i]->validation = $_POST[$res_field[$i]->Field.'_validation'];}else{$res_field[$i]->validation = "";}
              // $res_field[$i]->validation = "";
            }

            //dd($res_field);
            $tabel = ($_POST['name_mvc']);
            $statusmvc = $this->set_mvc($tabel, $res_field, $subject, $label);
            $message = '<h3>MVC '.ucfirst($_POST["name_mvc"]).' alredy Setup</h3>'.$statusmvc;
        }

        // dump("test 4");

        return view('crud.index', compact('res_tables', 'message', 'res_field', 'tabel'));
    }

    function show_field($table)
    {
        $field = DB::select("SHOW FIELDS FROM $table FROM " . env('DB_DATABASE') . ";");
        return $field;
    }

    function set_mvc($USE_CASE,$res_field, $subject, $label)
    {
        $USE_CASE = ucfirst($USE_CASE);

        $page_file_temp = $_SERVER["PHP_SELF"];
        $page_directory = dirname($page_file_temp);

        $new_path = getcwd();
        $controller_path = str_replace("public", "app/Http/Controllers/back/", $new_path);
        $controller_path = str_replace('\\', '/', $controller_path);

        #C:\laragon\www\laravel8-metronic-1\app\Models
        $model_path = str_replace("public", "app/Models/", $new_path);
        $model_path = str_replace('\\', '/', $model_path);

        #C:\laragon\www\laravel8-metronic-1\resources\views
        $view_path = str_replace("public", "resources/views/back/", $new_path);
        $view_path = str_replace('\\', '/', $view_path);

        // $res_field = $this->show_field($USE_CASE);

        $statuscontroller = $this->create_controller($USE_CASE, $controller_path,$res_field);
        $statusmodel = $this->create_model($USE_CASE, $model_path,$res_field);
        $statusview = $this->create_view($USE_CASE, $view_path,$res_field, $subject, $label);
        $statusroute = $this->create_route($USE_CASE);

        $route = 'COPY THIS CODE ON ROUTE WEB'."<br>".'
        <code>'."<br>".'use App\Http\Controllers\back\\'. $USE_CASE.'\\'. $USE_CASE.'\Controller;'."<br>".'
        </code>';

        $route = $route.''."<br>".''."<br>".'COPY THIS CODE ON ROUTE WEB'."<br>".'
        <code>'."<br>".'Route::resource("'. strtolower($USE_CASE).'", '. $USE_CASE.'Controller::class);'."<br>".'
        </code>';

        $messages = $statuscontroller.$statusmodel.$statusview.$statusroute.$route;

        return $messages;

    }

    function create_controller($USE_CASE, $controller_PATH, $res_field)
    {

        $domain_controller = $controller_PATH . $USE_CASE . '/';
        if (!is_dir($domain_controller)) {
            mkdir($domain_controller, 0777, true);
        }

        #VALUE CONTENT CONTROLLER
        $content_controller = '<?php
        namespace App\Http\Controllers\Back\\' . $USE_CASE . ';
        use Illuminate\Http\Request;
        use App\Http\Controllers\Controller;
        use App\Models\\' . $USE_CASE . ';
        use DB;
        use Hash;
        use Illuminate\Support\Arr;

        class ' . $USE_CASE . 'Controller extends Controller
        {
            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
        
            public function index(Request $request)
            {
                $data = '.$USE_CASE.'::orderBy("id","DESC")->get();
                return view("back.'.$USE_CASE.'.index",compact("data"))
                    ->with("i", ($request->input("page", 1) - 1) * 5);
            }
        
            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
        
            public function create()
            {
                return view("back.'.$USE_CASE.'.create");
            }
        
        
        
            /**
             * Store a newly created resource in storage.
             *
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response
             */
        
            ';

            $validate ="";
            $image = "";
            $filex = "";
           for ($i=0; $i < count($res_field); $i++) { 
            if (($i!=0)&&($res_field[$i]->Field != "created_at")&&($res_field[$i]->Field != "updated_at")) {
                if ($res_field[$i]->Null=="NO") {
                  $validate = $validate.'"'.$res_field[$i]->Field.'" => "required",'."\n"; 
                }
                    //$validate = $validate.'"'.$res_field[$i]->Field.'" => "required",'."\n"; 
            }
            if ($res_field[$i]->Field=="image") {
              $image ='
              if ($request->hasfile("image")) {
                $fileName = time() . rand(1, 100) . "." . $request->file("image")->extension();
                $file = $request->file("image");
                $file->move(public_path("images/'.$USE_CASE.'"), $fileName);
                dump("images");
            }
            if(!empty($fileName)){ 
                $input["image"] = $fileName;
            }else{
                $input["image"] = "";
            }
              ';
            }
             if ($res_field[$i]->Field=="file") {
              $filex ='
              if ($request->hasfile("file")) {
                $fileName = time() . rand(1, 100) . "." . $request->file("file")->extension();
                $file = $request->file("file");
                $file->move(public_path("files/'.$USE_CASE.'"), $fileName);
            }
            if(!empty($fileName)){ 
                $input["file"] = $fileName;
            }else{
                $input["file"] = "";
            }
              ';
            }
           }

           if ($validate=="") {
            $validate = "";
           }
           else
           {
            $validate = '$this->validate($request, ['.$validate.']);';
           }
            
            
            
           $content_controller =  $content_controller .'public function store(Request $request)
            {
               
                    '.$validate.'
                $input = $request->all();
                '.$image.'
                '.$filex.'
                $'.$USE_CASE.' = '.$USE_CASE.'::create($input);
               
            
                return redirect()->route("'.strtolower($USE_CASE).'.index")
                ->with("success","'.$USE_CASE.' created successfully");
            
            }
        
        
            /**
                 * Display the specified resource.
                 *
                 * @param  int  $id
                 * @return \Illuminate\Http\Response
                 */
        
                public function show($id)
                {
                    $'.$USE_CASE.' = '.$USE_CASE.'::find($id);
                    return view("back.'.$USE_CASE.'.show",compact("'.$USE_CASE.'"));
                }
            

            
                /**
                 * Show the form for editing the specified resource.
                 *
                 * @param  int  $id
                 * @return \Illuminate\Http\Response
                 */
            
                public function edit($id)
                {
                    $'.$USE_CASE.' = '.$USE_CASE.'::find($id);
                    return view("back.'.$USE_CASE.'.edit",compact("'.$USE_CASE.'"));
                }
            

            
                /**
                 * Update the specified resource in storage.
                 *
                 * @param  \Illuminate\Http\Request  $request
                 * @param  int  $id
                 * @return \Illuminate\Http\Response
                 */
            
                public function update(Request $request, $id)
                {
                
                   
                        '.$validate.'
                        

                    $input = $request->all();

                    '.$image.'
                    '.$filex.'
                    
                    $'.$USE_CASE.' = '.$USE_CASE.'::find($id);
                    $'.$USE_CASE.'->update($input);
                
                    return redirect()->route("'.strtolower($USE_CASE).'.index")
                    ->with("success","'.$USE_CASE.' updated successfully");
                
                }
            

                /**
                 * Remove the specified resource from storage.
                 *
                 * @param  int  $id
                 * @return \Illuminate\Http\Response
                 */
            
                public function destroy($id)
                {
                    '.$USE_CASE.'::find($id)->delete();
                    return redirect()->route("'.strtolower($USE_CASE).'.index")
                    ->with("success","'.$USE_CASE.' deleted successfully");
                
                }
            }
        
        ?>';


        $mycontroller = fopen($domain_controller . $USE_CASE . "Controller.php", "w");
        if (!$mycontroller) {
            $messages = "cannot write file";
        } else {
            fwrite($mycontroller, $content_controller);
            fclose($mycontroller);
            //chmod($path . $USE_CASE."Controller.php", 0777); 
            $messages = "<p class='text text-success mb-3 mt-2'>Success writing controller file to server</p>";
        }

        return $messages ;
    }

    function create_model($USE_CASE, $model_PATH, $res_field)
    {
            $domain_model = $model_PATH;

            $fillable ="";

            for ($i=0; $i < count($res_field); $i++) { 
            if (($i!=0)&&($res_field[$i]->Field != "created_at")&&($res_field[$i]->Field != "updated_at")) {
                    $fillable = $fillable.'"'.$res_field[$i]->Field.'",'."\n"; 
            }
            }

            $content_model = '<?php

            /**
             * author : Suryo Atmojo <suryoatm@gmail.com>
             * project : supresso Laravel
             * Start-date : 19-09-2022
             */
            /**
             “Barangsiapa yang memberi kemudharatan kepada seorang muslim, 
            maka Allah akan memberi kemudharatan kepadanya, 
            barangsiapa yang merepotkan (menyusahkan) seorang muslim 
            maka Allah akan menyusahkan dia.”
            */
            
            namespace App\Models;
            
            use Illuminate\Database\Eloquent\Factories\HasFactory;
            use Illuminate\Database\Eloquent\Model;
            
            class '.$USE_CASE.' extends Model
            {
                use HasFactory;
                protected $table = "'.strtolower($USE_CASE).'";
                protected $fillable = [
                    '.$fillable.'
                ];
            }
            ?>';

            $mymodel = fopen($domain_model.$USE_CASE.".php", "w");
        if (!$mymodel){
            $messages = "cannot write file";
        } else {
            fwrite($mymodel, $content_model);
            fclose($mymodel);
            // chmod($path . $USE_CASE."_model.php", 0777); 
            $messages = "<p class='text text-success mb-3 mt-2'>Success writing model file to server</p>";
        }

        return $messages ;
    }

    function create_view($USE_CASE, $view_PATH, $res_field, $subject, $label)
    { 
        $domain_view = $view_PATH . $USE_CASE . '/';
        if (!is_dir($domain_view)) {
            mkdir($domain_view, 0777, true);
        }

        
        $strform = $this->create_input_form($res_field);
        $strformedit = $this->create_input_edit_form($res_field,$USE_CASE);
        $strformshow = $this->create_input_show_form($res_field,$USE_CASE);
        $strtable = $this->create_table($USE_CASE, $res_field);
        
        $content_view = '
        @extends("back/layouts.layout")
        @section("content")
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            {{-- <div class="row">
              <div class="col-lg-12 margin-tb">
                  <div class="card">
                      <div class="card-body">
                          @can("product-create")
                              <a class="btn btn-success" href="{{ route("'.strtolower($USE_CASE).'.create") }}"> Create New '.$USE_CASE.'</a>
                          @endcan
        
                      </div>
                  </div>
              </div>
          </div> --}}
        
          <!--begin::Main-->
          <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <!--begin::Content wrapper-->
            <div class="d-flex flex-column flex-column-fluid">
              <!--begin::Toolbar-->
              <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                <!--begin::Toolbar container-->
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                  <!--begin::Page title-->
                  <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">'.$label.' LIST</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                      <!--begin::Item-->
                      <li class="breadcrumb-item text-muted">
                        <a href="{{url("")}}" class="text-muted text-hover-primary">Home</a>
                      </li>
                      <!--end::Item-->
                      <!--begin::Item-->
                      <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                      </li>
                      <!--end::Item-->
                      <!--begin::Item-->
                      <li class="breadcrumb-item text-muted">'.$label.'</li>
                      <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                  </div>
                  <!--end::Page title-->
                  <!--begin::Actions-->
                  <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!--begin::Filter menu-->
                    <div class="m-0">
                      <!--begin::Menu toggle-->
                      <a href="#" class="btn btn-sm btn-flex bg-body btn-color-gray-700 btn-active-color-primary fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                      <i class="ki-duotone ki-filter fs-6 text-muted me-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                      </i>Filter</a>
                      <!--end::Menu toggle-->
                      <!--begin::Menu 1-->
                      <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_641ac41e77927">
                        <!--begin::Header-->
                        <div class="px-7 py-5">
                          <div class="fs-5 text-dark fw-bold">Filter Options</div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Menu separator-->
                        <div class="separator border-gray-200"></div>
                        <!--end::Menu separator-->
                        <!--begin::Form-->
                        <div class="px-7 py-5">
                          <!--begin::Input group-->
                          <div class="mb-10">
                            <!--begin::Label-->
                            <label class="form-label fw-semibold">Status:</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <div>
                              <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_641ac41e77927" data-allow-clear="true">
                                <option></option>
                                <option value="1">Approved</option>
                                <option value="2">Pending</option>
                                <option value="2">In Process</option>
                                <option value="2">Rejected</option>
                              </select>
                            </div>
                            <!--end::Input-->
                          </div>
                          <!--end::Input group-->
                          <!--begin::Input group-->
                          <div class="mb-10">
                            <!--begin::Label-->
                            <label class="form-label fw-semibold">Member Type:</label>
                            <!--end::Label-->
                            <!--begin::Options-->
                            <div class="d-flex">
                              <!--begin::Options-->
                              <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                <input class="form-check-input" type="checkbox" value="1" />
                                <span class="form-check-label">Author</span>
                              </label>
                              <!--end::Options-->
                              <!--begin::Options-->
                              <label class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="2" checked="checked" />
                                <span class="form-check-label">Customer</span>
                              </label>
                              <!--end::Options-->
                            </div>
                            <!--end::Options-->
                          </div>
                          <!--end::Input group-->
                          <!--begin::Input group-->
                          <div class="mb-10">
                            <!--begin::Label-->
                            <label class="form-label fw-semibold">Notifications:</label>
                            <!--end::Label-->
                            <!--begin::Switch-->
                            <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                              <input class="form-check-input" type="checkbox" value="" name="notifications" checked="checked" />
                              <label class="form-check-label">Enabled</label>
                            </div>
                            <!--end::Switch-->
                          </div>
                          <!--end::Input group-->
                          <!--begin::Actions-->
                          <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
                            <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                          </div>
                          <!--end::Actions-->
                        </div>
                        <!--end::Form-->
                      </div>
                      <!--end::Menu 1-->
                    </div>
                    <!--end::Filter menu-->
                    <!--begin::Secondary button-->
                    <!--end::Secondary button-->
                    <!--begin::Primary button-->
                    {{-- <a href="#" class="btn btn-sm fw-bold btn-info" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Create</a> --}}
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_'.$USE_CASE.'">
                      <i class="ki-duotone ki-plus "></i>Add '.$label.'</button>
                    <!--end::Primary button-->
                  </div>
                  <!--end::Actions-->
                </div>
                <!--end::Toolbar container-->
              </div>
              <!--end::Toolbar-->
        
              <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++begin::Modal - Add task-->
              <div class="modal fade" id="kt_modal_add_'.$USE_CASE.'" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                  <!--begin::Modal content-->
                  <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header" id="kt_modal_add_'.$USE_CASE.'_header">
                      <!--begin::Modal title-->
                      <h2 class="fw-bold">ADD '.$subject.'</h2>
                      <!--end::Modal title-->
                      <!--begin::Close-->
                      <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" data-kt-'.$USE_CASE.'s-modal-action="close">
                        <i class="ki-duotone ki-cross fs-1">
                          <span class="path1"></span>
                          <span class="path2"></span>
                        </i>
                      </div>
                      <!--end::Close-->
                    </div>
                    <!--end::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                      <!--begin::Form-->
                      {!! Form::open(array("route" => "'.strtolower($USE_CASE).'.store","method"=>"POST","enctype"=>"multipart/form-data")) !!}
                      {{-- <form id="kt_modal_add_'.$USE_CASE.'_form" class="form" action="#"> --}}
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_'.$USE_CASE.'_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_'.$USE_CASE.'_header" data-kt-scroll-wrappers="#kt_modal_add_'.$USE_CASE.'_scroll" data-kt-scroll-offset="300px">
                         
                          '.$strform.'
                         
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                          <button type="reset" class="btn btn-light me-3" data-kt-'.$USE_CASE.'-modal-action="cancel">Discard</button>
                          <button type="submit" class="btn btn-primary" data-kt-'.$USE_CASE.'-modal-action="submit">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                          </button>
                        </div>
                        <!--end::Actions-->
                        {!! Form::close() !!}
                      <!--end::Form-->
                    </div>
                    <!--end::Modal body-->
                  </div>
                  <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
              </div>
              <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++end::Modal - add '.$USE_CASE.'-->
      
              @foreach ($data as $key => $'.strtolower($USE_CASE).')
              <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++begin::Modal - Edit '.$USE_CASE.'-->
              <div class="modal fade" id="kt_modal_edit_'.strtolower($USE_CASE).'{{ $'.strtolower($USE_CASE).'->id }}" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                  <!--begin::Modal content-->
                  <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header" id="kt_modal_add_'.strtolower($USE_CASE).'_header">
                      <!--begin::Modal title-->
                      <h2 class="fw-bold">EDIT '.($subject).'</h2>
                      <!--end::Modal title-->
                      <!--begin::Close-->
                      <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" data-kt-'.strtolower($USE_CASE).'s-modal-action="close">
                        <i class="ki-duotone ki-cross fs-1">
                          <span class="path1"></span>
                          <span class="path2"></span>
                        </i>
                      </div>
                      <!--end::Close-->
                    </div>
                    <!--end::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                      <!--begin::Form-->
                      {{-- {!! Form::open(array("route" => "'.strtolower($USE_CASE).'.update","method"=>"POST")) !!} --}}
                      {!! Form::model($'.strtolower($USE_CASE).', ["method" => "PATCH","route" => ["'.strtolower($USE_CASE).'.update", $'.strtolower($USE_CASE).'->id], "enctype"=>"multipart/form-data"]) !!}
                      {{-- <form id="kt_modal_add_user_form" class="form" action="#"> --}}
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                        '.$strformedit.'
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                          <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard</button>
                          <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                          </button>
                        </div>
                        <!--end::Actions-->
                        {!! Form::close() !!}
                      <!--end::Form-->
                    </div>
                    <!--end::Modal body-->
                  </div>
                  <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
              </div>
              <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++end::Modal - Edit user-->
              @endforeach

              @foreach ($data as $key => $'.strtolower($USE_CASE).')
              <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++begin::Modal - Show'.$USE_CASE.'-->
              <div class="modal fade" id="kt_modal_show_'.strtolower($USE_CASE).'{{ $'.strtolower($USE_CASE).'->id }}" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                  <!--begin::Modal content-->
                  <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header" id="kt_modal_add_'.strtolower($USE_CASE).'_header">
                      <!--begin::Modal title-->
                      <h2 class="fw-bold">DETAIL '.($subject).'</h2>
                      <!--end::Modal title-->
                      <!--begin::Close-->
                      <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" data-kt-'.strtolower($USE_CASE).'s-modal-action="close">
                        <i class="ki-duotone ki-cross fs-1">
                          <span class="path1"></span>
                          <span class="path2"></span>
                        </i>
                      </div>
                      <!--end::Close-->
                    </div>
                    <!--end::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                      <!--begin::Form-->
                      {{-- {!! Form::open(array("route" => "'.strtolower($USE_CASE).'.update","method"=>"POST")) !!} --}}
                      {!! Form::model($'.strtolower($USE_CASE).', ["method" => "PATCH","route" => ["'.strtolower($USE_CASE).'.update", $'.strtolower($USE_CASE).'->id], "enctype"=>"multipart/form-data"]) !!}
                      {{-- <form id="kt_modal_add_user_form" class="form" action="#"> --}}
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                        '.$strformshow.'
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                          <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard</button>
                          <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                          </button>
                        </div>
                        <!--end::Actions-->
                        {!! Form::close() !!}
                      <!--end::Form-->
                    </div>
                    <!--end::Modal body-->
                  </div>
                  <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
              </div>
              <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++end::Modal - Show user-->
              @endforeach


              <!--begin::Content-->
              <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                  <!--begin::Card-->
                  <div class="card">
                    <div class="card-body">
                      '.$strtable.'
                    </div>
        
                  </div>
                  <!--end::Card-->
                </div>
                <!--end::Content container-->
              </div>
              <!--end::Content-->
            </div>
            <!--end::Content wrapper-->
          
          </div>
          <!--end:::Main-->
        
         
        </div>
            <!--end::Content-->
        @endsection
        ';

        $myview = fopen($domain_view."/". "index.blade.php", "w");
        if (!$myview) {
            $messages = "cannot write file";
        } else {
            fwrite($myview, $content_view);
            fclose($myview);
            //chmod($path . $USE_CASE."Controller.php", 0777); 
            $messages = "<p class='text text-success mb-3 mt-2'>Success writing index view file to server</p>";
        }

        return $messages ;
    }

    function create_input_show_form($res_field,$USE_CASE)
    {
      $strformshow = '';
        for ($i=0; $i < count($res_field); $i++) { 
          
          if (str_contains($res_field[$i]->validation, 'required')) 
          {
            $required = "required";
          }
          else
          {
            $required = "";
          }

          if (($res_field[$i]->Field != "created_at")&&($res_field[$i]->Field != "updated_at")&&($res_field[$i]->show_show_pages == true))
          //if (($i!=0)&&($res_field[$i]->Field != "created_at")&&($res_field[$i]->Field != "updated_at"))
          {
            if(str_contains($res_field[$i]->Type,'int'))
            {
              $strshow = $res_field[$i]->Field.", ".$res_field[$i]->Field.", integer";
               $strformshow = $strformshow.'
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="'.$required.' fw-semibold fs-6 mb-2">'.$res_field[$i]->field_label.'</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="number" name="'.$res_field[$i]->Field.'" class="form-control form-control-sm form-control-solid" placeholder="'.$res_field[$i]->Field.'" value="{{$'.strtolower($USE_CASE).'->'.$res_field[$i]->Field.'}}" />
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              ';
              // dump($strshow);
            }
            else if(str_contains($res_field[$i]->Type,'varchar'))
            {
              $strshow = $res_field[$i]->Field.", ".$res_field[$i]->Field.", varchar";
              $strformshow = $strformshow.'
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="'.$required.' fw-semibold fs-6 mb-2">'.$res_field[$i]->field_label.'</label>
                <!--end::Label-->
                <!--begin::Input-->
                {!! Form::text("'.$res_field[$i]->Field.'", $'.strtolower($USE_CASE).'->'.$res_field[$i]->Field.', array("placeholder" => "'.$res_field[$i]->field_label.'","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              ';
              // dump($strformshow);
            }
            else if(str_contains($res_field[$i]->Type,'text'))
            {
              $strshow = $res_field[$i]->Field.", ".$res_field[$i]->Field.", text";
              $strformshow = $strformshow.'
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="'.$required.' fw-semibold fs-6 mb-2">'.$res_field[$i]->field_label.'</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="text" name="'.$res_field[$i]->Field.'" class="form-control form-control-sm form-control-solid" placeholder="'.$res_field[$i]->Field.'" value="{{$'.strtolower($USE_CASE).'->'.$res_field[$i]->Field.'}}" />
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              ';
              // dump($strformshow);
            }
            else if(str_contains($res_field[$i]->Type,'enum'))
            {
              $strshow = $res_field[$i]->Field.", ".$res_field[$i]->Field.", enum";
              preg_match('#\((.*?)\)#', $res_field[$i]->Type, $match);
              $strenumdata = str_replace("'","",$match[1]);
              $enumdata = explode(",",$strenumdata);
              
              $stroption ="";
              foreach ($enumdata as $key => $enum) {
                $stroption =$stroption."<option value='".$enum."'>".$enum."</option>";
              }
              $strformshow = $strformshow.'
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="'.$required.' fw-semibold fs-6 mb-2">'.$res_field[$i]->field_label.'</label>
                <!--end::Label-->
                <!--begin::Input-->
                <select name="'.$res_field[$i]->Field.'" aria-label="Select a '.$res_field[$i]->Field.'" data-control="select2" data-placeholder="date_period" class="form-select form-select-sm form-select-solid">
														'.$stroption.'
								</select>
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              ';
              // dump($strformshow);
            }
            else if(str_contains($res_field[$i]->Type,'datetime'))
            {
              $strshow = $res_field[$i]->Field.", ".$res_field[$i]->Field.", datetime";
              // dump($strshow);
            }
          }
        }

        return $strformshow;
    }

    function create_input_form($res_field)
    {
      $strform = '';
        for ($i=0; $i < count($res_field); $i++) { 
          if (str_contains($res_field[$i]->validation, 'required')) 
          {
            $required = "required";
          }
          else
          {
            $required = "";
          }
          
          //if (($i!=0)&&($res_field[$i]->Field != "created_at")&&($res_field[$i]->Field != "updated_at"))
          if (($res_field[$i]->Field != "created_at")&&($res_field[$i]->Field != "updated_at")&&($res_field[$i]->show_add_forms == true))
          {
            if(($res_field[$i]->Field != "id")&& (str_contains($res_field[$i]->Type,'int')))
            {
              $strshow = $res_field[$i]->Field.", ".$res_field[$i]->Field.", integer";
             
                 $strform = $strform.'
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                  <!--begin::Label-->
                  <label class="'.$required.' fw-semibold fs-6 mb-2">'.$res_field[$i]->field_label.'</label>
                  <!--end::Label-->
                  <!--begin::Input-->
                  <input type="number" name="'.$res_field[$i]->Field.'" class="form-control form-control-sm form-control-solid" placeholder="'.$res_field[$i]->Field.'"  />
                  <!--end::Input-->
                </div>
                <!--end::Input group-->
                ';
             
          
            }
            else if(str_contains($res_field[$i]->Type,'varchar'))
            {
              
             
              $strshow = $res_field[$i]->Field.", ".$res_field[$i]->Field.", varchar";
              $strform = $strform.'
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="'.$required.' fw-semibold fs-6 mb-2">'.$res_field[$i]->field_label.'</label>
                <!--end::Label-->
                <!--begin::Input-->
                {!! Form::text("'.$res_field[$i]->Field.'", null, array("placeholder" => "'.$res_field[$i]->field_label.'","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              ';
              // dump($strform);
            }
            else if(str_contains($res_field[$i]->Type,'text')&&($res_field[$i]->Field=="image"))
            {
              $strshow = $res_field[$i]->Field.", ".$res_field[$i]->Field.", text";
              $strform = $strform.'
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="d-block fw-semibold fs-6 mb-5">Image</label>
                <!--end::Label-->
                <!--begin::Image placeholder-->
                <style>.image-input-placeholder { background-image: url("assets/media/svg/files/blank-image.svg"); } [data-bs-theme="dark"] .image-input-placeholder { background-image: url("assets/media/svg/files/blank-image-dark.svg"); }</style>
                <!--end::Image placeholder-->
                <!--begin::Image input-->
                <div class="image-input image-input-outline image-input-placeholder" data-kt-image-input="true">
                  <!--begin::Preview existing avatar-->
                  <div class="image-input-wrapper w-125px h-125px" style="background-image: url(assets/media/avatars/300-6.jpg);"></div>
                  <!--end::Preview existing avatar-->
                  <!--begin::Label-->
                  <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change image">
                    <i class="ki-duotone ki-pencil fs-7">
                      <span class="path1"></span>
                      <span class="path2"></span>
                    </i>
                    <!--begin::Inputs-->
                    <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                    <input type="hidden" name="image_remove" />
                    <!--end::Inputs-->
                  </label>
                  <!--end::Label-->
                  <!--begin::Cancel-->
                  <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel image">
                    <i class="ki-duotone ki-cross fs-2">
                      <span class="path1"></span>
                      <span class="path2"></span>
                    </i>
                  </span>
                  <!--end::Cancel-->
                  <!--begin::Remove-->
                  <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove image">
                    <i class="ki-duotone ki-cross fs-2">
                      <span class="path1"></span>
                      <span class="path2"></span>
                    </i>
                  </span>
                  <!--end::Remove-->
                </div>
                <!--end::Image input-->
                <!--begin::Hint-->
                <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                <!--end::Hint-->
              </div>
              <!--end::Input group-->
              ';
              // dump($strform);
            }
            else if(str_contains($res_field[$i]->Type,'text')&&($res_field[$i]->Field=="file"))
            {
              $strshow = $res_field[$i]->Field.", ".$res_field[$i]->Field.", text";
              $strform = $strform.'
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="'.$required.' fw-semibold fs-6 mb-2">'.$res_field[$i]->field_label.'</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="file" name="file" class="form-control form-control-sm form-control-solid" placeholder="insert file" value="" />
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              ';
              // dump($strform);
            }
            else if(str_contains($res_field[$i]->Type,'text'))
            {
              $strshow = $res_field[$i]->Field.", ".$res_field[$i]->Field.", text";
              $strform = $strform.'
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="'.$required.' fw-semibold fs-6 mb-2">'.$res_field[$i]->field_label.'</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="text" name="'.$res_field[$i]->Field.'" class="form-control form-control-sm form-control-solid" placeholder="'.$res_field[$i]->Field.'" value="" />
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              ';
              // dump($strform);
            }
            else if(str_contains($res_field[$i]->Type,'enum'))
            {
              $strshow = $res_field[$i]->Field.", ".$res_field[$i]->Field.", enum";
              preg_match('#\((.*?)\)#', $res_field[$i]->Type, $match);
              $strenumdata = str_replace("'","",$match[1]);
              $enumdata = explode(",",$strenumdata);
              
              $stroption ="";
              foreach ($enumdata as $key => $enum) {
                $stroption =$stroption."<option value='".$enum."'>".$enum."</option>";
              }
              $strform = $strform.'
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="'.$required.' fw-semibold fs-6 mb-2">'.$res_field[$i]->field_label.'</label>
                <!--end::Label-->
                <!--begin::Input-->
                <select name="'.$res_field[$i]->Field.'" aria-label="Select a '.$res_field[$i]->Field.'" data-control="select2" data-placeholder="date_period" class="form-select form-select-sm form-select-solid">
														'.$stroption.'
								</select>
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              ';
              // dump($strform);
            }
            else if(str_contains($res_field[$i]->Type,'datetime'))
            {
              $strshow = $res_field[$i]->Field.", ".$res_field[$i]->field_label.", datetime";
              // dump($strshow);
            }
          }
        }

        return $strform;
    }

    function create_input_edit_form($res_field,$USE_CASE)
    {
      $strformedit = '';
        for ($i=0; $i < count($res_field); $i++) { 
          
          if (str_contains($res_field[$i]->validation, 'required')) 
          {
            $required = "required";
          }
          else
          {
            $required = "";
          }

          

          if (($res_field[$i]->Field != "created_at")&&($res_field[$i]->Field != "updated_at")&&($res_field[$i]->show_edit_forms == true))
          //if (($i!=0)&&($res_field[$i]->Field != "created_at")&&($res_field[$i]->Field != "updated_at"))
          {
            if(str_contains($res_field[$i]->type,'int'))
            {
              $strshow = $res_field[$i]->Field.", ".$res_field[$i]->Field.", integer";
               $strformedit = $strformedit.'
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="'.$required.' fw-semibold fs-6 mb-2">'.$res_field[$i]->field_label.'</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="number" name="'.$res_field[$i]->Field.'" class="form-control form-control-sm form-control-solid" placeholder="'.$res_field[$i]->Field.'" value="{{$'.strtolower($USE_CASE).'->'.$res_field[$i]->Field.'}}" />
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              ';
              // dump($strshow);
            }
            else if(str_contains($res_field[$i]->Type,'varchar'))
            {
              $strshow = $res_field[$i]->Field.", ".$res_field[$i]->Field.", varchar";
              $strformedit = $strformedit.'
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="'.$required.' fw-semibold fs-6 mb-2">'.$res_field[$i]->field_label.'</label>
                <!--end::Label-->
                <!--begin::Input-->
                {!! Form::text("'.$res_field[$i]->Field.'", $'.strtolower($USE_CASE).'->'.$res_field[$i]->Field.', array("placeholder" => "'.$res_field[$i]->field_label.'","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              ';
              // dump($strformedit);
            }
            else if(str_contains($res_field[$i]->Type,'text')&&($res_field[$i]->Field=="image"))
            {
              $strshow = $res_field[$i]->Field.", ".$res_field[$i]->Field.", text";
              $strformedit = $strformedit.'
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="d-block fw-semibold fs-6 mb-5">Image</label>
                <!--end::Label-->
                <!--begin::Image placeholder-->
                <style>.image-input-placeholder { background-image: url("assets/media/svg/files/blank-image.svg"); } [data-bs-theme="dark"] .image-input-placeholder { background-image: url("assets/media/svg/files/blank-image-dark.svg"); }</style>
                <!--end::Image placeholder-->
                <!--begin::Image input-->
                <div class="image-input image-input-outline image-input-placeholder" data-kt-image-input="true">
                  <!--begin::Preview existing avatar-->
                  @if (!empty($'.strtolower($USE_CASE).'->image))
                  <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ url("images") }}/'.strtolower($USE_CASE).'/{{ $'.strtolower($USE_CASE).'->image }});"></div>
                                  {{-- <img src="{{ url("images") }}/'.strtolower($USE_CASE).'/{{ $'.strtolower($USE_CASE).'->image }}" alt="Emma Smith" class="w-100" /> --}}
                                @else
                                <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ url("images") }}/imagenotavailable.jpg);"></div>
                                  {{-- <img src="{{ url("images") }}/imagenotavailable.jpg" alt="Emma Smith" class="w-100" /> --}}
                                @endif
                  <!--end::Preview existing avatar-->
                  <!--begin::Label-->
                  <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change image">
                    <i class="ki-duotone ki-pencil fs-7">
                      <span class="path1"></span>
                      <span class="path2"></span>
                    </i>
                    <!--begin::Inputs-->
                    <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                    <input type="hidden" name="image_remove" />
                    <!--end::Inputs-->
                  </label>
                  <!--end::Label-->
                  <!--begin::Cancel-->
                  <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel image">
                    <i class="ki-duotone ki-cross fs-2">
                      <span class="path1"></span>
                      <span class="path2"></span>
                    </i>
                  </span>
                  <!--end::Cancel-->
                  <!--begin::Remove-->
                  <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove image">
                    <i class="ki-duotone ki-cross fs-2">
                      <span class="path1"></span>
                      <span class="path2"></span>
                    </i>
                  </span>
                  <!--end::Remove-->
                </div>
                <!--end::Image input-->
                <!--begin::Hint-->
                <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                <!--end::Hint-->
              </div>
              <!--end::Input group-->
              ';
              // dump($strform);
            }
            else if(str_contains($res_field[$i]->Type,'text')&&($res_field[$i]->Field=="file"))
            {
              $strshow = $res_field[$i]->Field.", ".$res_field[$i]->Field.", text";
              $strformedit = $strformedit.'
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="'.$required.' fw-semibold fs-6 mb-2">'.$res_field[$i]->field_label.'</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="file" name="file" class="form-control form-control-sm form-control-solid" placeholder="insert file" value="" />
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              ';
              // dump($strform);
            }
            else if(str_contains($res_field[$i]->Type,'text'))
            {
              $strshow = $res_field[$i]->Field.", ".$res_field[$i]->Field.", text";
              $strformedit = $strformedit.'
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="'.$required.' fw-semibold fs-6 mb-2">'.$res_field[$i]->field_label.'</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="text" name="'.$res_field[$i]->Field.'" class="form-control form-control-sm form-control-solid" placeholder="'.$res_field[$i]->Field.'" value="{{$'.strtolower($USE_CASE).'->'.$res_field[$i]->Field.'}}" />
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              ';
              // dump($strformedit);
            }
            else if(str_contains($res_field[$i]->Type,'enum'))
            {
              $strshow = $res_field[$i]->Field.", ".$res_field[$i]->Field.", enum";
              preg_match('#\((.*?)\)#', $res_field[$i]->Type, $match);
              $strenumdata = str_replace("'","",$match[1]);
              $enumdata = explode(",",$strenumdata);
              
              $stroption ="";
              foreach ($enumdata as $key => $enum) {
                $stroption =$stroption."<option value='".$enum."'>".$enum."</option>";
              }
              $strformedit = $strformedit.'
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="'.$required.' fw-semibold fs-6 mb-2">'.$res_field[$i]->field_label.'</label>
                <!--end::Label-->
                <!--begin::Input-->
                <select name="'.$res_field[$i]->Field.'" aria-label="Select a '.$res_field[$i]->Field.'" data-control="select2" data-placeholder="date_period" class="form-select form-select-sm form-select-solid">
														'.$stroption.'
								</select>
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              ';
              // dump($strformedit);
            }
            else if(str_contains($res_field[$i]->Type,'datetime'))
            {
              $strshow = $res_field[$i]->Field.", ".$res_field[$i]->Field.", datetime";
              // dump($strshow);
            }
          }
        }

        return $strformedit;
    }

    function create_table($USE_CASE, $res_field)
    {
      $strtable='
      <div class="table-responsive">
                          <table id="datatable-buttons" class="table align-middle table-striped  table-row-dashed fs-6 gy-5 dt-responsive nowrap"
                              style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                              <thead>
                                  <tr>
                                      <th class="min-w-50px sorting">NO</th>                             
      ';

      $str_head = '';
      $str_td = '';

      $jumlahfield = count($res_field);
      // if ($jumlahfield>6) {
      //   $limitfield = 6;
      // }
      // else
      // {
        $limitfield =  $jumlahfield;
      // }

      //dd($res_field[5]->type=="image");

      for ($i=0; $i < $limitfield; $i++) 
      { 
        //if (($i!=0)&&($res_field[$i]->Field != "created_at")&&($res_field[$i]->Field != "updated_at")&&($res_field[$i]->Field != "created_at"))
         if (($res_field[$i]->Field != "created_at")&&($res_field[$i]->Field != "updated_at")&&($res_field[$i]->show_column_list == true))
        {
            
             if ($i==0) {
              $str_head = $str_head.'<th class="min-w-125px sorting">Action</th>' ;
              
              
                $str_td = $str_td.'
                <td>
                        <a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                          <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                          <!--begin::Menu-->
                          <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                              <a class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_show_'.strtolower($USE_CASE).'{{ $'.strtolower($USE_CASE).'->id }}">Show</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                              <a class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_edit_'.strtolower($USE_CASE).'{{ $'.strtolower($USE_CASE).'->id }}">Edit</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                              {!! Form::open(["id" =>"form-id","method" => "DELETE","route" => ["'.strtolower($USE_CASE).'.destroy", $'.strtolower($USE_CASE).'->id],"style"=>"display:inline"]) !!}
                              {{-- {!! Form::submit("Delete", ["class" => "menu-link px-3"]) !!}  --}}
                              <a onclick="document.getElementById('."'".'form-id'."'".').submit();" class="menu-link px-3" data-kt-'.strtolower($USE_CASE).'s-table-filter="delete_row"> Delete</a>
                              {!! Form::close() !!} 
                            
                            </div>
                            <!--end::Menu item-->
                          </div>
                          <!--end::Menu-->
  
                      </td>
                ';
              
             
              // $str_td = $str_td.'<td><a href="{{ route("'.strtolower($USE_CASE).'.show",$'.strtolower($USE_CASE).'->id'.') }}" class="text-gray-800 text-hover-primary mb-1">{{ $'.strtolower($USE_CASE).'->'.$res_field[$i]->Field.' }}</a></td>';
             }
             else{
              $str_head = $str_head.'<th class="min-w-125px sorting">'.ucwords(str_replace("_"," ",$res_field[$i]->Field)).'</th>' ;
              #jika type inputan adalah image
              if ($res_field[$i]->type=="image") {
                $str_td = $str_td.'
                <td class="align-items-center">
                                        <!--begin:: Avatar -->
                                      <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                        <a href="{{ route("'.strtolower($USE_CASE).'.show",$'.strtolower($USE_CASE).'->id) }}">
                                          <div class="symbol-label">
                                            @if (!empty($'.strtolower($USE_CASE).'->image))
                                              <img src="{{ url("images") }}/'.strtolower($USE_CASE).'/{{ $'.strtolower($USE_CASE).'->image }}" alt="Emma Smith" class="w-100" />
                                            @else
                                              <img src="{{ url("images") }}/imagenotavailable.jpg" alt="Emma Smith" class="w-100" />
                                            @endif
                                            
                                          </div>
                                        </a>
                                      </div>
                                      <!--end::Avatar-->
                                      <!--begin::'.strtolower($USE_CASE).' details-->
                                      <div class="d-flex flex-column">
                                                                        
                                      
                                      </div>
															      <!--begin::'.strtolower($USE_CASE).' details-->

                                  </td>
                ';
              }
              else if ($res_field[$i]->type=="file") {
                $str_td = $str_td.'
                <td class="align-items-center">
                <a href="{{ url("files") }}/'.strtolower($USE_CASE).'/{{ $'.strtolower($USE_CASE).'->file}}" alt="" class="w-100" > {{ $'.strtolower($USE_CASE).'->file}} </a>                       
                </td>
                ';
              }
              else
              {
               $str_td = $str_td.'<td><a href="{{ route("'.strtolower($USE_CASE).'.show",$'.strtolower($USE_CASE).'->id'.') }}" class="text-gray-800 text-hover-primary mb-1">{{ Str::limit($'.strtolower($USE_CASE).'->'.$res_field[$i]->Field.',25) }}</a></td>';
              }
             }
             
        }
        else
        {
        //   if ($i==$limitfield-1) {
        //     $str_head = $str_head.'<td class="text-end">Action</th>' ;
        //     $str_td = $str_td.'
        //     <td class="text-end">
        //             <a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
        //               <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
        //               <!--begin::Menu-->
        //               <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
        //                 <!--begin::Menu item-->
        //                 <div class="menu-item px-3">
        //                   <a class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_edit_'.strtolower($USE_CASE).'{{ $'.strtolower($USE_CASE).'->id }}">Edit</a>
        //                 </div>
        //                 <!--end::Menu item-->
        //                 <!--begin::Menu item-->
        //                 <div class="menu-item px-3">
        //                   {!! Form::open(["id" =>"form-id","method" => "DELETE","route" => ["'.strtolower($USE_CASE).'.destroy", $'.strtolower($USE_CASE).'->id],"style"=>"display:inline"]) !!}
        //                   {{-- {!! Form::submit("Delete", ["class" => "menu-link px-3"]) !!}  --}}
        //                   <a onclick="document.getElementById('."'".'form-id'."'".').submit();" class="menu-link px-3" data-kt-'.strtolower($USE_CASE).'s-table-filter="delete_row"> Delete</a>
        //                   {!! Form::close() !!} 
                        
        //                 </div>
        //                 <!--end::Menu item-->
        //               </div>
        //               <!--end::Menu-->

        //           </td>
        //     ';
        //     // $str_td = $str_td.'<td><a href="{{ route("'.strtolower($USE_CASE).'.show",$'.strtolower($USE_CASE).'->id'.') }}" class="text-gray-800 text-hover-primary mb-1">{{ $'.strtolower($USE_CASE).'->'.$res_field[$i]->Field.' }}</a></td>';
        //    }

        }
      }
      $strtable = $strtable.$str_head.'
           
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $key => $'.strtolower($USE_CASE).')
                <tr>
                    <td style="color:rgba(80, 74, 74, 0.333)" class=" align-items-center text-center"> <a href="{{ route("'.strtolower($USE_CASE).'.show",$'.strtolower($USE_CASE).'->id) }}" class="text-gray-800 text-hover-primary mb-1">{{ ++$i }}</a></td>
                    '.$str_td.'
                </tr>
            @endforeach

          </tbody>
          </table>
          </div>
      ';
      return $strtable;
    }

    function create_route($USE_CASE)
    {
      $controllername = "\\"."\\".$USE_CASE."\\"."\\".$USE_CASE."Controller";
      
     //dd("insert into setting_route (route_name,grp,type,controller_name,method,stats)values('".strtolower($USE_CASE)."','web', 'resources', 'App\\\Http\\Controllers\\Back\\".$controllername."','','')");
      try {
      $createroute = DB::insert("insert into setting_route (route_name,grp,type,controller_name,method,stats)values('".strtolower($USE_CASE)."','web', 'resources', 'App\\\Http\\\Controllers\\\Back\\".$controllername."','','')");

      $message = ("Your route sucessfully created<br>");
      }
      catch (\Throwable $th) {
      $message = ("some trouble create routes<br>");
      }

      return $message;
    }

}
