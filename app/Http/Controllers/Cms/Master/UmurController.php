<?php

namespace App\Http\Controllers\Cms\Master;

use App\Http\Controllers\Cms\Controllermaster;
use Illuminate\Http\Request;
use App\Models\Master\Umur;
use Session;
use Input;

class UmurController extends Controllermaster
{
    public function __construct()
    {

        $this->model = new Umur;
        $this->primaryKey = 'umurId';
        $this->mainroute = 'msumur';
        $this->mandatory = array(
            'compId' => 'required'
        );

        $this->grid = array(
            array(
                'label' => 'RANGE UMUR',
                'field' => 'umurNama',
                'type' => 'text',
                'width' => ''
            ),
        );


        $this->form = array(
            array(
                'label' => 'RANGE UMUR',
                'field' => 'umurNama',
                'type' => 'text',
                'placeholder' => 'Masukan Umur',
                'keterangan' => '* Wajib Diisi',
                // 'col'=>6
            ),
        );
    }

    public function index()
    {

        // return $this->yatidak;

        if (trim(Session::get('email')) == '' or $this->checkRouteAuth() == 2) {
            $wallidx = rand(1, 7);
            $data = array(
                'wallidx' => $wallidx,
                'message' => 'Anda telah logout dari system.',
            );
            return view('login', $data);
        } else {

            $compId = Session::get('compId');
            $compStatus = Session::get('compStatus');

            $search = !empty($_GET['search']) ? $_GET['search'] : '';
            if($compStatus == 1){
                if ($search == '') {
                    $listdata = $this->model
                        ->latest()
                        ->paginate(15);
                } else {
                    $listdata = $this->model
                        ->where('umurNama', 'like', '%' . $search . '%')
                        ->paginate(15);
                }
            }else{
                if ($search == '') {
                    $listdata = $this->model
                        ->latest()
                        ->where('compId', '=', $compId)
                        ->paginate(15);
                } else {
                    $listdata = $this->model
                        ->where('umurNama', 'like', '%' . $search . '%')
                        ->where('compId', '=', $compId)
                        ->paginate(15);
                }
            }


            $data = array(
                'authmenu' => $this->getusermenu(),
                'company' => Session::get('compNama'),
                'logo' => Session::get('compLogo'),
                'detail' => Session::get('compDetail'),
                'name' => Session::get('name'),
                'namelong' => Session::get('email'),
                'page_tittle' => 'Master Umur',
                'page_active' => 'Master Umur',
                'grid' => $this->grid,
                'form' => $this->form,
                'listdata' => $listdata,
                'primaryKey' => $this->primaryKey,
                'mainroute' => $this->mainroute,
                'compId' => $compId,
                'code' => 0,
            );

            return view('cms.Master.index', $data)->with('data', $data);
        }
    }
}
