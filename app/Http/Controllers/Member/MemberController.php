<?php
/**
 * author : Suryo Atmojo <suryoatm@gmail.com>
 * project : Supresso Laravel
 * Start-date : 19-09-2022
 */

namespace App\Http\Controllers\Member;

use App\Models\Member_model;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;

use App\Models\User;


use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Vend\VendController;

class MemberController extends Controller
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
       #get data member web dari database
        $resmember_models =  DB::table('member_models')
            ->get();

        #get data member vend untuk mendapatkan jumlah data
        $membervend = (new VendController)->getvendcustomersvend(0);
        $total_count = (round((($membervend["total_count"])/1000),0));
      

        $totalmember = [];
        $limit = 0;

        #perulangan untuk get data berdasarkan page, ada batasan 1000 data saja untuk output
        for ($i=0; $i < $total_count ; $i++) {
            $offset = $i * 1000;
            $membervend = (new VendController)->getvendcustomersvend($offset);
            for ($m=0; $m < count($membervend["data"]); $m++) { 
                #proses penggabungan data dari semua page
                array_push($totalmember,$membervend["data"][$m]);
            }
        }

     
        #restructur data, mencari status vend apakah memebr web sudah ada di vend atau belum
        $dataMember = [];
        for ($i = 0; $i < count($resmember_models); $i++) {
            $dataMember = $resmember_models;
            $status = $this->searchForemail($resmember_models[$i]->email, $totalmember);
            $dataMember[$i]->vend = $status;
        }

        $member_models =  $dataMember;

      
        return view('members/index', compact('member_models', 'totalmember'))
            ->with('i', ($request->input('page', 1) - 1) * 5)
            ->with('m', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products/create');
    }

    function searchForemail($id, $array)
    {
        //
        foreach ($array as $key => $val) {
            //dump($val['email']);
            if ($val['email'] === $id) {
                return $val['id'];
            }
        }
        return null;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd("ayam");
        $this->validate($request, [
            'product' => 'required'
        ]);

        $product_models = Blog_article_category_model::create([
            'id_category_product' => $request->id_category_product,
            'product' => $request->product,
            'description' => $request->description,
            // 'slug' => Str::slug($request->product)
        ]);

        if ($product_models) {
            return redirect()
                ->route('product.index')
                ->with([
                    'success' => 'New post has been created successfully'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog_article_category_models = Blog_article_category_model::find($id);
        return view('blog-article-categorys.show', compact('blog_article_category_models'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product_models = Blog_article_category_model::findOrFail($id);
        return view('products.edit', compact('product_models'));
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
        $this->validate($request, [
            'product' => 'required'
        ]);

        $product_models = Blog_article_category_model::findOrFail($id);

        $product_models->update([
            'id_category_product' => $request->id_category_product,
            'product' => $request->product,
            'description' => $request->description,
        ]);

        if ($product_models) {
            return redirect()
                ->route('product.index')
                ->with([
                    'success' => 'Post has been updated successfully'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem has occured, please try again'
                ]);
        }
    }

    public function GetMemberInformation()
    {
        $userId = auth()->user()->id;
        $GetMember_res =  DB::select('select * from member_models where id_users_login = ' . $userId);
        $GetMember = $GetMember_res[0];

        $Member = [];
        $AddressMember = [];
        $mbr = $GetMember;
        $AddressMember = DB::select('select * from member_address_models where idmembers = ' . $GetMember->id_users_login);
        $mbr->AddressMember = $AddressMember;
        array_push($Member, $mbr);


        return $Member;
    }

    public function shazam()
    {

    
    $update = User::where('email', 'suryoatm@gmail.com')
    ->update(['password' => Hash::make("agus123")]);

    if ($update) {
        dd("updated");
    }

    }

    public function expectopatronum()
    {

        $resmember = DB::select('select * from member_models');

        for ($i = 0; $i <  count($resmember); $i++) {

            $explode = explode("@",$resmember[$i]->email);
            $explode[0]=str_replace(".","",$explode[0]);
            $email = implode("@", $explode);

            $resfindmember = DB::select("select * from users where email ='" . $resmember[$i]->emailtanpatitik . "'");
            $password = $this->encrypt_decrypt('decrypt', $resmember[$i]->password);
            if (count($resfindmember) == 0) {
                dump("=========");
                dump($email);
                dump($resfindmember);
                 dump("=========");
                try {


                    // $user = User::create([
                    //     'name' => $resmember[$i]->username,
                    //     'email' => $resmember[$i]->email,
                    //     'password' => Hash::make($password),
                    // ]);

                    // $user->assignRole('member');
                    dump($resmember[$i]->username . "-" . $password . " success");
                }
                //catch exception
                catch (Exception $e) {
                    echo 'Message: ' . $e->getMessage();
                }
            } else {
                dump("id : ". $resmember[$i]->id ." = ".$email ."-".$resmember[$i]->email . " : " . $resmember[$i]->username . "- " . $password . " - already exist on id : " . $resfindmember[0]->id);
                DB::update("update member_models SET id_users_login = " . $resfindmember[0]->id . " WHERE id = " . $resmember[$i]->id . "; ");
                User::where('email', $email)
                ->update(['password' => $password]);
            }
        }
        dd("tets");

        //DB::update("update member_models SET id_users_login = ".." WHERE condition; ");
    }



    public function encrypt_decrypt($action, $string)
    {
        $output = false;

        $encrypt_method = "AES-256-CBC";
        $secret_key = 'osdkfje';
        $secret_iv = 'sdfvcdfeg';

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a
        // warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else {
            if ($action == 'decrypt') {
                $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
            }
        }

        return $output;
    }
}
