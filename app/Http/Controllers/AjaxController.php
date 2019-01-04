<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Model\Master\MasterSection;
use App\Model\Master\MasterClass;  
use App\Model\Master\Student;
use App\Model\Transaction\Result;
use App\Helpers\helper;  
use DB, Crypt, Validator, Redirect; 
use Response;
class AjaxController extends Controller
{
    public function ajaxsections(Request $request)
    {    
        if($request->ajax()){
           $sections = DB::table('master_sections')->where('class_id',$request->class_id)->pluck("name","id")->all(); 
           $data = view('admin.master.students.ajax-select',compact('sections'))->render();
           return response()->json(['options'=>$data]); 
        }
     
    }
}
