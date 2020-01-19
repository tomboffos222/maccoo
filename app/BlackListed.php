<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlackListed extends Model
{

    protected $fillable = ['zhsn'];
}
