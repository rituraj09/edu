<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model;

class MasterSection extends Model
{
    protected $table = 'master_sections';
    public $primaryKey = 'id';
    public $timestamps =true;
    protected $fillable 	= array('name','serial','class_id','created_by'); 
    protected $guarded   	= ['_token']; 
    public static $rules 	= [ 
        'name' 				=> 'required|max:127|unique:master_sections,name,0,status',  
        'class_id' 	        => 'required|exists:master_classes,id', 
    ]; 
    public static $messages = array(        
        'name.required' => 'The Section Name is required!',
        'name.unique' => 'The Section Name is already be taken!',
        'name.max' => 'The Section Name must be less than 128 character!', 
        'class_id.required' => 'Class under is required!'
    );  
    public function students()
    {
        return $this->hasMany('App\Model\Master\Student'); 
    }
    public function sections()
    {
        return $this->hasMany('App\Model\Master\MasterSection'); 
    }
    public function classes()
    {
        return $this->belongsTo('App\Model\Master\MasterClass','class_id');
    } 
}
