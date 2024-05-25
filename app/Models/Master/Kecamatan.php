<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'mskec';
    protected $primaryKey = 'kecId';
    protected $fillable = ['kecKab','kecKode','kecNama'];

}
