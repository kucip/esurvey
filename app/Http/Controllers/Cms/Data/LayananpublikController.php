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
use Session;
use Input;
use DB;

class LayananpublikController extends Controllermaster
{
    public function __construct(){
        $this->model = new Datasurvey;
        $this->layanan = new Layanan;
        $this->primaryKey = 'dataId';
        $this->mainroute = 'layananpublik';
        $this->mandatory = array(
            'compId' => 'required'
        );

        $this->grid = array(
            array(
                'label' => 'JENIS LAYANAN',
                'field' => 'layanan',
                'type' => 'text',
                'width' => '',
                'rowspan' => 2
            ),
            array(
                'label' => 'NILAI PER UNSUR',
                'field' => '',
                'type' => 'text',
                'width' => '20%',
                'class' => 'center',
                'colspan'=>9,
            ),
            array(
                'label' => 'IKM',
                'field' => 'ikm',
                'type' => 'text',
                'width' => '8%',
                'class' => 'center',
                'rowspan' => 2
            ),
            array(
                'label' => 'KATEGORI',
                'field' => 'kategori',
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
            $jumdata=$this->model->count();
            foreach ($listdata as $key => $val) {

                $data=$this->hitungLayanan($val->layId);
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
                            'ikm'=>number_format($Jumlah*20,2),                    
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

            $result[] = array(
                        'dataId'=>-1,                    
                        'compId'=>1,                    
                        'layanan'=>'TOTAL',                    
                        'kategori'=>$this->getkategori($tJumlah/$idx),                    
                        'dataJawab1'=>number_format($tJawab1/$idx,2),                    
                        'dataJawab2'=>number_format($tJawab2/$idx,2),                    
                        'dataJawab3'=>number_format($tJawab3/$idx,2),                    
                        'dataJawab4'=>number_format($tJawab4/$idx,2),                    
                        'dataJawab5'=>number_format($tJawab5/$idx,2),                    
                        'dataJawab6'=>number_format($tJawab6/$idx,2),                    
                        'dataJawab7'=>number_format($tJawab7/$idx,2),                    
                        'dataJawab8'=>number_format($tJawab8/$idx,2),                    
                        'dataJawab9'=>number_format($tJawab9/$idx,2),                    
                        'ikm'=>number_format(($tJumlah/$idx)*20,2),                    
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
                'page_tittle' => 'Layanan Publik Dari '.number_format($this->model->count()).' Responden',
                'page_active' => 'Layanan Publik',
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

    public function hitungLayanan($idx){
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
               ->get();
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
}
