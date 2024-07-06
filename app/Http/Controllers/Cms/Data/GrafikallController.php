<?php

namespace App\Http\Controllers\Cms\Data;

use App\Http\Controllers\Cms\Controllermaster;
use Illuminate\Http\Request;
use App\Models\Data\Datasurvey;
use App\Models\Master\Umur;
use App\Models\Master\Sekolah;
use App\Models\Master\Mspertanyaan;
use App\Models\Master\Layanan;
use App\Models\Master\Unit;
use Session;
use Input;
use DB;
class GrafikallController extends Controllermaster
{

    public function __construct(){
        $this->model = new Datasurvey;
        $this->layanan = new Layanan;
        $this->unit = new Unit;
        $this->primaryKey = 'dataId';
        $this->mainroute = 'graph';
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

            $bulan=!empty($_GET['bulan'])?$_GET['bulan']:'0';
            $tahun=!empty($_GET['tahun'])?$_GET['tahun']:'0';

            $layanan=!empty($_GET['layanan'])?$_GET['layanan']:'%';
            $unit=!empty($_GET['unit'])?$_GET['unit']:'%';

            $selected=array(
                         'bulan'=>$bulan,   
                         'tahun'=>$tahun,   
                         'layanan'=>$layanan,   
                         'unit'=>$unit,   
                      );

            if($bulan==0 and $tahun==0){
                $jumdata=$this->model
                        ->where('dataLayanan','like',$layanan)
                        ->where('dataUnit','like',$unit)
                        ->count();
            }else{
                $jumdata=$this->model
                        ->where(DB::raw('MONTH(created_at)'),'=',$bulan)
                        ->where(DB::raw('YEAR(created_at)'),'=',$tahun)
                        ->where('dataLayanan','like',$layanan)
                        ->where('dataUnit','like',$unit)
                        ->count();
            }

            $compId = Session::get('compId');
            $compStatus = Session::get('compStatus');
            $listdata = Mspertanyaan::select('*')->get();

            $idx=0;
            foreach($listdata as $key=>$val){
                $dataJawab=$this->getStat(($idx+1),$val->surId,$bulan,$tahun,$layanan,$unit);    
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
                'page_tittle' => strtoupper('Grafik Seluruh Pertanyaan').' :: Jumlah Responden = '.number_format($jumdata,0),
                'page_active' => 'Grafik Seluruh Pertanyaan',
                'listdata' => json_encode($listdata),
                'primaryKey' => $this->primaryKey,
                'mainroute' => $this->mainroute,
                'layanan' => $this->layanan::all(),
                'unit' => $this->unit::all(),
                'selected' => $selected,
                'compId' => $compId,
                'code' => 0,
            );

            return view('cms.Survey.grafikall', $data)->with('data', $data);
        }
    }


    public function getStat($field,$idx,$bulan,$tahun,$layanan,$unit){

        if($bulan==0 and $tahun==0){

            $res = $this->model
                   ->select(DB::raw("COUNT(dataJawab".$field.") as hasil"))
                   ->where('dataTanya'.$field,'=',$idx)
                   ->where('dataJawab'.$field,'=',1)
                   ->where('dataLayanan','like',$layanan)
                   ->where('dataUnit','like',$unit)
                   ->get();
            $data1=!empty($res[0]->hasil)?$res[0]->hasil:0;

            $res = $this->model
                   ->select(DB::raw("COUNT(dataJawab".$field.") as hasil"))
                   ->where('dataTanya'.$field,'=',$idx)
                   ->where('dataJawab'.$field,'=',2)
                   ->where('dataLayanan','like',$layanan)
                   ->where('dataUnit','like',$unit)
                   ->get();
            $data2=!empty($res[0]->hasil)?$res[0]->hasil:0;

            $res = $this->model
                   ->select(DB::raw("COUNT(dataJawab".$field.") as hasil"))
                   ->where('dataTanya'.$field,'=',$idx)
                   ->where('dataJawab'.$field,'=',3)
                   ->where('dataLayanan','like',$layanan)
                   ->where('dataUnit','like',$unit)
                   ->get();
            $data3=!empty($res[0]->hasil)?$res[0]->hasil:0;

            $res = $this->model
                   ->select(DB::raw("COUNT(dataJawab".$field.") as hasil"))
                   ->where('dataTanya'.$field,'=',$idx)
                   ->where('dataJawab'.$field,'=',4)
                   ->where('dataLayanan','like',$layanan)
                   ->where('dataUnit','like',$unit)
                   ->get();
            $data4=!empty($res[0]->hasil)?$res[0]->hasil:0;

            $res = $this->model
                   ->select(DB::raw("COUNT(dataJawab".$field.") as hasil"))
                   ->where('dataTanya'.$field,'=',$idx)
                   ->where('dataJawab'.$field,'=',5)
                   ->where('dataLayanan','like',$layanan)
                   ->where('dataUnit','like',$unit)
                   ->get();
            $data5=!empty($res[0]->hasil)?$res[0]->hasil:0;
        
        }else{

            $res = $this->model
                   ->select(DB::raw("COUNT(dataJawab".$field.") as hasil"))
                   ->where('dataTanya'.$field,'=',$idx)
                   ->where('dataJawab'.$field,'=',1)
                    ->where(DB::raw('MONTH(created_at)'),'=',$bulan)
                    ->where(DB::raw('YEAR(created_at)'),'=',$tahun)
                    ->where('dataLayanan','like',$layanan)
                    ->where('dataUnit','like',$unit)
                   ->get();
            $data1=!empty($res[0]->hasil)?$res[0]->hasil:0;

            $res = $this->model
                   ->select(DB::raw("COUNT(dataJawab".$field.") as hasil"))
                   ->where('dataTanya'.$field,'=',$idx)
                   ->where('dataJawab'.$field,'=',2)
                    ->where(DB::raw('MONTH(created_at)'),'=',$bulan)
                    ->where(DB::raw('YEAR(created_at)'),'=',$tahun)
                    ->where('dataLayanan','like',$layanan)
                    ->where('dataUnit','like',$unit)
                   ->get();
            $data2=!empty($res[0]->hasil)?$res[0]->hasil:0;

            $res = $this->model
                   ->select(DB::raw("COUNT(dataJawab".$field.") as hasil"))
                   ->where('dataTanya'.$field,'=',$idx)
                   ->where('dataJawab'.$field,'=',3)
                    ->where(DB::raw('MONTH(created_at)'),'=',$bulan)
                    ->where(DB::raw('YEAR(created_at)'),'=',$tahun)
                    ->where('dataLayanan','like',$layanan)
                    ->where('dataUnit','like',$unit)
                   ->get();
            $data3=!empty($res[0]->hasil)?$res[0]->hasil:0;

            $res = $this->model
                   ->select(DB::raw("COUNT(dataJawab".$field.") as hasil"))
                   ->where('dataTanya'.$field,'=',$idx)
                   ->where('dataJawab'.$field,'=',4)
                    ->where(DB::raw('MONTH(created_at)'),'=',$bulan)
                    ->where(DB::raw('YEAR(created_at)'),'=',$tahun)
                    ->where('dataLayanan','like',$layanan)
                    ->where('dataUnit','like',$unit)
                   ->get();
            $data4=!empty($res[0]->hasil)?$res[0]->hasil:0;

            $res = $this->model
                   ->select(DB::raw("COUNT(dataJawab".$field.") as hasil"))
                   ->where('dataTanya'.$field,'=',$idx)
                   ->where('dataJawab'.$field,'=',5)
                    ->where(DB::raw('MONTH(created_at)'),'=',$bulan)
                    ->where(DB::raw('YEAR(created_at)'),'=',$tahun)
                    ->where('dataLayanan','like',$layanan)
                    ->where('dataUnit','like',$unit)
                   ->get();
            $data5=!empty($res[0]->hasil)?$res[0]->hasil:0;

        }


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
