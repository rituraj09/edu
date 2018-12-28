<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Model\Master\MasterSection;
use DB, Crypt, Helper, Validator, Redirect;
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
        $section = MasterSection::where('status','1')->where($where)->orderBy('serial', 'asc')->paginate(20);         
        return view('importsection', compact('section'));   
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
    public function importExcel(Request $request)
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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
