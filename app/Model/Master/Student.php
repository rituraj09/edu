<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    public $primaryKey = 'id';
    protected $guarded   	= ['_token']; 
     
}
