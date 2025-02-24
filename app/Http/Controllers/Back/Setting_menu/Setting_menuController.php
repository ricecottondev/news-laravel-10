<?php
        namespace App\Http\Controllers\Back\Setting_menu;
        use Illuminate\Http\Request;
        use App\Http\Controllers\Controller;
        use App\Models\Setting_menu;
        use DB;
        use Hash;
        use Illuminate\Support\Arr;

        class Setting_menuController extends Controller
        {
            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
        
            public function index(Request $request)
            {
                $data = Setting_menu::orderBy("id","DESC")->get();
                return view("back.Setting_menu.index",compact("data"))
                    ->with("i", ($request->input("page", 1) - 1) * 5);
            }
        
            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
        
            public function create()
            {
                return view("back.Setting_menu.create");
            }
        
        
        
            /**
             * Store a newly created resource in storage.
             *
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response
             */
        
            public function store(Request $request)
            {
               
                    
               
            
                $input = $request->all();
                $Setting_menu = Setting_menu::create($input);
               
            
                return redirect()->route("setting_menu.index")
                ->with("success","Setting_menu created successfully");
            
            }
        
        
            /**
                 * Display the specified resource.
                 *
                 * @param  int  $id
                 * @return \Illuminate\Http\Response
                 */
        
                public function show($id)
                {
                    $Setting_menu = Setting_menu::find($id);
                    return view("back.Setting_menu.show",compact("Setting_menu"));
                }
            

            
                /**
                 * Show the form for editing the specified resource.
                 *
                 * @param  int  $id
                 * @return \Illuminate\Http\Response
                 */
            
                public function edit($id)
                {
                    $Setting_menu = Setting_menu::find($id);
                    return view("back.Setting_menu.edit",compact("Setting_menu"));
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
                
                   
                        
                  

                    $input = $request->all();
                    
                    $Setting_menu = Setting_menu::find($id);
                    $Setting_menu->update($input);
                
                    return redirect()->route("setting_menu.index")
                    ->with("success","Setting_menu updated successfully");
                
                }
            

                /**
                 * Remove the specified resource from storage.
                 *
                 * @param  int  $id
                 * @return \Illuminate\Http\Response
                 */
            
                public function destroy($id)
                {
                    Setting_menu::find($id)->delete();
                    return redirect()->route("setting_menu.index")
                    ->with("success","Setting_menu deleted successfully");
                
                }
            }
        
        ?>
