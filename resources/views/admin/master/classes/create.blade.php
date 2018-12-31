@extends('layout.admin.default') 
@section('page_title', 'Classes')
@section('main_content') 

<div class="panel panel-body">
    <ul class="nav nav-tabs">
    <li class="active"><a  href="{{ route('importclasses.create') }}">Add</a></li>
        <li><a href="{{ route('importclasses.index') }}">Import</a></li>
    </ul> 
    <div class="row">
        <div class="col-md-9">
            <div class="panel-body">    
            {!! Form::open(array('route' => 'importclasses.store', 'id' => 'importclasses.store', 'class'=>'form-horizontal')) !!}
                                <div class="row" >      
                                    <div class="col-md-12">      
                                        @include('admin.master.classes._create')
                                    </div>
                                </div>
                                <div class="row" style="margin-top:12px;">
                                <div class="col-md-2"> </div>
                                    <div class="col-md-10"> 
                                        <a id="btnsubmit" class="btn btn-primary"  onclick="return validateForm()">Submit</a>
                                        <a  href=""  class="btn btn-danger" >Reset</a>
                                        @include('confirm')
                                    </div>
                                </div>
                            {!! Form::close() !!} 
            </div>
        </div>
        <div class="col-md-3"> 

            @include('admin.master.classes.view') 
        </div>
    </div>
</div>
@stop