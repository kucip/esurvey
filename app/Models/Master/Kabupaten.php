<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;

    protected $table = 'mskab';
    protected $primaryKey = 'kabId';
    protected $fillable = ['kabProv','kabKode','kabNama'];
}
