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
            <button class="btn btn-xs btn-primary">Edit</button>
            <button class="btn btn-xs btn-danger">Delete</button>
        </td>
        </tr>
    
        @endforeach
        @endif
        </tbody>
        </table> 

        {{ $section->links() }}  