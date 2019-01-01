<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Master\MasterClass;
use DB, Crypt, Helper, Validator, Redirect;
use Excel; 

class MasterClassController extends Controller
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
        $classes = MasterClass::where('status','1')->where($where)->orderBy('serial', 'asc')->paginate(10);         
        return view('admin.master.classes.importclass', compact('classes'));  
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
                        $datas['name'] = $value['name'];                       
                        $datas['created_by'] = 1; 
                        $rules      = MasterClass::$rules;     
                        $validator = Validator::make($datas, $rules);     
                        if ($validator->fails()) 
                        {        
                            $i = $i+1;
                        }
                        else
                        { 
                            //$arr[] = ['serial' => $value['serial'], 'name' => $value['name']]; 
                            DB::commit();   
                            MasterClass::create($datas); 
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
            return back()->with('failed', 'Please select the file.'); 
        }
    }
     
     
    public function create(request $request)
    {
        $where = [];
        if($request->q) { 
            $where[] = array('name', 'LIKE', trim($request->q).'%');
        }  
        $classes = MasterClass::where('status','1')->where($where)->orderBy('serial', 'asc')->paginate(10);         
        return view('admin.master.classes.create', compact('classes'));  
    }
    public function store(Request $request)
    { 
        DB::beginTransaction();   
        $type    =   '';
        $message    = '';
        $data       = $request->all();   
       // $user_id = Auth::id();  
        $data['created_by'] = 1 ;   
        $id = DB::table('master_classes')->max('id');
        $id = (int)$id+1;
        $data['serial']  =$id ;
        $rules      = MasterClass::$rules;    
        $messages      = MasterClass::$messages;   
        $validator = Validator::make($data, $rules,$messages); 
        if ($validator->fails()) 
        {  
            DB::commit();           
            return Redirect::back()->withErrors($validator)->withInput(); 
        }
        if(MasterClass::create($data)) { 
            DB::commit();    
            return back()->with( 'success', 'Class has been added successfully !');  
        }
        else{ 
            DB::commit();    
            return back()->with( 'failed', 'Unable to store Accounting Head!');  
        }
                      
   
    }
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
    public function update(Request $request, $id)
    {
        //
    } 
    public function destroy($id)
    {
        //
    }
}
