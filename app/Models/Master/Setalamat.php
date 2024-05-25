<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setalamat extends Model
{
    use HasFactory;
    protected $table = 'mskel';
    protected $primaryKey = 'kelId';
    protected $fillable = ['kelKec','kelKode','kelNama'];
}
