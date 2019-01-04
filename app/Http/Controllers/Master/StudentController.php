<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Master\MasterClass;
use App\Model\Master\MasterSection;
use App\Model\Master\Student;
use App\Model\Transaction\Result;
use App\Helpers\helper;  
use DB, Crypt, Validator, Redirect;
use Excel; 


class StudentController extends Controller
{ 
    public function index()
    { 
        $classes   = Helper::allClasses($list = true);       
        return view('admin.master.students.import', compact('classes')); 
    }
    public function rules_add($sectionid)
    {	        
        $section_id = 'required'; 
        $sys_id = 'required|max:12|unique:students,sys_id,0,status'; 
        $roll_number = 'required|max:12|unique:students,roll_number,0,status,section_id,'.$sectionid;
        $batch_number = 'required|max:20'; 
        $name = 'required|max:132'; 
        $fathers_name = 'required|max:132'; 
        $mothers_name = 'required|max:132'; 
        $birth_date = 'required|max:22'; 
        $mobile = 'required|max:132'; 
        $permanent_address = 'required|max:932'; 
        $pin_code = 'required|max:6'; 
        return [  
            'section_id'   => $section_id,
            'sys_id'       => $sys_id, 
            'roll_number'  => $roll_number, 
            'batch_number' => $batch_number, 
            'name'         => $name, 
            'fathers_name' => $fathers_name, 
            'mothers_name' => $mothers_name, 
            'birth_date'   => $birth_date, 
            'mobile'       => $mobile, 
            'permanent_address' => $permanent_address, 
            'pin_code'  => $pin_code, 
      ]; 
    }
    public function importFile(Request $request)
    {
        if($request->file('import_file'))
        {
            
            $extensions = array("xls","xlsx","xlm","xla","xlc","xlt","xlw");
            $result = array($request->file('import_file')->getClientOriginalExtension());
            if(in_array($result[0],$extensions))
            {
                $path = $request->file('import_file')->getRealPath();
                $data = Excel::selectSheets('Sheet1')->load($path, function($reader)
                { })->get(); 
                if($data->count()){ 
                    $i=0;
                    foreach ($data->toArray() as $key => $value) 
                    {  
                        DB::beginTransaction();    
                        $section_id =$datas['section_id'];           
                        $datas['section_id'] = $request['section_id'];     
                        $datas['batch_number'] = $value[0];         
                        $datas['sys_id'] = $value[1];               
                        $datas['roll_number'] = $value['roll_number'];              
                        $datas['name'] = $value['name'];      
                        $datas['fathers_name'] = $value['fathers_name'];   
                        $datas['mothers_name'] = $value['mothers_name'];   
                        $datas['birth_date'] = $value['birth_date'];     
                        $datas['permanent_address'] = $value['address'];     
                        $datas['pin_code'] = $value['pin_code'];     
                        $datas['mobile'] = $value['perents_mobile'];     
                        $datas['email'] = $value['parents_email'];     
                        $datas['remarks'] = $value['remarks'];                   
                        $datas['created_by'] = 1;  
                        $rules      = $this->rules_add($section_id);   
                        $validator = Validator::make($datas, $rules);     
                        if ($validator->fails()) 
                        {        
                            $i = $i+1;
                        }
                        else
                        {  
                            DB::commit();   
                            Student::create($datas); 
                        } 
                    }    
                    if($i==0)
                    {
                        return back()->with('success', 'Insert Record successfully.'); 
                    }
                    else
                    {
                        return back()->with('success', 'Insert Record successfully with failed to insert '.$i. ' duplicate record!'); 
                    } 
                }            
                else
                { 
                    return back()->with('failed', 'Failed to insert.'); 
                }
            } 
            else
            { 
                return back()->with('failed', 'Wrong extension!'); 
            } 
         
        }
        else
        { 
            return back()->with('failed', 'Please select the an excel file.'); 
        } 
    } 
    public function create()
    {
         
    }

    
    public function store(Request $request)
    {
      
    }
 
    public function show($id)
    {
   
    }

    
    public function edit($id)
    {
   
    }

   
    public function update(Request $request, $id)
    {
    
    }
 
    public function destroy($id)
    {
   
    }
}
