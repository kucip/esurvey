<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docs extends Model
{
    use HasFactory;

    protected $table = 'docs';
    protected $primaryKey = 'did';
    protected $fillable = ['compId','dnama'];
}
