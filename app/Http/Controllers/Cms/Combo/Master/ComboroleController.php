<?php

namespace App\Http\Controllers\Cms\Combo\Master;

use App\Http\Controllers\Cms\Controllercombo;
use App\Models\Role;

class ComboroleController extends Controllercombo
{
    public function __construct(){
        $this->model=new Role();
        $this->combodata=array(
                                'id' => 'roleId',
                                'kode' => 'roleId',
                                'nama' => 'roleNama',
                              );
    }       
}
