<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;
    protected $table = 'mslayanan';
    protected $primaryKey = 'layId';
    protected $fillable = ['compId','layNama'];
}
