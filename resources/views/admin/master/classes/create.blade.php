@extends('layout.admin.default') 
@section('page_title', 'Classes')
@section('main_content') 

<div class="panel panel-body">
    <ul class="nav nav-tabs">
    <li class="active"><a  href="{{ route('admin.importclasses.create') }}">Add</a></li>
        <li><a href="{{ route('admin.importclasses.index') }}">Import</a></li>
    </ul> 
    <div class="row">
        <div class="col-md-9">
            <div class="panel-body">    
            </div>
        </div>
        <div class="col-md-3"> 
            @include('admin.master.classes.view') 
        </div>
    </div>
</div>
@stop