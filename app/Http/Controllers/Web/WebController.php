<?php

namespace App\Http\Controllers\Web;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Master\Umur;
use App\Models\Master\Layanan;
use App\Models\Master\Sekolah;
use App\Models\Master\Unit;
use App\Models\Master\Mspertanyaan;
use Session;
class WebController extends BaseController {

    public function index(){
        $umur = new Umur;
        $layanan = new Layanan;
        $pendidikan = new Sekolah;
        $unit = new Unit;
        $pertanyaan = new Mspertanyaan;

        // return $pertanyaan->get();
        $data = array('umur'=>$umur->get(),
                      'pendidikan'=>$pendidikan->get(),
                      'layanan'=>$layanan->get(),
                      'unit'=>$unit->get(),
                      'pertanyaan'=>$pertanyaan->get(),
                     );

        return view('web.index', $data)->with('data', $data);
    }

}
