<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Model\Master\MasterSection;
use App\Model\Master\MasterClass;  
use App\Model\Master\Student;
use App\Model\Transaction\Result;
use App\Helpers\helper;  
use DB, Crypt, Validator, Redirect;
use Excel; 

class MasterSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        $where = [];
        if($request->q) { 
            $where[] = array('name', 'LIKE', trim($request->q).'%');
        }  
        $section = MasterSection::where('status','1')->where($where)->orderBy('serial', 'asc')->paginate(10);         
        return view('admin.master.section.importsection', compact('section'));   
    }
    public function rules_edit($id)
    {	        
        $name  				= 'required|max:127|unique:master_sections,name,0,status,class_id,'.$id;  
        $class_id 	        = 'required|exists:master_classes,id'; 
         return [ 
         'name'  => $name,
         'class_id'  => $class_id, 
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
                        $datas['serial'] = $value['serial'];                       
                        $datas['class_id'] = $value['class_id'];   
                        $datas['name'] = $value['name'];                       
                        $datas['created_by'] = 1; 
                        $classid = $value['class_id'];
                        $rules      = $this->rules_edit($classid);   
                        $validator = Validator::make($datas, $rules);     
                        if ($validator->fails()) 
                        {        
                            $i = $i+1;
                        }
                        else
                        { 
                            //$arr[] = ['serial' => $value['serial'], 'name' => $value['name']]; 
                            DB::commit();   
                            MasterSection::create($datas); 
                        } 
                    }   
                // if(!empty($arr)){
                        if($i==0)
                        {
                            return back()->with('success', 'Insert Record successfully.'); 
                        }
                        else
                        {
                            return back()->with('success', 'Insert Record successfully with failed to insert '.$i. ' duplicate record!'); 
                        }
                    //} 
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
        $classes   = Helper::allClasses($list = true);  
        $section = MasterSection::where('status','1')->orderBy('serial', 'asc')->paginate(10);        
        return view('admin.master.section.create', compact('section','classes')); 
    } 
    public function store(Request $request)
    {
        DB::beginTransaction();    
        $data       = $request->all();   
       // $user_id = Auth::id();  
        $data['created_by'] = 1 ;   
        $id = DB::table('master_sections')->max('id');
        $id = (int)$id+1;
        $data['serial']  =$id ;
        $classid = $request['class_id'];
        $rules      = $this->rules_edit($classid);    
        $messages      = MasterSection::$messages;   
        $validator = Validator::make($data, $rules,$messages); 
        if ($validator->fails()) 
        {  
            DB::commit();           
            return Redirect::back()->withErrors($validator)->withInput(); 
        }
        if(MasterSection::create($data)) { 
            DB::commit();    
            return back()->with( 'success', 'Section has been added successfully !');  
        }
        else{ 
            DB::commit();    
            return back()->with( 'failed', 'Unable to store Record!');  
        }
    } 
    public function edit($id)
    {
        $id = Crypt::decrypt($id);  
        $classes   = Helper::allClasses($list = true);  
        $sectionbyid = MasterSection::findOrFail($id);  
        $section = MasterSection::where('status','1')->orderBy('serial', 'asc')->paginate(10);            
        return view('admin.master.section.edit', compact('section','sectionbyid','classes'));    
    } 
    public function rules_update($id, $classid)
    {	        
        $name  				= 'required|max:127|unique:master_sections,name,0,status,id,!'.$id.',class_id,'.$classid;  
        $class_id 	        = 'required|exists:master_classes,id'; 
         return [ 
         'name'  => $name,
         'class_id'  => $class_id, 
      ]; 
    }
    public function update(Request $request, $id)
    {
        DB::beginTransaction();   
        $id = Crypt::decrypt($id);   
                        
        $classid = $request['class_id'];  
        $rules      = $this->rules_update($id,$classid);     
        $messages      = MasterSection::$messages;   
        $data       = $request->all();  
        $data['updated_by'] = 1 ;   
        $sections = MasterSection::find($id);     
        $validator = Validator::make($data, $rules,$messages);
        if ($validator->fails())
        {
            DB::commit();
            return Redirect::back()->withErrors($validator)->withInput(); 
        }
        $sections->fill($data); 
        if($sections->save()) {
            DB::commit();     
            return Redirect::route('sections.create')->with('success', 'Section has been updated successfully !'); 
        }
        else{ 
            DB::commit();    
            return back()->with( 'failed', 'Unable to update Record!');  
        } 
    } 
    public function destroy($id)
    {
        DB::beginTransaction();   
        $students = Student::where('status','1')->where('section_id',$id)->get();
        $students = count($students);
        if((int)$students < 1)
        {   
            $results = Result::where('status','1')->where('section_id',$id)->get();
            $results = count($results);
            if((int)$results < 1)
            {
                $sections = MasterSection::find($id); 
                $sections->status ="0";     
                if($sections->save()) { 
                    DB::commit();    
                    return back()->with( 'success', 'Record has been deleted successfully!');  
                }
                else
                { 
                    DB::commit();    
                    return back()->with( 'failed', 'Unable to delete Record!');  
                } 
            }
            else
            {
                DB::commit();    
                return back()->with( 'failed', 'You cannot delete this Section!');   
            }
    
        }
        else
        {
            DB::commit();    
            return back()->with( 'failed', 'You cannot delete this Section!');   
        }
    }
}
