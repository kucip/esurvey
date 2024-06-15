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
use DB;
class GrafikallController extends Controllermaster
{

    public function __construct(){
        $this->model = new Datasurvey;
        $this->primaryKey = 'dataId';
        $this->mainroute = 'rawdata';
        $this->mandatory = array(
            'compId' => 'required'
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
            $listdata = Mspertanyaan::select('*')->get();

            $idx=0;
            foreach($listdata as $key=>$val){
                $dataJawab=$this->getStat(($idx+1),$val->surId);    
                $listdata[$idx]['dataStat']=$dataJawab;            
                $idx++;
            }


            $data = array(
                'authmenu' => $this->getusermenu(),
                'company' => Session::get('compNama'),
                'logo' => Session::get('compLogo'),
                'detail' => Session::get('compDetail'),
                'name' => Session::get('name'),
                'namelong' => Session::get('email'),
                'page_tittle' => strtoupper('Grafik Seluruh Pertanyaan').' :: Jumlah Responden = '.number_format($this->model->count(),0),
                'page_active' => 'Grafik Seluruh Pertanyaan',
                'listdata' => json_encode($listdata),
                'primaryKey' => $this->primaryKey,
                'mainroute' => $this->mainroute,
                'compId' => $compId,
                'code' => 0,
            );

            return view('cms.Survey.grafikall', $data)->with('data', $data);
        }
    }


    public function getStat($field,$idx){
        $res = $this->model
               ->select(DB::raw("COUNT(dataJawab".$field.") as hasil"))
               ->where('dataTanya'.$field,'=',$idx)
               ->where('dataJawab'.$field,'=',1)
               ->get();
        $data1=!empty($res[0]->hasil)?$res[0]->hasil:0;

        $res = $this->model
               ->select(DB::raw("COUNT(dataJawab".$field.") as hasil"))
               ->where('dataTanya'.$field,'=',$idx)
               ->where('dataJawab'.$field,'=',2)
               ->get();
        $data2=!empty($res[0]->hasil)?$res[0]->hasil:0;

        $res = $this->model
               ->select(DB::raw("COUNT(dataJawab".$field.") as hasil"))
               ->where('dataTanya'.$field,'=',$idx)
               ->where('dataJawab'.$field,'=',3)
               ->get();
        $data3=!empty($res[0]->hasil)?$res[0]->hasil:0;

        $res = $this->model
               ->select(DB::raw("COUNT(dataJawab".$field.") as hasil"))
               ->where('dataTanya'.$field,'=',$idx)
               ->where('dataJawab'.$field,'=',4)
               ->get();
        $data4=!empty($res[0]->hasil)?$res[0]->hasil:0;

        $res = $this->model
               ->select(DB::raw("COUNT(dataJawab".$field.") as hasil"))
               ->where('dataTanya'.$field,'=',$idx)
               ->where('dataJawab'.$field,'=',5)
               ->get();
        $data5=!empty($res[0]->hasil)?$res[0]->hasil:0;

        $result = array(
                        'jawab1'=>$data1,
                        'jawab2'=>$data2,
                        'jawab3'=>$data3,
                        'jawab4'=>$data4,
                        'jawab5'=>$data5,
                  );
        return $result;
    }

    public function getUmur($idx){
        $res = Umur::select('umurNama')->where('umurId','=',$idx)->get();
        return $res[0]->umurNama;
    }

    public function getPendidikan($idx){
        $res = Sekolah::select('sekLevel')->where('sekId','=',$idx)->get();
        return $res[0]->sekLevel;
    }

}
