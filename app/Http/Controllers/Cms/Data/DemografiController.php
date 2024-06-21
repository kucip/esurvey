<?php

namespace App\Http\Controllers\Cms\Data;

use App\Http\Controllers\Cms\Controllermaster;
use Illuminate\Http\Request;
use App\Models\Data\Datasurvey;
use App\Models\Master\Umur;
use App\Models\Master\Sekolah;
use App\Models\Master\Mspertanyaan;
use App\Models\Master\Kerja;
use Session;
use Input;
use DB;

class DemografiController extends Controllermaster
{

    public function __construct(){
        $this->model = new Datasurvey;
        $this->primaryKey = 'dataId';
        $this->mainroute = 'demografi';
        $this->mandatory = array(
            'compId' => 'required'
        );

        $this->grid = array(
            array(
                'label' => 'KARAKTERISTIK',
                'field' => 'dataKarakter',
                'type' => 'text',
                'width' => '30%',
            ),
            array(
                'label' => 'INDIKATOR',
                'field' => 'dataIndikator',
                'type' => 'text',
                'width' => '30%',
                'class' => 'center',
            ),
            array(
                'label' => 'JUMLAH',
                'field' => 'dataJumlah',
                'type' => 'text',
                'width' => '20%',
                'class' => 'angka',
            ),
            array(
                'label' => 'PERSENTASE',
                'field' => 'dataPersentase',
                'type' => 'text',
                'width' => '20%',
                'class' => 'angka',
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

            $totalResponden=$this->model->count();            
            $jumlah=$this->hitungKelamin(1);
            $result[] = array(
                        'dataId'=>1,                    
                        'compId'=>1,                    
                        'dataKarakter'=>'Jenis Kelamin',                    
                        'dataIndikator'=>'Laki-Laki',                    
                        'dataJumlah'=>number_format($jumlah),                    
                        'dataPersentase'=>number_format($jumlah/$totalResponden*100,2).' %',                    
                      );
            $jumlah=$this->hitungKelamin(2);
            $result[] = array(
                        'dataId'=>1,                    
                        'compId'=>1,                    
                        'dataKarakter'=>'&nbsp;',                    
                        'dataIndikator'=>'Perempuan',                    
                        'dataJumlah'=>number_format($jumlah),                    
                        'dataPersentase'=>number_format($jumlah/$totalResponden*100,2).' %',                    
                      );

            $result[] = array(
                        'dataId'=>1,                    
                        'compId'=>1,                    
                        'dataKarakter'=>'&nbsp;',                    
                        'dataIndikator'=>'&nbsp;',                    
                        'dataJumlah'=>'&nbsp;',                    
                        'dataPersentase'=>'&nbsp;',                    
                      );

            $umur = Umur::get();
            $karakter='Umur';
            $idx=0;
            foreach($umur as $key=>$val){
                if($idx>0) $karakter='&nbsp;';

                $jumlah=$this->hitungUmur($val->umurId);
                if($jumlah==0){
                    $tjumlah='&nbsp;0';
                }else{
                    $tjumlah=number_format($jumlah);                    
                }
                $result[] = array(
                            'dataId'=>1,                    
                            'compId'=>1,                    
                            'dataKarakter'=>$karakter,                    
                            'dataIndikator'=>$val->umurNama,                    
                            'dataJumlah'=>$tjumlah,                    
                            'dataPersentase'=>number_format($jumlah/$totalResponden*100,2).' %',                    
                          );

                $idx++;
            }

            $result[] = array(
                        'dataId'=>1,                    
                        'compId'=>1,                    
                        'dataKarakter'=>'&nbsp;',                    
                        'dataIndikator'=>'&nbsp;',                    
                        'dataJumlah'=>'&nbsp;',                    
                        'dataPersentase'=>'&nbsp;',                    
                      );

            $kerja = Kerja::get();
            $karakter='Pekerjaan';
            $idx=0;
            foreach($kerja as $key=>$val){
                if($idx>0) $karakter='&nbsp;';

                $jumlah=$this->hitungKerja($val->kerjaId);
                if($jumlah==0){
                    $tjumlah='&nbsp;0';
                }else{
                    $tjumlah=number_format($jumlah);                    
                }
                $result[] = array(
                            'dataId'=>1,                    
                            'compId'=>1,                    
                            'dataKarakter'=>$karakter,                    
                            'dataIndikator'=>$val->kerjaNama,                    
                            'dataJumlah'=>$tjumlah,                    
                            'dataPersentase'=>number_format($jumlah/$totalResponden*100,2).' %',                    
                          );

                $idx++;
            }

            $result[] = array(
                        'dataId'=>1,                    
                        'compId'=>1,                    
                        'dataKarakter'=>'&nbsp;',                    
                        'dataIndikator'=>'&nbsp;',                    
                        'dataJumlah'=>'&nbsp;',                    
                        'dataPersentase'=>'&nbsp;',                    
                      );

            $sekolah = Sekolah::get();
            $karakter='Pendidikan';
            $idx=0;
            foreach($sekolah as $key=>$val){
                if($idx>0) $karakter='&nbsp;';

                $jumlah=$this->hitungSekolah($val->sekId);
                if($jumlah==0){
                    $tjumlah='&nbsp;0';
                }else{
                    $tjumlah=number_format($jumlah);                    
                }
                $result[] = array(
                            'dataId'=>1,                    
                            'compId'=>1,                    
                            'dataKarakter'=>$karakter,                    
                            'dataIndikator'=>$val->sekLevel,                    
                            'dataJumlah'=>$tjumlah,                    
                            'dataPersentase'=>number_format($jumlah/$totalResponden*100,2).' %',                    
                          );

                $idx++;
            }
            // echo "<PRE>";
            // var_dump($data);
            // echo "</PRE>";
            // return;

            $data = array(
                'authmenu' => $this->getusermenu(),
                'company' => Session::get('compNama'),
                'logo' => Session::get('compLogo'),
                'detail' => Session::get('compDetail'),
                'name' => Session::get('name'),
                'namelong' => Session::get('email'),
                'page_tittle' => 'Jumlah Responden SKM',
                'page_active' => 'Jumlah Responden SKM',
                'grid' => $this->grid,
                'listdata' => $result,
                'primaryKey' => $this->primaryKey,
                'mainroute' => $this->mainroute,
                'compId' => $compId,
                'code' => 0,
            );

            return view('cms.Survey.demografi', $data)->with('data', $data);
        }
    }

    public function hitungKelamin($idx){
        $res = $this->model->where('dataKelamin','=',$idx)->count();
        return $res;
    }

    public function hitungUmur($idx){
        $res = $this->model->where('dataUmur','=',$idx)->count();
        return $res;
    }

    public function hitungKerja($idx){
        $res = $this->model->where('dataPekerjaan','=',$idx)->count();
        return $res;
    }

    public function hitungSekolah($idx){
        $res = $this->model->where('dataPendidikan','=',$idx)->count();
        return $res;
    }

}
