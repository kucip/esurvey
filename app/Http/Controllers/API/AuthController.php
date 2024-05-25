<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Cms\Controller;
use App\Http\Controllers\Cms\Controllermaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\Models\User;
use App\Models\Company;
use Session;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        if ($request['g-recaptcha-response']) {
            $controllermaster = new Controllermaster();
            $check_recaptcha = $controllermaster->recaptcha($request['g-recaptcha-response']);

            if ($check_recaptcha['success'] == false) {
                $data = array(
                    'isLogin' => 0,
                    'message' => 'Recaptcha Missmatch',
                );
                return view('web.register', $data)->with('data', $data);
            }
        }

        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4'
        ]);

        if($validator->fails()){
            $data = array(
                'isLogin' => 0,
                'message' => 'Registrasion failed, email or username already taken !',
            );
            return view('web.register', $data)->with('data', $data);
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role' => 0,
            'password' => Hash::make($request->password)
         ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        return redirect('/login');
    }

    public function logincms(Request $request)
    {

        if ($request['g-recaptcha-response']) {
            $controllermaster = new Controllermaster();
            $check_recaptcha = $controllermaster->recaptcha($request['g-recaptcha-response']);

            if ($check_recaptcha['success'] == false) {
                return redirect('/cms');
            }
        }


        if(!Auth::attempt($request->only('email', 'password'))){
            return redirect('/cms');
        }

        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        $company = Company::where('compId', $user->compId)->firstOrFail();

        
        Session::put('compId',$user->compId);
        Session::put('compNama',$company->compNama);
        Session::put('compStatus',$company->compStatus);
        Session::put('name',$user->name);
        Session::put('username',$user->username);
        Session::put('compLogo',$company->compLogo);
        Session::put('compLokasi',$company->compLokasi);
        Session::put('compDetail',$company->compDetail);
        Session::put('email',$user->email);
        Session::put('role',$user->role);

        return redirect('/cms');
    }


    public function loginweb(Request $request)
    {

        if ($request['g-recaptcha-response']) {
            $controllermaster = new Controllermaster();
            $check_recaptcha = $controllermaster->recaptcha($request['g-recaptcha-response']);

            if ($check_recaptcha['success'] == false) {
                return redirect('/login');
            }
        }

        if (!Auth::attempt($request->only('email', 'password'))){
            return redirect('/login');
        }

        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        Session::put('userid',$user->id);
        Session::put('name',$user->name);
        Session::put('username',$user->username);
        Session::put('email',$user->email);
        return redirect('/web');
    }


    public function logoutcms(){
        Session::put('name','');
        Session::put('username','');
        Session::put('email','');
        Session::put('compId','');
        Session::put('compNama','');
        Session::put('compStatus','');
        Session::put('compLogo','');
        Session::put('compLokasi','');
        Session::put('compDetail','');
        Session::put('role','');
        auth()->user()->tokens()->delete();
        return redirect('/cms');
    }

    public function logoutweb()
    {
        Session::put('userid','');
        Session::put('name','');
        Session::put('username','');
        Session::put('email','');
        auth()->user()->tokens()->delete();
        return redirect('/web');

    }


}