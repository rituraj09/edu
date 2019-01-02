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
                        <a href="{{route('importclasses.edit', ['id'=>Crypt::encrypt($class->id)]) }}" data-toggle="tooltip" class="btn btn-primary btn-xs" title="Edit">Edit</a>
                  
                    <button class="btn btn-xs btn-danger">Delete</button>
                </td>
                </tr> 
                @endforeach
                @endif 
                </table>  
      
                {{ $classes->links() }}
        