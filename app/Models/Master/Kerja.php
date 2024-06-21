<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kerja extends Model
{
    use HasFactory;
    protected $table = 'mskerja';
    protected $primaryKey = 'kerjaId';
    protected $fillable = ['compId','kerjaNama'];
}
