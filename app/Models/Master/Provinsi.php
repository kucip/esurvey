<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;
    protected $table = 'msprov';
    protected $primaryKey = 'provId';
    protected $fillable = ['provKode','provNama'];
}
