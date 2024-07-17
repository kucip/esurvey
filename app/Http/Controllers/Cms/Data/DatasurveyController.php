<?php

namespace App\Http\Controllers\Cms\Data;

use App\Http\Controllers\Cms\Controllermaster;
use Illuminate\Http\Request;
use App\Models\Data\Datasurvey;
use App\Models\Master\Umur;
use App\Models\Master\Sekolah;
use App\Models\Master\Mspertanyaan;
use App\Models\Master\Kerja;
use App\Models\Master\Layanan;
use App\Models\Master\Unit;
use Session;
use Input;

class DatasurveyController extends Controllermaster{

    public function __construct(){
        $this->model = new Datasurvey;
        $this->primaryKey = 'dataId';
        $this->mainroute = 'rawdata';
        $this->mandatory = array(
            'compId' => 'required'
        );

        $this->grid = array(
            array(
                'label' => 'NAMA',
                'field' => 'dataNama',
                'type' => 'text',
                'width' => ''
            ),
            array(
                'label' => 'GENDER',
                'field' => 'dataKelamin',
                'type' => 'text',
                'width' => '8%',
                'class' => 'center'
            ),
            array(
                'label' => 'UMUR',
                'field' => 'dataUmur',
                'type' => 'text',
                'width' => '10%',
                'class' => 'center'
            ),
            array(
                'label' => 'PENDIDIKAN',
                'field' => 'dataPendidikan',
                'type' => 'text',
                'width' => '10%',
                'class' => 'center'
            ),
            array(
                'label' => 'PEKERJAAN',
                'field' => 'dataPekerjaan',
                'type' => 'text',
                'width' => '8%',
                'class' => 'center'
            ),
            array(
                'label' => 'LAYANAN',
                'field' => 'dataLayanan',
                'type' => 'text',
                'width' => '10%',
                'class' => 'center'
            ),
            array(
                'label' => 'UNIT',
                'field' => 'dataUnit',
                'type' => 'text',
                'width' => '8%',
                'class' => 'center'
            ),
            array(
                'label' => 'PHONE',
                'field' => 'dataHp',
                'type' => 'text',
                'width' => '10%',
                'class' => 'center'
            ),
            array(
                'label' => 'LOG',
                'field' => 'created_at',
                'type' => 'text',
                'width' => '8%',
                'class' => 'center'
            ),
        );
    }    

    public function index(){

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
                        ->where('dataNama', 'like', '%' . $search . '%')
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
                        ->latest()
                        ->where('dataNama', 'like', '%' . $search . '%')
                        ->where('compId', '=', $compId)
                        ->paginate(15);
                }
            }
            $idx=0;
            foreach ($listdata as $key => $val) {
                if($val->dataKelamin==1){
                    $listdata[$idx]['dataKelamin']='Laki-Laki';
                }elseif($val->dataKelamin==2){
                    $listdata[$idx]['dataKelamin']='Perempuan';
                }else{
                    $listdata[$idx]['dataKelamin']='';                    
                }

                $listdata[$idx]['dataUnit']=$this->getUnit($val->dataUnit);                    
                $listdata[$idx]['dataLayanan']=$this->getLayanan($val->dataLayanan);                    
                $listdata[$idx]['dataPekerjaan']=$this->getPekerjaan($val->dataPekerjaan);                    
                $listdata[$idx]['dataUmur']=$this->getUmur($val->dataUmur);                    
                $listdata[$idx]['dataPendidikan']=$this->getPendidikan($val->dataPendidikan);                    
                $listdata[$idx]['dataDetail' ]=json_encode($this->generateSurvey($listdata[$idx]));
                $idx++;
            }


            $data = array(
                'authmenu' => $this->getusermenu(),
                'company' => Session::get('compNama'),
                'logo' => Session::get('compLogo'),
                'detail' => Session::get('compDetail'),
                'name' => Session::get('name'),
                'namelong' => Session::get('email'),
                'page_tittle' => 'Data Survey',
                'page_active' => 'Data Survey',
                'grid' => $this->grid,
                'listdata' => $listdata,
                'primaryKey' => $this->primaryKey,
                'mainroute' => $this->mainroute,
                'compId' => $compId,
                'code' => 0,
            );

            return view('cms.Survey.index', $data)->with('data', $data);
        }
    }


    public function generateSurvey($data){
        $result=array();
        $length = Mspertanyaan::count();
        for($i=1;$i<=$length;$i++){
            $mssurvey=$this->getPertanyaan($data['dataTanya'.$i]);            
            $tanya=$mssurvey['surPertanyaan'];
            $jawabIdx=$data['dataJawab'.$i];
            $jawab=$mssurvey['surOpt'.$jawabIdx];
            $res=array('tanya'=>$tanya,'jawab'=>$jawab,'jawabIndex'=>$jawabIdx);
            array_push($result, $res);
        }

        return $result;
    }

    public function getPekerjaan($idx){
        $res = Kerja::select('*')->where('kerjaId','=',$idx)->get();
        return !empty($res[0]->kerjaNama)?$res[0]->kerjaNama:'';
    }

    public function getPertanyaan($idx){
        $res = Mspertanyaan::select('*')->where('surId','=',$idx)->get();
        return !empty($res[0])?$res[0]:array();
    }

    public function getUmur($idx){
        $res = Umur::select('umurNama')->where('umurId','=',$idx)->get();
        return !empty($res[0]->umurNama)?$res[0]->umurNama:'';
    }

    public function getPendidikan($idx){
        $res = Sekolah::select('sekLevel')->where('sekId','=',$idx)->get();
        return !empty($res[0]->sekLevel)?$res[0]->sekLevel:'';
    }

    public function getLayanan($idx){
        $res = Layanan::select('layNama')->where('layId','=',$idx)->get();
        return !empty($res[0]->layNama)?$res[0]->layNama:'';
    }

    public function getUnit($idx){
        $res = Unit::select('unitNama')->where('unitId','=',$idx)->get();
        return !empty($res[0]->unitNama)?$res[0]->unitNama:'';
    }

}















