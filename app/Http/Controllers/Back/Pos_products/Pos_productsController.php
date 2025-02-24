<?php
        namespace App\Http\Controllers\Back\Pos_products;
        use Illuminate\Http\Request;
        use App\Http\Controllers\Controller;
        use App\Models\Pos_products;
        use DB;
        use Hash;
        use Illuminate\Support\Arr;

        class Pos_productsController extends Controller
        {
            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
        
            public function index(Request $request)
            {
                $data = Pos_products::orderBy("id","DESC")->get();
                return view("back.Pos_products.index",compact("data"))
                    ->with("i", ($request->input("page", 1) - 1) * 5);
            }
        
            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
        
            public function create()
            {
                return view("back.Pos_products.create");
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
"price" => "required",
]);
                $input = $request->all();
                
                
                $Pos_products = Pos_products::create($input);
               
            
                return redirect()->route("pos_products.index")
                ->with("success","Pos_products created successfully");
            
            }
        
        
            /**
                 * Display the specified resource.
                 *
                 * @param  int  $id
                 * @return \Illuminate\Http\Response
                 */
        
                public function show($id)
                {
                    $Pos_products = Pos_products::find($id);
                    return view("back.Pos_products.show",compact("Pos_products"));
                }
            

            
                /**
                 * Show the form for editing the specified resource.
                 *
                 * @param  int  $id
                 * @return \Illuminate\Http\Response
                 */
            
                public function edit($id)
                {
                    $Pos_products = Pos_products::find($id);
                    return view("back.Pos_products.edit",compact("Pos_products"));
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
"price" => "required",
]);
                        

                    $input = $request->all();

                    
                    
                    
                    $Pos_products = Pos_products::find($id);
                    $Pos_products->update($input);
                
                    return redirect()->route("pos_products.index")
                    ->with("success","Pos_products updated successfully");
                
                }
            

                /**
                 * Remove the specified resource from storage.
                 *
                 * @param  int  $id
                 * @return \Illuminate\Http\Response
                 */
            
                public function destroy($id)
                {
                    Pos_products::find($id)->delete();
                    return redirect()->route("pos_products.index")
                    ->with("success","Pos_products deleted successfully");
                
                }
            }
        
        ?>