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

class KritikController extends Controllermaster
{
    public function __construct(){
        $this->model = new Datasurvey;
        $this->layanan = new Layanan;
        $this->unit = new Unit;
        $this->primaryKey = 'dataId';
        $this->mainroute = 'kritik';
        $this->mandatory = array(
            'compId' => 'required'
        );

        $this->grid = array(
            array(
                'label' => 'NAMA',
                'field' => 'dataNama',
                'type' => 'text',
                'width' => '20%'
            ),
            array(
                'label' => 'KRITIK & SARAN',
                'field' => 'dataSaran',
                'type' => 'text',
                'width' => '',
                'class' => 'left'
            ),
            array(
                'label' => 'PHONE',
                'field' => 'dataHp',
                'type' => 'text',
                'width' => '10%',
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

                $search = !empty($_GET['search']) ? $_GET['search'] : '';
                if($compStatus == 1){
                    if ($search == '') {
                        $listdata = $this->model
                            ->where('dataLayanan','like',$layanan)
                            ->where('dataUnit','like',$unit)
                            ->latest()
                            ->paginate(15);
                    } else {
                        $listdata = $this->model
                            ->where('dataLayanan','like',$layanan)
                            ->where('dataUnit','like',$unit)
                            ->where('dataNama', 'like', '%' . $search . '%')
                            ->paginate(15);
                    }
                }else{
                    if ($search == '') {
                        $listdata = $this->model
                            ->latest()
                            ->where('dataLayanan','like',$layanan)
                            ->where('dataUnit','like',$unit)
                            ->where('compId', '=', $compId)
                            ->paginate(15);
                    } else {
                        $listdata = $this->model
                            ->latest()
                            ->where('dataNama', 'like', '%' . $search . '%')
                            ->where('compId', '=', $compId)
                            ->where('dataLayanan','like',$layanan)
                            ->where('dataUnit','like',$unit)
                            ->paginate(15);
                    }
                }

            }else{
                $jumdata=$this->model
                        ->where(DB::raw('MONTH(created_at)'),'=',$bulan)
                        ->where(DB::raw('YEAR(created_at)'),'=',$tahun)
                        ->where('dataLayanan','like',$layanan)
                        ->where('dataUnit','like',$unit)
                        ->count();


                $search = !empty($_GET['search']) ? $_GET['search'] : '';
                if($compStatus == 1){
                    if ($search == '') {
                        $listdata = $this->model
                            ->where(DB::raw('MONTH(created_at)'),'=',$bulan)
                            ->where(DB::raw('YEAR(created_at)'),'=',$tahun)
                            ->where('dataLayanan','like',$layanan)
                            ->where('dataUnit','like',$unit)
                            ->latest()
                            ->paginate(15);
                    } else {
                        $listdata = $this->model
                            ->where(DB::raw('MONTH(created_at)'),'=',$bulan)
                            ->where(DB::raw('YEAR(created_at)'),'=',$tahun)
                            ->where('dataLayanan','like',$layanan)
                            ->where('dataUnit','like',$unit)
                            ->where('dataNama', 'like', '%' . $search . '%')
                            ->paginate(15);
                    }
                }else{
                    if ($search == '') {
                        $listdata = $this->model
                            ->latest()
                            ->where(DB::raw('MONTH(created_at)'),'=',$bulan)
                            ->where(DB::raw('YEAR(created_at)'),'=',$tahun)
                            ->where('dataLayanan','like',$layanan)
                            ->where('dataUnit','like',$unit)
                            ->where('compId', '=', $compId)
                            ->paginate(15);
                    } else {
                        $listdata = $this->model
                            ->latest()
                            ->where(DB::raw('MONTH(created_at)'),'=',$bulan)
                            ->where(DB::raw('YEAR(created_at)'),'=',$tahun)
                            ->where('dataLayanan','like',$layanan)
                            ->where('dataUnit','like',$unit)
                            ->where('dataNama', 'like', '%' . $search . '%')
                            ->where('compId', '=', $compId)
                            ->paginate(15);
                    }
                }
            }




            $data = array(
                'authmenu' => $this->getusermenu(),
                'company' => Session::get('compNama'),
                'logo' => Session::get('compLogo'),
                'detail' => Session::get('compDetail'),
                'name' => Session::get('name'),
                'namelong' => Session::get('email'),
                'page_tittle' => 'Rangkuman Kritik & Saran',
                'page_active' => 'Rangkuman Kritik & Saran',
                'grid' => $this->grid,
                'listdata' => $listdata,
                'primaryKey' => $this->primaryKey,
                'mainroute' => $this->mainroute,
                'layanan' => $this->layanan::all(),
                'unit' => $this->unit::all(),
                'selected' => $selected,
                'compId' => $compId,
                'code' => 0,
            );

            return view('cms.Survey.kritik', $data)->with('data', $data);
        }
    }

}
