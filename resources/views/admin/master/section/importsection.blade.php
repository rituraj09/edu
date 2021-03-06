@extends('layout.admin.default') 
@section('page_title', 'Section')
@section('main_content') 

       
<div class="panel panel-body"> 
        <ul class="nav nav-tabs">
                <li><a  href="{{ route('sections.create') }}">Add</a></li>
                    <li class="active"><a href="{{ route('sections.import') }}">Import</a></li>
                </ul> 
    <div class="row">
            <div class="col-md-7">
                <div class="panel-body"> 
                        {!! Form::open(array('route' => 'sections.importFile', 'id' => 'sections.importFile', 'class'=>'form-horizontal', 'enctype' => 'multipart/form-data')) !!}
                        @csrf    
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
                            <div class="form-group">
                                
                            <label>Select the Excel File</label>
                                <input type="file" name="import_file" />
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">Import File</button>
                            </div>
                        </div> 
                    </div>
                {!! Form::close() !!} 
                </div>  
            </div>
            <div class="col-md-5">  
            @include('admin.master.section.view') 
            </div>
        </div>
</div>
@stop     
    