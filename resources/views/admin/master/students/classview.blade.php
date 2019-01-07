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
                <div class="row" >      
                    <div class="col-md-12"> 
                    <?php $i = ($class->currentpage()-1)* $class->perpage(); ?> 
                    <table class="table table-striped table-bordered table-hover dataTable no-footer">
                    <thead>
                    <tr role="row">
                    <th  align="center" style="width: 100px;"> 
                         <center>Sl.No. </center> 
                    </th>
                    <th> 
                        Class 
                    </th>  
                     
                    </thead>
                    </tr> 
                    <tbody>
                    @if(count($class) > 0)
                    @foreach($class as $classes) 
                    <?php   $i++;?>
                    <tr>
                    <td align="center">
                    <?php echo $i;?>
                    </td>
                    <td data-widget="collapse" data-toggle="collapse"
                          data-target='#demo{{ $classes->id }}'> 
                
                    <a >          
                    <?php (int)$std = 0; ?>           
                    {{$classes->name}}    
                    @foreach($classes['sections'] as $section)  
                    <?php (int)$std += $section['students']->count(); ?> 
                    @endforeach    
                            (<?php echo $std; ?>)
                    <span class="pull-right"> 
                        <i class="fa fa-plus"  data-toggle="collapse" data-target='#demo{{ $classes->id }}'></i>
                    </span>
                    </a> 
                    <ol  id="demo{{$classes->id}}" class="collapse">
                    @foreach($classes['sections'] as $section)  
                        <li> 
                          <a href="{{ route( 'students.details' ,['id'=>Crypt::encrypt($section->id)])}}">  Section - {{$section->name}}  ({{$section['students']->count()}})</a>
                          
                        </li>
                    @endforeach 
                    </ol> 
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