<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rolemenu extends Model
{
    use HasFactory;
    protected $table = 'role_menu';
    protected $primaryKey = 'rmId';
    protected $fillable = ['compId','rmRoleId','rmMenuId'];
}
