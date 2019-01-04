<?php
namespace App\Helpers;
use DB, Validator, Redirect, Auth, Crypt;
use App\Models\Profile\UserProfile;
class Helper
{
    public static function shout(string $string)
    {
        return strtoupper($string);
    }
    public static function allClasses($list = false, $where = [])
    {
    	if($list) return DB::table('master_classes')->orderBy('serial','asc')->where($where)->where('status',1)->where('is_active',1)->pluck('name','id');
		return DB::table('master_classes')->orderBy('serial','asc')->where($where)->where('status',1)>where('is_active',1)->get();    
    }
    public static function sectionbyclass($list = false, $classid)
    {
    	if($list) return DB::table('master_sections')->orderBy('serial','asc')->where('class_id',$classid)->where('status',1)->where('is_active',1)->pluck('name','id');
		return DB::table('master_sections')->orderBy('serial','asc')->where('class_id',$classid)->where('status',1)>where('is_active',1)->get();    
    }
}