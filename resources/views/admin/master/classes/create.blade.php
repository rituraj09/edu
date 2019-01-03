@extends('layout.admin.default') 
@section('page_title', 'Classes')
@section('main_content') 
<div class="panel panel-body">
    <ul class="nav nav-tabs">
    <li class="active"><a  href="{{ route('classes.create') }}">Add</a></li>
        <li><a href="{{ route('classes.import') }}">Import</a></li>
    </ul> 
    <div class="row">
        <div class="col-md-9">
            <div class="panel-body">   
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
            {!! Form::open(array('route' => 'classes.store', 'id' => 'classes.store', 'class'=>'form-horizontal', 'onsubmit' => 'return validateForm()')) !!}
                <div class="row" >      
                    <div class="col-md-12">      
                        @include('admin.master.classes._create')
                    </div>
                </div>
                <div class="row" style="margin-top:12px;">
                <div class="col-md-2"> </div>
                    <div class="col-md-10"> 
                        <button class="btn btn-primary" type="submit">Submit</button> 
                        <a  href="{{ route('classes.create') }}"  class="btn btn-danger" >Reset</a>     
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