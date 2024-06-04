<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    use HasFactory;
    protected $table = 'mssekolah';
    protected $primaryKey = 'sekId';
    protected $fillable = ['compId','sekLevel'];
}
