@extends('layout.admin.default') 
@section('page_title', 'Section')
@section('main_content') 

       
<div class="panel panel-body"> 
    <div class="row">
            <div class="col-md-8">
                <div class="panel-body"> 
                    <form  action="{{ url('master/importSectionFile') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
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
                                    
                                <label>Select the Excel File</label>
                                    <input type="file" name="import_file" />
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary">Import File</button>
                                </div>
                        </div>
                        </div>
                    </form> 
                </div>  
            </div>
            <div class="col-md-4"> 
                <?php $i = ($section->currentpage()-1)* $section->perpage(); ?> 
                <table class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                        <tr role="row">
                        <th  style="width: 70px;"> 
                    <centre>Sl.No. </centre> </th>
                        <th>
                       
                    <centre>Section </centre></th>                        
                        <th >
                        <centre>Class </centre> </th>     
                        <th></th>      
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
            
            </div>
        </div>
</div>
@stop     
    