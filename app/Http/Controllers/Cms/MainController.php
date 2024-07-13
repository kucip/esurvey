<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Cms\Controllermaster;
use Illuminate\Http\Request;
use Session;

use App\Models\Data\Datasurvey;
use App\Models\Master\Umur;
use App\Models\Master\Sekolah;
use App\Models\Master\Mspertanyaan;
use App\Models\Master\Kerja;
use App\Models\Master\Layanan;
use App\Models\Master\Unit;
use Input;
use DB;

class MainController extends Controllermaster
{
    public function __construct(){
        $this->model = new Datasurvey;
        $this->layanan = new Layanan;
        $this->unit = new Unit;
        $this->mainroute = 'dashboard';
    }

    public function index(){
        if(trim(Session::get('email'))==''){

            $wallidx=2;
            $data = array(
                'wallidx' => $wallidx,
                'message' => '',
            ); 
            return view('cms.login',$data);        
        }else{

                // $bulan=!empty($_GET['bulan'])?$_GET['bulan']:'0';
                // $tahun=!empty($_GET['tahun'])?$_GET['tahun']:'0';

                // $layanan=!empty($_GET['layanan'])?$_GET['layanan']:'%';
                // $unit=!empty($_GET['unit'])?$_GET['unit']:'%';

                // $selected=array(
                //              'bulan'=>$bulan,   
                //              'tahun'=>$tahun,   
                //              'layanan'=>$layanan,   
                //              'unit'=>$unit,   
                //           );
                
                // $data = array(
                //         'authmenu'=>$this->getusermenu(),
                //         'company' => Session::get('compNama'),
                //         'logo' => Session::get('compLogo'),
                //         'detail' => Session::get('compDetail'),
                //         'lokasi' => Session::get('compLokasi'),
                //         'name' => Session::get('name'),
                //         'namelong' => Session::get('email'),
                //         'tittle'=>'Home',
                //         'page_tittle'=> 'Home',
                //         'page_active'=>'Home',
                //         'layanan'=>'',
                //         'unit' => $this->unit::all(),
                //         'selected' => $selected,
                //         );

                // return view('cms.home',$data)->with('data', $data);

                $this->dashboard();
        }
    }

    public function dashboard(){
        if(trim(Session::get('email'))==''){

            $wallidx=2;
            $data = array(
                'wallidx' => $wallidx,
                'message' => '',
            ); 
            return view('cms.login',$data);        
        }else{
                


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
            $listdata = $this->layanan->get();

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

                $data=$this->hitungLayanan($val->layId,$bulan,$tahun,$unit);
                $jumlahData=$data->jumlahData;
                if($jumlahData==0){ 
                    $jumlahData=1;
                }else{
                    $idx++;
                }

                $Jawab1 = $data->jawab1/$jumlahData;
                $Jawab2 = $data->jawab2/$jumlahData;
                $Jawab3 = $data->jawab3/$jumlahData;
                $Jawab4 = $data->jawab4/$jumlahData;
                $Jawab5 = $data->jawab5/$jumlahData;
                $Jawab6 = $data->jawab6/$jumlahData;
                $Jawab7 = $data->jawab7/$jumlahData;
                $Jawab8 = $data->jawab8/$jumlahData;
                $Jawab9 = $data->jawab9/$jumlahData;
                $Jumlah = ($Jawab1+$Jawab2+$Jawab3+$Jawab4+$Jawab5+$Jawab6+$Jawab7+$Jawab8+$Jawab9)/9;


                $result[] = array(
                            'dataId'=>$val->layId,                    
                            'compId'=>1,                    
                            'layanan'=>$val->layNama,                    
                            'kategori'=>$this->getkategori($Jumlah),                    
                            'dataJawab1'=>number_format($Jawab1,2),                    
                            'dataJawab2'=>number_format($Jawab2,2),                    
                            'dataJawab3'=>number_format($Jawab3,2),                    
                            'dataJawab4'=>number_format($Jawab4,2),                    
                            'dataJawab5'=>number_format($Jawab5,2),                    
                            'dataJawab6'=>number_format($Jawab6,2),                    
                            'dataJawab7'=>number_format($Jawab7,2),                    
                            'dataJawab8'=>number_format($Jawab8,2),                    
                            'dataJawab9'=>number_format($Jawab9,2),                    
                            'ikm'=>floor($Jumlah*20),                    
                          );

                $tJawab1 += $Jawab1;
                $tJawab2 += $Jawab2;
                $tJawab3 += $Jawab3;
                $tJawab4 += $Jawab4;
                $tJawab5 += $Jawab5;
                $tJawab6 += $Jawab6;
                $tJawab7 += $Jawab7;
                $tJawab8 += $Jawab8;
                $tJawab9 += $Jawab9;
                $tJumlah += $Jumlah;


            }

            if($idx==0) $idx=1;

            $result[] = array(
                        'dataId'=>-1,                    
                        'compId'=>1,                    
                        'layanan'=>'&nbsp;',                    
                        'ikm'=>'&nbsp;',                    
                        'kategori'=>'&nbsp;',                    
                        'dataJawab1'=>'&nbsp;',                    
                        'dataJawab2'=>'&nbsp;',                    
                        'dataJawab3'=>'&nbsp;',                    
                        'dataJawab4'=>'&nbsp;',                    
                        'dataJawab5'=>'&nbsp;',                    
                        'dataJawab6'=>'&nbsp;',                    
                        'dataJawab7'=>'&nbsp;',                    
                        'dataJawab8'=>'&nbsp;',                    
                        'dataJawab9'=>'&nbsp;',                                            
                      );

            $unsur = $this->getUnsurNama();
            $datagraph = array(
                        'dataJawab1'=>$tJawab1/$idx,                    
                        'dataJawab2'=>$tJawab2/$idx,                    
                        'dataJawab3'=>$tJawab3/$idx,                    
                        'dataJawab4'=>$tJawab4/$idx,                    
                        'dataJawab5'=>$tJawab5/$idx,                    
                        'dataJawab6'=>$tJawab6/$idx,                    
                        'dataJawab7'=>$tJawab7/$idx,                    
                        'dataJawab8'=>$tJawab8/$idx,                    
                        'dataJawab9'=>$tJawab9/$idx,                    
                        'dataUnsur1'=>$unsur[0]->surUnsur,
                        'dataUnsur2'=>$unsur[1]->surUnsur,
                        'dataUnsur3'=>$unsur[2]->surUnsur,
                        'dataUnsur4'=>$unsur[3]->surUnsur,
                        'dataUnsur5'=>$unsur[4]->surUnsur,
                        'dataUnsur6'=>$unsur[5]->surUnsur,
                        'dataUnsur7'=>$unsur[6]->surUnsur,
                        'dataUnsur8'=>$unsur[7]->surUnsur,
                        'dataUnsur9'=>$unsur[8]->surUnsur,
                      );

            $result[] = array(
                        'dataId'=>-1,                    
                        'compId'=>1,                    
                        'layanan'=>'TOTAL',                    
                        'kategori'=>$this->getkategori($tJumlah/$idx),                    
                        'dataJawab1'=>($tJawab1/$idx),                    
                        'dataJawab2'=>($tJawab2/$idx),                    
                        'dataJawab3'=>($tJawab3/$idx),                    
                        'dataJawab4'=>($tJawab4/$idx),                    
                        'dataJawab5'=>($tJawab5/$idx),                    
                        'dataJawab6'=>($tJawab6/$idx),                    
                        'dataJawab7'=>($tJawab7/$idx),                    
                        'dataJawab8'=>($tJawab8/$idx),                    
                        'dataJawab9'=>($tJawab9/$idx),                    
                        'ikm'=>floor(($tJumlah/$idx)*20),                    
                      );

            $data = array(
                        'authmenu'=>$this->getusermenu(),
                        'company' => Session::get('compNama'),
                        'logo' => Session::get('compLogo'),
                        'detail' => Session::get('compDetail'),
                        'lokasi' => Session::get('compLokasi'),
                        'name' => Session::get('name'),
                        'namelong' => Session::get('email'),
                        'tittle'=>'Home',
                        'page_tittle'=> 'Home',
                        'page_active'=>'Home',
                        'layanan'=>json_encode($result),
                        'unit' => $this->unit::all(),
                        'selected' => $selected,
                        'databar' => json_encode($datagraph),
                        'mainroute'=>$this->mainroute,
                    );

            return view('cms.home',$data)->with('data', $data);
        }
    }


    public function hitungLayanan($idx,$bulan,$tahun,$unit){


        if($bulan==0 and $tahun==0){
            $res = $this->model->select(DB::raw('count(*) as jumlahData'),
                                        DB::raw('sum(dataJawab1) as jawab1'),
                                        DB::raw('sum(dataJawab2) as jawab2'),
                                        DB::raw('sum(dataJawab3) as jawab3'),
                                        DB::raw('sum(dataJawab4) as jawab4'),
                                        DB::raw('sum(dataJawab5) as jawab5'),
                                        DB::raw('sum(dataJawab6) as jawab6'),
                                        DB::raw('sum(dataJawab7) as jawab7'),
                                        DB::raw('sum(dataJawab8) as jawab8'),
                                        DB::raw('sum(dataJawab9) as jawab9'),
                                    )
                   ->where('dataLayanan','=',$idx)
                    ->where('dataUnit','like',$unit)
                   ->get();
        }else{

            $res = $this->model->select(DB::raw('count(*) as jumlahData'),
                                        DB::raw('sum(dataJawab1) as jawab1'),
                                        DB::raw('sum(dataJawab2) as jawab2'),
                                        DB::raw('sum(dataJawab3) as jawab3'),
                                        DB::raw('sum(dataJawab4) as jawab4'),
                                        DB::raw('sum(dataJawab5) as jawab5'),
                                        DB::raw('sum(dataJawab6) as jawab6'),
                                        DB::raw('sum(dataJawab7) as jawab7'),
                                        DB::raw('sum(dataJawab8) as jawab8'),
                                        DB::raw('sum(dataJawab9) as jawab9'),
                                    )
                   ->where('dataLayanan','=',$idx)
                    ->where(DB::raw('MONTH(created_at)'),'=',$bulan)
                    ->where(DB::raw('YEAR(created_at)'),'=',$tahun)
                    ->where('dataUnit','like',$unit)
                   ->get();

        }

        return $res[0];
    }

    public function getkategori($nilai){
        $res='';
        if($nilai>0 and $nilai<=1.25){
            $res='D';
        }elseif($nilai>1.25 and $nilai<=2.50){
            $res='C';
        }elseif($nilai>2.50 and $nilai<=3.75){
            $res='B';
        }elseif($nilai>3.75 and $nilai<=5){
            $res='A';
        }
        return $res;
    }



    public function getUnsurNama(){
        $tanya=new Mspertanyaan;
        $datatanya=$tanya->orderby('surId','ASC')->get();
        return $datatanya;
    }

    public function getkategoriText($huruf){        
        $text='';
        if($huruf=='D'){
            $text='Tidak Baik';
        }elseif($huruf=='C'){
            $text='Kurang Baik';
        }elseif($huruf=='B'){
            $text='Baik';
        }elseif($huruf=='A'){
            $text='Sangat Baik';
        }
        return $text;
    }


}
