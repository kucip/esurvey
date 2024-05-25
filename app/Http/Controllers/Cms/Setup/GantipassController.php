<?php

namespace App\Http\Controllers\Cms\Setup;

use App\Http\Controllers\Cms\Controllermaster;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use Session;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;

class GantipassController extends Controllermaster
{

    public function __construct(){

        $this->model=new User;
        $this->primaryKey='id';
        $this->mainroute='gantipass';

        $this->mandatory=array(
                                'password' => 'required'
                              );
    }


    public function index(){


        if(trim(Session::get('email'))=='' or $this->checkRouteAuth()==2){
            $wallidx=rand(1,7);
            $data = array(
                    'wallidx' => $wallidx,
                    'message' => 'Anda telah logout dari system.',
                    );
            return view('login',$data);
        }else{

            $email=Session::get('email');
            $data=$this->model
                  ->where('email','=',$email)
                  ->get();


            $formdata=array(
                            array(
                                    'label'=>'USER',
                                    'field'=>'name',
                                    'type'=>'text',
                                    'readonly'=>'readonly="true"',
                                    'placeholder'=>'Masukan User',
                                    'data'=>$data[0]->name,
                                    'keterangan'=>''
                                ),
                            array(
                                    'label'=>'EMAIL',
                                    'field'=>'email',
                                    'type'=>'text',
                                    'placeholder'=>'Masukan Email',
                                    'readonly'=>'readonly="true"',
                                    'data'=>$data[0]->email,
                                    'keterangan'=>''
                                ),
                            array(
                                    'label'=>'PASSWORD BARU',
                                    'field'=>'password',
                                    'type'=>'password',
                                    'placeholder'=>'Masukan Password Baru',
                                    'readonly'=>'',
                                    'data'=>'',
                                    'keterangan'=>''
                                ),
                         );

            $data = array(
                    'authmenu'=>$this->getusermenu(),
                    'company' => Session::get('compNama'),
                    'logo' => Session::get('compLogo'),
                    'detail' => Session::get('compDetail'),
                    'name' => Session::get('name'),
                    'namelong' => Session::get('email'),
                    'page_tittle'=> 'Ganti Password',
                    'page_active'=> 'Ganti Password',
                    'form'=>$formdata,
                    'listdata'=> $data,
                    'primaryKey'=>$this->primaryKey,
                    'primaryKeyData'=>$data[0]->id,
                    'mainroute' => $this->mainroute,
                    'code'=>0,
                    );
            return view('cms.Setup.gantipass',$data)->with('data', $data);
        }


    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),$this->mandatory);
        if($validator->fails()){
            $messages = [
                'data' => $validator->errors(),
                'status' => 401,
            ];
            return response()->json($messages);
        }

        $data=array(
                        'password' => Hash::make($request->password)
                     );

        // $data=$request->all();

        $this->model->find($id)->update($data);
        return $data;
    }

}
