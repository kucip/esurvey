<?php

namespace App\Http\Controllers\Web;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Master\Umur;
use App\Models\Master\Layanan;
use App\Models\Master\Sekolah;
use App\Models\Master\Unit;
use App\Models\Master\Mspertanyaan;
use App\Models\Master\Kerja;
use Session;
class WebController extends BaseController {

    public function index(){
        $umur = new Umur;
        $layanan = new Layanan;
        $pendidikan = new Sekolah;
        $unit = new Unit;
        $pertanyaan = new Mspertanyaan;
        $kerja = new Kerja;
        $compId = 1;

        $data = array('umur'=>$umur->get(),
                      'pendidikan'=>$pendidikan->get(),
                      'layanan'=>$layanan->get(),
                      'unit'=>$unit->get(),
                      'pertanyaan'=>$pertanyaan->get(),
                      'kerja'=>$kerja->get(),
                      'compId' => $compId,
                     );

        return view('web.index', $data)->with('data', $data);
    }

    public function thanks(){
        $nama=$_GET['nama'];
        $data = array('nama'=>$nama,
                     );

        return view('web.thanks', $data)->with('data', $data);
    }
}
