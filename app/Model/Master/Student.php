<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    public $primaryKey = 'id';
    public $timestamps =true;
    protected $fillable 	= array('sys_id','section_id','batch_number','roll_number','name','fathers_name','mothers_name','gender','birth_date','permanent_address','pin_code','mobile','email','remarks','created_by'); 
    protected $guarded   	= ['_token']; 
    
    public static $messages = array(        
        'sys_id.required' => 'The Student Code Name is required!',
        'sys_id.unique' => 'The Student Code is already be taken!',
        'sys_id.max' => 'The Student Code  must be less than 12 character!',  
    );  
    public function sections()
    {
        return $this->belongsTo('App\Model\Master\MasterSection','section_id');
    }  
}
