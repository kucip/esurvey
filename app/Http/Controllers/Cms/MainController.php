<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Cms\Controllermaster;
use Illuminate\Http\Request;
use Session;

class MainController extends Controllermaster
{
    public function index(){
        if(trim(Session::get('email'))==''){

            $wallidx=2;
            $data = array(
                'wallidx' => $wallidx,
                'message' => '',
            ); 
            return view('cms.login',$data);        
        }else{
                
                $data = array(
                        'authmenu'=>$this->getusermenu(),
                        'company' => Session::get('compNama'),
                        'logo' => Session::get('compLogo'),
                        'detail' => Session::get('compDetail'),
                        'lokasi' => Session::get('compLokasi'),
                        'name' => Session::get('name'),
                        'namelong' => Session::get('email'),
                        'tittle'=>'Home',
                        'page_tittle'=> 'Home',
                        'page_active'=>'Home'
                        );

                return view('cms.home',$data)->with('data', $data);
        }
    }

    public function dashboard(){
        if(trim(Session::get('email'))==''){

            $wallidx=2;
            $data = array(
                'wallidx' => $wallidx,
                'message' => '',
            ); 
            return view('cms.login',$data);        
        }else{
                
                $data = array(
                        'authmenu'=>$this->getusermenu(),
                        'company' => Session::get('compNama'),
                        'logo' => Session::get('compLogo'),
                        'detail' => Session::get('compDetail'),
                        'lokasi' => Session::get('compLokasi'),
                        'name' => Session::get('name'),
                        'namelong' => Session::get('email'),
                        'tittle'=>'Home',
                        'page_tittle'=> 'Home',
                        'page_active'=>'Home'
                        );

                return view('cms.home',$data)->with('data', $data);
        }
    }

}
