<?php

namespace App\Http\Controllers\Cms\Master;

use App\Http\Controllers\Cms\Controllermaster;
use Illuminate\Http\Request;
use App\Models\Master\Mspertanyaan;
use Session;
use Input;

class MspertanyaanController extends Controllermaster
{
    public function __construct()
    {

        $this->model = new Mspertanyaan;
        $this->primaryKey = 'surId';
        $this->mainroute = 'mspertanyaan';
        $this->mandatory = array(
            'compId' => 'required'
        );

        $this->grid = array(
            array(
                'label' => 'PERTANYAAN',
                'field' => 'surPertanyaan',
                'type' => 'text',
                'width' => ''
            ),

        );

        $this->yatidak= [
                            array('comboValue'=>0,'comboLabel'=>'TIDAK'),
                            array('comboValue'=>1,'comboLabel'=>'YA')
                        ];


        $this->form = array(
            array(
                'label' => 'PERTANYAAN',
                'field' => 'surPertanyaan',
                'type' => 'textarea',
                'placeholder' => 'Masukan Pertanyaan',
                'keterangan' => '* Wajib Diisi',
                // 'col'=>6
            ),
            array(
                'label' => 'JAWABAN 1',
                'field' => 'surOpt1',
                'type' => 'text',
                'placeholder' => 'Opsi 1',
                'keterangan' => '* Wajib Diisi',
                'col'=>8
            ),
            array(
                'label' => 'BOBOT 1',
                'field' => 'surBobot1',
                'type' => 'text',
                'placeholder' => 'Bobot 1',
                'keterangan' => '* Wajib Diisi',
                'col'=>4
            ),
            array(
                'label' => 'JAWABAN 2',
                'field' => 'surOpt2',
                'type' => 'text',
                'placeholder' => 'Opsi 2',
                'keterangan' => '* Wajib Diisi',
                'col'=>8
            ),
            array(
                'label' => 'BOBOT 2',
                'field' => 'surBobot2',
                'type' => 'text',
                'placeholder' => 'Bobot 2',
                'keterangan' => '* Wajib Diisi',
                'col'=>4
            ),
            array(
                'label' => 'JAWABAN 3',
                'field' => 'surOpt3',
                'type' => 'text',
                'placeholder' => 'Opsi 3',
                'keterangan' => '* Wajib Diisi',
                'col'=>8
            ),
            array(
                'label' => 'BOBOT 3',
                'field' => 'surBobot3',
                'type' => 'text',
                'placeholder' => 'Bobot 3',
                'keterangan' => '* Wajib Diisi',
                'col'=>4
            ),
            array(
                'label' => 'JAWABAN 4',
                'field' => 'surOpt4',
                'type' => 'text',
                'placeholder' => 'Opsi 4',
                'keterangan' => '* Wajib Diisi',
                'col'=>8
            ),
            array(
                'label' => 'BOBOT 4',
                'field' => 'surBobot4',
                'type' => 'text',
                'placeholder' => 'Bobot 4',
                'keterangan' => '* Wajib Diisi',
                'col'=>4
            ),
            array(
                'label' => 'JAWABAN 5',
                'field' => 'surOpt5',
                'type' => 'text',
                'placeholder' => 'Opsi 5',
                'keterangan' => '* Wajib Diisi',
                'col'=>8
            ),
            array(
                'label' => 'BOBOT 5',
                'field' => 'surBobot5',
                'type' => 'text',
                'placeholder' => 'Bobot 5',
                'keterangan' => '* Wajib Diisi',
                'col'=>4
            ),
            array(
                'label' => 'STATUS TAYANG',
                'field' => 'surTayang',
                'type' => 'combo',
                'combodata' =>$this->yatidak,
                'keterangan' => '* Wajib Diisi',
                'default'=>'Pilih Status Tayang',
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
                        ->where('surPertanyaan', 'like', '%' . $search . '%')
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
                        ->where('surPertanyaan', 'like', '%' . $search . '%')
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
                'page_tittle' => 'Master Pertanyaan',
                'page_active' => 'Master Pertanyaan',
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
    }}
