@extends('layout.admin.default') 
@section('page_title', 'Students')
@section('main_content') 
<div class="panel panel-body"> 
    <ul class="nav nav-tabs">
        <li class="active"><a  href="{{ route('students.create') }}">Add</a></li>
        <li><a href="{{ route('students.import') }}">Import</a></li>
        <li><a href="{{ route('students.view') }}">View</a></li>
    </ul> 

</div>
@stop