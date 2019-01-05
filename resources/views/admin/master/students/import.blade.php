@extends('layout.admin.default') 
@section('page_title', 'Students')
@section('main_content') 
<div class="panel panel-body"> 
    <ul class="nav nav-tabs">
        <li><a  href="{{ route('students.create') }}">Add</a></li>
        <li class="active"><a href="{{ route('students.import') }}">Import</a></li>
    </ul> 
    <div class="row">
        <div class="col-md-12">
            <div class="panel-body"> 
                {!! Form::open(array('route' => 'students.importFile', 'id' => 'students.importFile', 'class'=>'form-horizontal', 'enctype' => 'multipart/form-data')) !!}
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
                                    {!! csrf_field() !!}
                                    {!! Form::label('Batch:', '', array('class' => 'col-sm-2 control-label')) !!}
                                    <b style='color:red;'>*</b>
                                    <div class="col-sm-4">
                                        {!! Form::text('batch_number',    null  , ['class' => 'form-control required ', 'id' => 'batch_number', 'placeholder' => 'Batch', 'required' => 'true', 'autocomplete' => 'off', 'onkeyup'=>'batchformat()','maxlength' => 9 ]) !!}
                                    </div> 
                                </div>
                        <div class="form-group">
                            {!! csrf_field() !!}
                            {!! Form::label('Name:', '', array('class' => 'col-sm-2 control-label')) !!}
                            <b style='color:red;'>*</b>
                            <div class="col-sm-4">
                            {!! Form::select('class_id', $classes, null, ['class' => 'form-control required','required' => 'true', 'id' => 'class_id', 'onchange'=>'sections()', 'placeholder' => '--Select--'  ]) !!}
                            </div> 
                        </div>
                        <div class="form-group">
                            {!! Form::label('Section:', '', array('class' => 'col-sm-2 control-label')) !!}
                            <b style='color:red;'>*</b>
                            <div class="col-sm-4">
                                    {!! Form::select('section_id',[''=>'--Select--'],null,['class'=>'form-control required','required' => 'true',]) !!} 
                            </div> 
                        </div>
                        <div class="form-group"> 
                        {!! Form::label('Choose Excel File:', '', array('class' => 'col-sm-2 control-label')) !!}
                        
                            <div class="col-sm-4">
                          <input type="file" name="import_file" />
                          </div> 
                        </div>
                        <div class="form-group">
                        <div class="col-md-2"> </div>
                    <div class="col-md-10"> 
                            <button class="btn btn-primary">Import File</button>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!} 
                </div>  
            </div>
            
        </div>
</div>

 <script>
    function sections(){
        class_id = $('#class_id').val(); 
        var token = $("input[name='_token']").val();
        $.ajax({ 
            data: {class_id : class_id,_token : token}, 
            url  : "{{route('ajaxdata.ajaxsections')}}",
            type : 'POST',
            dataType: 'json', 
            success: function(data) {
                
            $("select[name='section_id'").html('');
            $("select[name='section_id'").html(data.options); 
            },     
            error: function(data) {
                console.log(data);
            }
        })     
    }
    function batchformat(){
        var batch = $('#batch_number').val(); 
        var v =batch.length;
        debugger;
        if(v == 4)
        {
            batch = batch + '-' ;
        }
        $('#batch_number').val(batch); 
              
    }
  </script>
  </script>
@stop     