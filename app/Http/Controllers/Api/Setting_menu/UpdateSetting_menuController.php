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

        class UpdateSetting_menuController extends Controller
        {
            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function Index(Request $request)
            {
                $change = false;
                // $data = json_decode($request->menu);
                $data = json_decode($request->menu);
                $payLoad = json_decode($data);
                //dd($payLoad);
                for ($i=0; $i < count($payLoad); $i++) { 
                    // dump("label");
                     $element = $payLoad[$i];
                     //dump($element["id"]);
                     $update = Setting_menu::where("id", $element->id)->first();

                     if ($update->ord <> $i+1) {
                        $update->ord = $i+1;
                        $update->save();
                        $change = true;
                     }
                     
                     
                     if($element->children)
                     {
                        // dump("punya child");
                         $child = $element->children;
                         for ($c = 0; $c < count($child); $c++) {
                            // dump("=============================================");
                             $elementchild = $child[$c];
                             $update = Setting_menu::where("id", $elementchild->id)->first();
                             if ($update->menu_parent <> $element->id ||$update->ord <> $c+1) {
                             $update->menu_parent = $element->id;
                             $update->ord = $c+1;
                             $update->save();
                             $change = true;
                             }
                            // dump($elementchild);
                             if(!empty($elementchild->children))
                             {
                                // dump("punya subchild");
                                 $subchild = $elementchild->children;
                                 for ($sc = 0; $sc < count($subchild); $sc++) {
                                     $elementsubchild = $subchild[$sc];
                                     $update = Setting_menu::where("id", $elementsubchild->id)->first();
                                     if ($update->menu_parent <> $elementchild->id ||$update->ord <> $sc+1) {
                                     $update->menu_parent = $elementchild->id;
                                     $update->ord = $sc+1;
                                     $update->save();
                                     $change = true;
                                     }
                                    // dump($elementsubchild);       
                                 }
                             }
                             else
                             {
                                // dump("not child");
                             }


                         }
                     }
                     else
                     {
                        // dump("not child");
                     }
                }
                //dd("test");
                //dd($payLoad[0]["children"]);

                if ($change==false) {
                    return response("no change");
                }
                else
                {
                    return response("Your member data sucessfully updated");
                }
               
                
                     #update member
                    //  $update = Setting_menu::where("id", $request->id)->first();
                    //  $update->menu_name = $request->menu_name;
                    //  $update->menu_label = $request->menu_label;
                    //  $update->menu_url = $request->menu_url;
                    //  $update->menu_color = $request->menu_color;
                    //  $update->menu_parent = $request->menu_parent;
                    //  $update->menu_icon = $request->menu_icon;
                    //  $update->type = $request->type;
                    //  $update->ord = $request->ord;
                    //  $update->extensiontarget = $request->extensiontarget;
                    //  $update->status = $request->status;
                    //  $update->deleted = $request->deleted;

             
                    //  try {
                    //      $update->save();
                    //      return response("Your member data sucessfully updated");
                    //  } catch (\Throwable $th) {
                    //      return response("ERROR update data " . $th->getMessage(), 400);
                    //  }
        
              
            }
        }
        
        ?>