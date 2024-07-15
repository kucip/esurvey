<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umur extends Model
{
    use HasFactory;
    protected $table = 'msumur';
    protected $primaryKey = 'umurId';
    protected $fillable = ['compId','umurNama'];
}
