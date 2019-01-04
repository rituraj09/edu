<?php

namespace App\Model\Transaction;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{    
    protected $table = 'results';
    public $primaryKey = 'id';
    protected $guarded   	= ['_token']; 
}
