<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controllermaster;
use Illuminate\Http\Request;
use Validator;
use App\Models\Company;
use App\Http\Resources\CompanyResource;

class CompanyapiController extends Controller
{
    public function __construct(){
        $this->model=new Company;
        $this->resources=new CompanyResource(null);
        $this->mandatory=array(
                                'compNama' => 'required',
                                'compPemilik' => 'required'
                              );
    }
}
