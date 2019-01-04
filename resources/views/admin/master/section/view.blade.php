<?php $i = ($section->currentpage()-1)* $section->perpage(); ?> 
<table class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
        <tr role="row">
        <th  style="width: 60px;"> 
    <centre>Sl.No. </centre> </th>
        <th style="width: 100px;">
       
    <centre>Section </centre></th>                        
        <th  style="width: 100px;">
        <centre>Class Under </centre> </th>     
        <th style="width: 120px;"></th>      
        </thead>
        <tbody>
        @if(count($section) > 0)
        @foreach($section as $sections) 
        <?php   $i++;?>
        <tr>
        <td align="center">
        <?php echo $i;?>
        </td>
        <td align="center">
        {{$sections->name}}
        </td> 
        <td align="center">
        {{$sections->classes->name}}
        </td> 
        <td align="center">
        {!! Form::open([ 'method' => 'POST', 'route' => ['sections.destroy', $sections->id],  'onsubmit' => 'return confirmDelete()' ]) !!}
                      
                        <a href="{{route('sections.edit', ['id'=>Crypt::encrypt($sections->id)]) }}" data-toggle="tooltip" class="btn btn-primary btn-xs" title="Edit">Edit</a>
                        <button  data-toggle="tooltip" class=" btn btn-danger btn-xs"  title="Delete!">Delete</button>
                        {!! Form::close() !!} 
        </td>
        </tr>
    
        @endforeach
        @endif
        </tbody>
        </table> 

        {{ $section->links() }}  

        <script>
                function confirmDelete() {    
                    if (confirm("Are you sure to Delete the Record!!")) {
                        return true;
                    }
                    else {
                        return false;
                    } 
                  }
                </script>