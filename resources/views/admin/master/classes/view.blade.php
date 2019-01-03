<?php $i = ($classes->currentpage()-1)* $classes->perpage(); ?> 
            <table class="table table-bordered table-hover  no-footer"> 
                <tr role="row">
                <th  style="width: 70px;"> 
                    <centre>Sl.No. </centre>
                </th>
                <th>
                <centre>Class </centre></th> 
                <th></th>     
                @if(count($classes) > 0)
                @foreach($classes as $class) 
                <?php   $i++;?>
                <tr>
                <td align="center">
                <?php echo $i;?>
                </td>
                <td align="center">
                {{$class->name}}
                </td> 
                <td align="center">
                        {!! Form::open([ 'method' => 'POST', 'route' => ['classes.destroy', $class->id],  'onsubmit' => 'return confirmDelete()' ]) !!}
                      
                        <a href="{{route('classes.edit', ['id'=>Crypt::encrypt($class->id)]) }}" data-toggle="tooltip" class="btn btn-primary btn-xs" title="Edit">Edit</a>
                        <button  data-toggle="tooltip" class=" btn btn-danger btn-xs"  title="Delete!">Delete</button>
                        {!! Form::close() !!}
                        
                </td>
                </tr> 
                @endforeach
                @endif 
                </table>  
      
                {{ $classes->links() }}
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