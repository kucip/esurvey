<?php

namespace App\Http\Controllers\Cms\Combo\Master;

use App\Http\Controllers\Cms\Controllercombo;
use App\Models\Menu;

class ComboparentController extends Controllercombo
{
    public function __construct(){
        $this->model=new Menu();
        $this->combodata=array(
                                'id' => 'menuId',
                                'kode' => 'menuId',
                                'nama' => 'menuNama',
                              );
    }
}
