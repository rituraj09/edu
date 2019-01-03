<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
        {!! Form::label('Section Name:', '', array('class' => 'col-sm-3 control-label')) !!}
        <b style='color:red;'>*</b>
        <div class="col-sm-4">
          {!! Form::text('name',    null  , ['class' => 'form-control required ', 'id' => 'name', 'placeholder' => 'Section Name', 'required' => 'true', 'autocomplete' => 'off' ]) !!}
        </div>
        {!! $errors->first('name', '<span class="help-inline">:message</span>') !!}
    </div>
    <div class="form-group {{ $errors->has('class_id') ? 'has-error' : ''}}">
            {!! Form::label('Class Under:', '', array('class' => 'col-sm-3 control-label')) !!}
            <b style='color:red;'>*</b>
            <div class="col-sm-4">
                {!! Form::select('class_id', $classes, null, ['class' => 'form-control required', 'id' => 'class_id', 'placeholder' => '--Select--', ]) !!}
            </div> 
            {!! $errors->first('class_id', '<span class="help-inline">:message</span>') !!}
        </div>
    <script>     
            function validateForm(){
                var textbox1 = document.getElementById("name").value;
                var textbox3 = document.getElementById('class_id').value;;
                if(textbox1==''){ 
                    $("#name").focus(); 
                    alert('Class Name is empty!');
                    return false;
                }
                if(textbox3==''){ 
                    $("#class_id").focus(); 
                    alert('Select Class Under!');
                    return false;
                } 
                if(confirm("Are you sure to Save the Record!!")) {
                    return true;
                }
                else{
                  return false;
                } 
            }
    </script>