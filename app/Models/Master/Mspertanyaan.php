<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mspertanyaan extends Model
{
    use HasFactory;

    protected $table = 'mssurvey';
    protected $primaryKey = 'surId';
    protected $fillable = ['compId','surPertanyaan','surOpt1','surOpt2','surOpt3','surOpt4','surOpt5','surUnsur','surBobot1','surBobot2','surBobot3','surBobot4','surBobot5'];
}
