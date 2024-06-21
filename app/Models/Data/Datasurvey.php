<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datasurvey extends Model
{
    use HasFactory;
    protected $table = 'datasurvey';
    protected $primaryKey = 'dataId';
    protected $fillable = ['compId','dataNama','dataKelamin','dataHp','dataAlamat','dataUmur','dataPendidikan','dataPekerjaan','dataLayanan','dataUnit','dataTanya1','dataTanya2','dataTanya3','dataTanya4','dataTanya5','dataTanya6','dataTanya7','dataTanya8','dataTanya9','dataTanya10','dataJawab1','dataJawab2','dataJawab3','dataJawab4','dataJawab5','dataJawab6','dataJawab7','dataJawab8','dataJawab9','dataJawab10','dataSaran'];
}
