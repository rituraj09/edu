<html lang="en">
<head>
    <title>Import</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >
    <style>
    .row
    {
        margin-right: 0px !important;
        margin-left: 0px !important;
    }
</style>
</head>
<body>
    <div class="container">
        <div class="panel panel-default">
          <div class="panel-heading">
          <h1>Import Sections</h1>
          </div>
          <div class="row">
          <div class="row">
                <div class="col-md-4">
                <div class="panel-body"> 
                    <form  action="{{ url('master/importSectionFile') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                        @csrf 
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
                        <div class="row" >      
                            <div class="col-md-12"> 
                                <div class="form-group">
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
                <div class="col-md-8"> 
                <?php $i = ($section->currentpage()-1)* $section->perpage(); ?> 
                <table class="table table-striped table-bordered table-hover dataTable no-footer">
                            <thead>
                            <tr role="row">
                            <th  style="width: 70px;"> Sl.No. </th>
                            <th  width="100px" >
                            Section</th>                        
                            <th  width="100px" >
                            Class</th>      
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
                            </tr>
                        
                            @endforeach
                            @endif
                            </tbody>
                            </table> 
                    
                            {{ $section->links() }} 
                
                </div>
            </div>
          </div>
        </div>
    </div>
</body>
</html>