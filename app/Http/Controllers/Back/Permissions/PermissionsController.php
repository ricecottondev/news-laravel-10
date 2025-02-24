<?php
        namespace App\Http\Controllers\Back\Permissions;
        use Illuminate\Http\Request;
        use App\Http\Controllers\Controller;
        use App\Models\Permissions;
        use DB;
        use Hash;
        use Illuminate\Support\Arr;

        class PermissionsController extends Controller
        {
            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
        
            public function index(Request $request)
            {
                $data = Permissions::orderBy("id","DESC")->get();
                return view("back.Permissions.index",compact("data"))
                    ->with("i", ($request->input("page", 1) - 1) * 5);
            }
        
            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
        
            public function create()
            {
                return view("back.Permissions.create");
            }
        
        
        
            /**
             * Store a newly created resource in storage.
             *
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response
             */
        
            public function store(Request $request)
            {
               
                    $this->validate($request, ["name" => "required",
"guard_name" => "required",
]);
                $input = $request->all();
                
                
                $Permissions = Permissions::create($input);
               
            
                return redirect()->route("permissions.index")
                ->with("success","Permissions created successfully");
            
            }
        
        
            /**
                 * Display the specified resource.
                 *
                 * @param  int  $id
                 * @return \Illuminate\Http\Response
                 */
        
                public function show($id)
                {
                    $Permissions = Permissions::find($id);
                    return view("back.Permissions.show",compact("Permissions"));
                }
            

            
                /**
                 * Show the form for editing the specified resource.
                 *
                 * @param  int  $id
                 * @return \Illuminate\Http\Response
                 */
            
                public function edit($id)
                {
                    $Permissions = Permissions::find($id);
                    return view("back.Permissions.edit",compact("Permissions"));
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
                
                   
                        $this->validate($request, ["name" => "required",
"guard_name" => "required",
]);
                        

                    $input = $request->all();

                    
                    
                    
                    $Permissions = Permissions::find($id);
                    $Permissions->update($input);
                
                    return redirect()->route("permissions.index")
                    ->with("success","Permissions updated successfully");
                
                }
            

                /**
                 * Remove the specified resource from storage.
                 *
                 * @param  int  $id
                 * @return \Illuminate\Http\Response
                 */
            
                public function destroy($id)
                {
                    Permissions::find($id)->delete();
                    return redirect()->route("permissions.index")
                    ->with("success","Permissions deleted successfully");
                
                }
            }
        
        ?>