<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $table = 'msunit';
    protected $primaryKey = 'unitId';
    protected $fillable = ['compId','unitNama'];

}
