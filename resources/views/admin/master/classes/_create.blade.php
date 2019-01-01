<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('Class Name:', '', array('class' => 'col-sm-2 control-label')) !!}
    <b style='color:red;'>*</b>
    <div class="col-sm-5">
      {!! Form::text('name',    null  , ['class' => 'form-control required ', 'id' => 'name', 'placeholder' => 'Class Name', 'required' => 'true', 'autocomplete' => 'off' ]) !!}
    </div>
    {!! $errors->first('name', '<span class="help-inline">:message</span>') !!}
</div>
<script>     
        function validateForm(){
            var textbox1 = document.getElementById("name").value;
            if(textbox1==''){ 
                $("#name").focus(); 
                alert('Class Name is empty!');
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