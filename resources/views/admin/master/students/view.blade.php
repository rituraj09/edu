@extends('layout.admin.default') 
@section('page_title', 'Students')
@section('main_content') 
<div class="panel panel-body"> 
    <ul class="nav nav-tabs">
        <li><a  href="{{ route('students.create') }}">Add</a></li>
        <li><a href="{{ route('students.import') }}">Import</a></li>
        <li  class="active"><a href="{{ route('students.view') }}">View</a></li>
    </ul> 
    <div class="row">
        <div class="col-md-12">
            <div class="panel-body"> 
                <div class="row" >      
                    <div class="col-md-12">               
                        <div class="form-group">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif  
                            @if (Session::has('success'))
                                <div class="alert alert-success">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <p>{{ Session::get('success') }}</p>
                                </div>
                            @endif 
                            @if (Session::has('failed'))
                                <div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <p>{{ Session::get('failed') }}</p>
                                </div>
                            @endif 
                        </div>
                    </div>
                </div>
                <div class="row"> 
                <div class="col-md-12"> 
                    @foreach($student as $students) 
                    @if ($loop->first)
                  <h2>Class  {{$students->sections->classes->name }},
                  Section {{$students->sections->name }}
                  <a href="{{ route('students.view') }}" class="btn btn-info btn sm pull-right">Back</a>
                  </h2>
                  @endif
                    @endforeach

                    
                </div>
                </div>
                <div class="row" >      
                    <div class="col-md-12"> 
                    <?php $i = ($student->currentpage()-1)* $student->perpage(); ?> 
                    <table class="table table-striped table-bordered table-hover dataTable no-footer">
                    <thead>
                    <tr role="row">
                    <th  style="width: 60px;"> 
                         <centre>Sl.No. </centre> 
                    </th>
                     
                    <th>
                        <centre>Batch </centre> 
                    </th> 
                    <th> 
                         <centre>Student ID </centre>
                    </th>     
                    <th>
                         <centre>Roll No. </centre> 
                    </th>    
                    <th>
                        <centre>Student Name</centre>                     
                    </th> 
                    <th>
                        <centre>Father's Name</centre>      
                    </th> 
                    <th>
                        <centre>Mother's Name</centre>      
                    </th> 
                    <th>
                        <centre>Gender</centre>      
                    </th> 
                    <th>
                     <centre>Date of Birth</centre>      
                    </th> 
                    <th>
                        <centre>Address</centre>      
                    </th>   
                    <th width="100px">
                     <centre>Gaurdian's Phone no.</centre>      
                    </th>  
                    <th> 
                    </th>  
                    </thead>
                    </tr> 
                    <tbody>
                    @if(count($student) > 0)
                    @foreach($student as $students) 
                    <?php   $i++;?>
                    <tr>
                    <td align="center">
                    <?php echo $i;?>
                    </td>
                     
                    <td align="center">
                    {{$students->batch_number}}
                    </td> 
                    <td align="center">
                    {{$students->sys_id}}
                    </td> 
                    <td align="center">
                    {{$students->roll_number}}
                    </td> 
                    <td align="center">
                    {{$students->name}}
                    </td> 
                    <td align="center">
                    {{$students->fathers_name}}
                    </td> 
                    <td align="center">
                    {{$students->mothers_name}}
                    </td> 
                    <td align="center">
                    {{$students->gender}}
                    </td> 
                    <td align="center">
                    {{$students->birth_date}}
                    </td> 
                    <td align="center">
                    {{$students->permanent_address}}, PIN - 
                    {{$students->pin_code}}
                    </td> 
                    <td align="center">
                    {{$students->mobile}}
                    </td> 
                    <td align="center">
                    
                    </td>  
                    </tr>
                
                    @endforeach
                    @endif
                    </tbody>
                    </table> 
                    </div>
                </div>  
            </div>
            
        </div>
    </div>
</div>
@stop