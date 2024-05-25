<?php

namespace App\Http\Controllers\Web;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Session;
class WebController extends BaseController {

    public function index(){
        return view('comingsoon');
    }

    public function webdev(){

        $name = trim(Session::get('name'));
        if($name<>''){
            $data = array('isLogin'=>1,'message'=>'','name'=>$name);
        }else{
            $data = array('isLogin'=>0,'message'=>'','name'=>'');
        }
        return view('web.index', $data)->with('data', $data);
    }

    public function login(){
        $data = array('isLogin'=>0,'message'=>'');
        return view('web.login', $data)->with('data', $data);
    }

    public function register(){
        $data = array('isLogin'=>0,'message'=>'');
        return view('web.register', $data)->with('data', $data);
    }

}
