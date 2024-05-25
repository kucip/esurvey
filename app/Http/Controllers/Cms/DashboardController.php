<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Cms\Controllermaster;
use Illuminate\Http\Request;
use DB;
use Session;

class DashboardController extends Controllermaster //Controller 
{
    public function index(){
        
        if(trim(Session::get('email'))=='' or $this->checkRouteAuth()==2){

            $wallidx=rand(1,7);
            $data = array(
                'wallidx' => $wallidx,
                'message' => 'Anda telah logout dari system.',
            ); 
            return view('cms.login',$data);        
        }else{

                $diagnosa = DB::table('view_diagnosa')->get();
                $umur = DB::table('view_umur')->get();
                $umur_diagnosa = DB::table('view_umur_diagnosa')->get();
                $kecamatan = DB::table('view_kecamatan')->get();
                $kecamatan_diagnosa = DB::table('view_kecamatan_diagnosa')->get();
                $gender = DB::table('view_gender')->get();


                $listumur=array();
                foreach ($umur as $key => $val) {
                    $kode=$val->no;
                    $ket =$val->ket;
                    $umurdiag=$this->getUmurDiagnosa($kode);

                    $listumur[]=array(
                                    "ket"=>$ket,
                                    "diagnosa"=>!empty($umurdiag->diagnosa)?$umurdiag->diagnosa:'',
                                    "jumlah"=>!empty($umurdiag->jumlah)?number_format($umurdiag->jumlah):0,
                                );
                }


                $kecResult=array();
                foreach ($kecamatan as $key => $val) {
                    $kode=$val->kode;
                    $jum =$val->jumlah;
                    $nama=$this->getKecNama($kode);
                    $kecdiag=$this->getKecDiag($kode);
                    $kecResult[]=array(
                                    "kode"=>$kode,
                                    "nama"=>$nama,
                                    "jumlah"=>$jum,
                                    "diagnosa"=>!empty($kecdiag->diagnosa)?$kecdiag->diagnosa:'',
                                    "maxjum"=>!empty($kecdiag->jumlah)?number_format($kecdiag->jumlah):0,
                                );
                }
                $data = array(
                        'authmenu'=>$this->getusermenu(),
                        'company' => Session::get('compNama'),
                        'logo' => Session::get('compLogo'),
                        'detail' => Session::get('compDetail'),
                        'name' => Session::get('name'),
                        'namelong' => Session::get('email'),
                        'tittle'=>'Dashboard',
                        'page_tittle'=> 'Biling Management',
                        'page_active'=>'Dashboard',
                        'diagnosa' => json_encode($diagnosa),
                        'diagnosa2' => $diagnosa,
                        'kecamatan' => json_encode($kecResult),
                        'listkecamatan' => $kecResult,
                        'kecamatan_diagnosa' => json_encode($kecamatan_diagnosa),
                        'gender' => json_encode($gender),
                        'listumur' => $listumur,
                        'umurdiagnosa' => json_encode($umur_diagnosa)
                        );
                return view('cms.dashboard',$data)->with('data', $data);
        }
    }
    public function getUmurDiagnosa($kode){
            $umur = DB::table('view_umur_diagnosa')
                        ->where('no','=',$kode)
                        ->orderby('jumlah','desc')
                        ->limit(1)
                        ->get();

            if(count($umur)>0){
                return $umur[0];
            }else{
                return '';                
            }

    }

    public function getKecDiag($kode){
            $kecdiag = DB::table('view_kecamatan_diagnosa')
                        ->where('rawatKec','=',$kode)
                        ->orderby('jumlah','desc')
                        ->limit(1)
                        ->get();

            if(count($kecdiag)>0){
                return $kecdiag[0];
            }else{
                return '';                
            }        
    }

    public function getKecNama($kode){
            $kecamatan = DB::table('mskec')
                        ->where('kecKode','=',$kode)
                        ->get();

            if(count($kecamatan)>0){
                return $kecamatan[0]->kecNama;
            }else{
                return '';                
            }
    }

}
