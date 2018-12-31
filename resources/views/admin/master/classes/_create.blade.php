<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('Ledger Name:', '', array('class' => 'col-sm-3 control-label')) !!}
    <b style='color:red;'>*</b>
    <div class="col-sm-5">
      {!! Form::text('name',    null  , ['class' => 'form-control required ', 'id' => 'name', 'placeholder' => 'Ledger Name', 'required' => 'true', ]) !!}
    </div>
    {!! $errors->first('name', '<span class="help-inline">:message</span>') !!}
</div>