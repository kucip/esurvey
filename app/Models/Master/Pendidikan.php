<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    use HasFactory;
    protected $table = 'mspendidikan';
    protected $primaryKey = 'pendId';
    protected $fillable = ['pendNama'];
}
