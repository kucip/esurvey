<?php

namespace App\Http\Controllers\Cms\Data;

use App\Http\Controllers\Cms\Controllermaster;
use Illuminate\Http\Request;
use App\Models\Data\Datasurvey;
use App\Models\Master\Umur;
use App\Models\Master\Sekolah;
use App\Models\Master\Mspertanyaan;
use Session;
use Input;

class HasilsurveyController extends Controllermaster
{

    public function __construct(){
        $this->model = new Datasurvey;
        $this->primaryKey = 'dataId';
        $this->mainroute = 'hasilsurvey';
        $this->mandatory = array(
            'compId' => 'required'
        );

        $this->grid = array(
            array(
                'label' => 'NAMA',
                'field' => 'dataNama',
                'type' => 'text',
                'width' => '',
                'rowspan' => 2
            ),
            array(
                'label' => 'GENDER',
                'field' => 'dataKelamin',
                'type' => 'text',
                'width' => '8%',
                'class' => 'center',
                'rowspan' => 2

            ),
            array(
                'label' => 'UMUR',
                'field' => 'dataUmur',
                'type' => 'text',
                'width' => '10%',
                'class' => 'center',
                'rowspan' => 2

            ),
            array(
                'label' => 'PENDIDIKAN',
                'field' => 'dataPendidikan',
                'type' => 'text',
                'width' => '8%',
                'class' => 'center',
                'rowspan' => 2

            ),
            array(
                'label' => 'NILAI AKTUAL UNSUR KEPUASAN MASYARAKAT',
                'field' => '',
                'type' => 'text',
                'width' => '20%',
                'class' => 'center',
                'colspan'=>9,
            ),
            array(
                'label' => 'JUMLAH',
                'field' => 'uJumlah',
                'type' => 'text',
                'width' => '8%',
                'class' => 'center',
                'rowspan' => 2
            ),
        );

        $this->grid2 = array(
            array(
                'label' => 'U1',
                'field' => 'dataJawab1',
                'type' => 'text',
                'width' => '2%',
                'class' => 'center'
            ),
            array(
                'label' => 'U2',
                'field' => 'dataJawab2',
                'type' => 'text',
                'width' => '2%',
                'class' => 'center'
            ),
            array(
                'label' => 'U3',
                'field' => 'dataJawab3',
                'type' => 'text',
                'width' => '2%',
                'class' => 'center'
            ),
            array(
                'label' => 'U4',
                'field' => 'dataJawab4',
                'type' => 'text',
                'width' => '2%',
                'class' => 'center'
            ),
            array(
                'label' => 'U5',
                'field' => 'dataJawab5',
                'type' => 'text',
                'width' => '2%',
                'class' => 'center'
            ),
            array(
                'label' => 'U6',
                'field' => 'dataJawab6',
                'type' => 'text',
                'width' => '2%',
                'class' => 'center'
            ),
            array(
                'label' => 'U7',
                'field' => 'dataJawab7',
                'type' => 'text',
                'width' => '2%',
                'class' => 'center'
            ),
            array(
                'label' => 'U8',
                'field' => 'dataJawab8',
                'type' => 'text',
                'width' => '2%',
                'class' => 'center'
            ),
            array(
                'label' => 'U9',
                'field' => 'dataJawab9',
                'type' => 'text',
                'width' => '2%',
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
            $listdata = $this->model->get();

            $idx=0;
            $tJawab1=0;
            $tJawab2=0;
            $tJawab3=0;
            $tJawab4=0;
            $tJawab5=0;
            $tJawab6=0;
            $tJawab7=0;
            $tJawab8=0;
            $tJawab9=0;
            $tJumlah=0;

            $lastData=null;
            $result=array();
            foreach ($listdata as $key => $val) {
                if($val->dataKelamin==1){
                    $listdata[$idx]['dataKelamin']='Laki-Laki';
                }elseif($val->dataKelamin==2){
                    $listdata[$idx]['dataKelamin']='Perempuan';
                }else{
                    $listdata[$idx]['dataKelamin']='';                    
                }

                $listdata[$idx]['dataUmur']=$this->getUmur($val->dataUmur);                    
                $listdata[$idx]['dataPendidikan']=$this->getPendidikan($val->dataPendidikan);                    
                $listdata[$idx]['uJumlah' ]=$listdata[$idx]['dataJawab1']+$listdata[$idx]['dataJawab2']+$listdata[$idx]['dataJawab3']+$listdata[$idx]['dataJawab4']+$listdata[$idx]['dataJawab5']+$listdata[$idx]['dataJawab6']+$listdata[$idx]['dataJawab7']+$listdata[$idx]['dataJawab8']+$listdata[$idx]['dataJawab9'];

                $result[] = array(
                            'dataId'=>$val->dataId,                    
                            'compId'=>1,                    
                            'dataNama'=>$val->dataNama,                    
                            'dataKelamin'=>$listdata[$idx]['dataKelamin'],                    
                            'dataUmur'=>$listdata[$idx]['dataUmur'],                    
                            'dataPendidikan'=>$listdata[$idx]['dataPendidikan'],                    
                            'dataJawab1'=>$val->dataJawab1,                    
                            'dataJawab2'=>$val->dataJawab2,                    
                            'dataJawab3'=>$val->dataJawab3,                    
                            'dataJawab4'=>$val->dataJawab4,                    
                            'dataJawab5'=>$val->dataJawab5,                    
                            'dataJawab6'=>$val->dataJawab6,                    
                            'dataJawab7'=>$val->dataJawab7,                    
                            'dataJawab8'=>$val->dataJawab8,                    
                            'dataJawab9'=>$val->dataJawab9,                    
                            'uJumlah'=>$listdata[$idx]['uJumlah'],                    
                          );


                $tJawab1 += $listdata[$idx]['dataJawab1'];
                $tJawab2 += $listdata[$idx]['dataJawab2'];
                $tJawab3 += $listdata[$idx]['dataJawab3'];
                $tJawab4 += $listdata[$idx]['dataJawab4'];
                $tJawab5 += $listdata[$idx]['dataJawab5'];
                $tJawab6 += $listdata[$idx]['dataJawab6'];
                $tJawab7 += $listdata[$idx]['dataJawab7'];
                $tJawab8 += $listdata[$idx]['dataJawab8'];
                $tJawab9 += $listdata[$idx]['dataJawab9'];
                $tJumlah += $listdata[$idx]['uJumlah'];

                $lastData = $val;
                $idx++;
            }

            $result[] = array(
                        'dataId'=>0,                    
                        'compId'=>1,                    
                        'dataNama'=>'&nbsp;',                    
                        'dataKelamin'=>'&nbsp;',                    
                        'dataUmur'=>'&nbsp;',                    
                        'dataPendidikan'=>'&nbsp;',                    
                        'dataJawab1'=>'&nbsp;',                    
                        'dataJawab2'=>'&nbsp;',                    
                        'dataJawab3'=>'&nbsp;',                    
                        'dataJawab4'=>'&nbsp;',                    
                        'dataJawab5'=>'&nbsp;',                    
                        'dataJawab6'=>'&nbsp;',                    
                        'dataJawab7'=>'&nbsp;',                    
                        'dataJawab8'=>'&nbsp;',                    
                        'dataJawab9'=>'&nbsp;',                    
                        'uJumlah'=>'&nbsp;',                    
                      );

            $result[] = array(
                        'dataId'=>0,                    
                        'compId'=>1,                    
                        'dataNama'=>'TOTAL  ('.$idx.' Responden)',                    
                        'dataKelamin'=>'&nbsp;',                    
                        'dataUmur'=>'&nbsp;',                    
                        'dataPendidikan'=>'&nbsp;',                    
                        'dataJawab1'=>$tJawab1,                    
                        'dataJawab2'=>$tJawab2,                    
                        'dataJawab3'=>$tJawab3,                    
                        'dataJawab4'=>$tJawab4,                    
                        'dataJawab5'=>$tJawab5,                    
                        'dataJawab6'=>$tJawab6,                    
                        'dataJawab7'=>$tJawab7,                    
                        'dataJawab8'=>$tJawab8,                    
                        'dataJawab9'=>$tJawab9,                    
                        'uJumlah'=>$tJumlah,                    
                      );

            $result[] = array(
                        'dataId'=>0,                    
                        'compId'=>1,                    
                        'dataNama'=>'RATA-RATA',                    
                        'dataKelamin'=>'&nbsp;',                    
                        'dataUmur'=>'&nbsp;',                    
                        'dataPendidikan'=>'&nbsp;',                    
                        'dataJawab1'=>number_format($tJawab1/$idx,2),                    
                        'dataJawab2'=>number_format($tJawab2/$idx,2),                    
                        'dataJawab3'=>number_format($tJawab3/$idx,2),                    
                        'dataJawab4'=>number_format($tJawab4/$idx,2),                    
                        'dataJawab5'=>number_format($tJawab5/$idx,2),                    
                        'dataJawab6'=>number_format($tJawab6/$idx,2),                    
                        'dataJawab7'=>number_format($tJawab7/$idx,2),                    
                        'dataJawab8'=>number_format($tJawab8/$idx,2),                    
                        'dataJawab9'=>number_format($tJawab9/$idx,2),                    
                        'uJumlah'=>number_format($tJumlah/$idx,2),                    
                      );

            // echo "<PRE>";
            // var_dump($result);
            // echo "</PRE>";
            // return;

            $data = array(
                'authmenu' => $this->getusermenu(),
                'company' => Session::get('compNama'),
                'logo' => Session::get('compLogo'),
                'detail' => Session::get('compDetail'),
                'name' => Session::get('name'),
                'namelong' => Session::get('email'),
                'page_tittle' => 'Hasil Survey',
                'page_active' => 'Hasil Survey',
                'grid' => $this->grid,
                'grid2' => $this->grid2,
                'listdata' => $result,
                'primaryKey' => $this->primaryKey,
                'mainroute' => $this->mainroute,
                'compId' => $compId,
                'code' => 0,
            );

            return view('cms.Survey.hasilsurvey', $data)->with('data', $data);
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

}
