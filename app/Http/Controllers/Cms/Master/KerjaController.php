<?php

namespace App\Http\Controllers\Cms\Master;

use App\Http\Controllers\Cms\Controllermaster;
use Illuminate\Http\Request;
use App\Models\Master\Kerja;
use Session;
use Input;

class KerjaController extends Controllermaster
{
    public function __construct()
    {

        $this->model = new Kerja;
        $this->primaryKey = 'kerjaId';
        $this->mainroute = 'mskerja';
        $this->mandatory = array(
            'compId' => 'required'
        );

        $this->grid = array(
            array(
                'label' => 'PEKERJAAN',
                'field' => 'kerjaNama',
                'type' => 'text',
                'width' => ''
            ),
        );


        $this->form = array(
            array(
                'label' => 'PEKERJAAN',
                'field' => 'kerjaNama',
                'type' => 'text',
                'placeholder' => 'Masukan Unit',
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
                        ->where('kerjaNama', 'like', '%' . $search . '%')
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
                        ->where('kerjaNama', 'like', '%' . $search . '%')
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
                'page_tittle' => 'Master Pekerjaan',
                'page_active' => 'Master Pekerjaan',
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
