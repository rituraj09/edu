<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model;

class MasterClass extends Model
{
    protected $table = 'master_classes';
    public $primaryKey = 'id';
    public $timestamps =true;
    protected $fillable 	= array('serial','name','created_by'); 
    protected $guarded   	= ['_token']; 
    public static $rules 	= [ 
        'name' 				=> 'required|max:127|unique:master_classes,name,0,status',  
    ]; 
    public static $messages = array(        
        'name.required' => 'The Class Name is required!',
        'name.unique' => 'The Class Name is already be taken!',
        'name.max' => 'The Class Name must be less than 128 character!',  
    );  
    public function sections()
    {
        return $this->hasMany('App\Model\Master\MasterSection','class_id')->where('status', 1); 
    }
   

}
