<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Syslog extends Model
{
    use HasFactory;
    protected $table = 'syslog';
    protected $primaryKey = 'id';
    protected $fillable = ['compId','user','tabel','query','detail'];
}