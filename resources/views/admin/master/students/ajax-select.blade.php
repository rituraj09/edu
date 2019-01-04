<option value="">--Select--</option>
@if(!empty($sections))
  @foreach($sections as $key => $value)
    <option value="{{ $key }}">{{ $value }}</option>
  @endforeach
@endif