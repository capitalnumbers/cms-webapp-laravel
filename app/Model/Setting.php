<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
   	protected $fillable = ['field', 'value'];  //database fields to be worked 
}
