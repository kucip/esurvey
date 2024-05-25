<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    use HasFactory;
    protected $table = 'msagama';
    protected $primaryKey = 'agamaId';
    protected $fillable = ['agamaNama'];
}
