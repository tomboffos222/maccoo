<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //
    
    protected $fillable = ['title','chars','description','status','price','image1','image2','image3'];
}
