<?php

namespace App\Http\Controllers\Cms\Setup;

use App\Http\Controllers\Cms\Controllermaster;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Menu;
use App\Models\Rolemenu;
use Session;
use Input;

class RolemenuController extends Controllermaster
{
    public function __construct()
    {
        $this->compId = Session::get('compId');
        $this->compNama = Session::get('compNama');
        $this->compStatus = Session::get('compStatus');
        $this->model = new Rolemenu;
        $this->primaryKey = 'rmId';
        $this->mainroute = 'rolemenu';
        $this->mandatory = array(
            'compId' => 'required',
            'rmRoleId' => 'required',
            'rmMenuId' => 'required',
        );
    }

    public function index()
    {

        if (trim(Session::get('email')) == '' or $this->checkRouteAuth() == 2) {
            $wallidx = rand(1, 7);
            $data = array(
                'wallidx' => $wallidx,
                'message' => 'Anda telah logout dari system.',
            );
            return view('login', $data);
        } else {
            if($this->compStatus == 1){
                $role = Role::all();
                $menu = Menu::all();
                $role_menu = $this->model->all();
            }else{
                $role = Role::where('compId', '=', $this->compId)->get();
                $menu = Menu::where('compId', '=', $this->compId)->get();
                $role_menu = $this->model->where('compId', '=', $this->compId)->get();
            }

            $data = array(
                'authmenu' => $this->getusermenu(),
                'company' => Session::get('compNama'),
                'logo' => Session::get('compLogo'),
                'detail' => Session::get('compDetail'),
                'name' => Session::get('name'),
                'namelong' => Session::get('email'),
                'page_tittle' => 'Role Menu',
                'page_active' => 'Role Menu',
                'role' => $role,
                'menu' => $menu,
                'rolemenu' => $role_menu,
                'primaryKey' => $this->primaryKey,
                'mainroute' => $this->mainroute,
                'compId' => $this->compId,
                'code' => 0,
            );
            return view('cms.Setup.rolemenu', $data)->with('data', $data);
        }
    }

    public function store(Request $request)
    {
        $datamenu = $request->get('data');
        $compId = Session::get('compId');
        $roleId = $request->get('roleId');
        $this->model
            // ->where('compId','=',$compId)
            ->where('rmRoleId', '=', $roleId)
            ->delete();

        foreach ($datamenu as $val) {
            $result = Rolemenu::create([
                'compId' => $compId,
                'rmRoleId' => $roleId,
                'rmMenuId' => $val,
            ]);
        }

        return $request->get('roleId');
    }
}
