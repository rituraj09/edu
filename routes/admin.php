
<?php

/*Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('employee')->user(); 
})->name('home');*/

    //Class********************************************  
Route::group(['prefix'=>'master'], function() {
    Route::group(['prefix'=>'importclasses'], function() {
        Route::get('/', [
            'as' => 'importclasses.index',             
            'middleware' => ['admin'],
            'uses' => 'Master\MasterClassController@index'
        ]);   
        Route::get('/create', [
            'as' => 'importclasses.create',        
            'middleware' => ['admin'],
            'uses' => 'Master\MasterClassController@create'
        ]);   
        Route::post('/importFile', [
            'as' => 'importclasses.importFile',        
            'middleware' => ['admin'],
            'uses' => 'Master\MasterClassController@importFile'
        ]);     
    });   
    //Section ********************************************
    Route::group(['prefix'=>'importsection'], function() {
        Route::get('/', [
            'as' => 'importsection.index',        
            'middleware' => ['admin'],
            'uses' => 'Master\MasterSectionController@index'
        ]);     
        Route::post('/importFile', [
            'as' => 'importsection.importFile',        
            'middleware' => ['admin'],
            'uses' => 'Master\MasterSectionController@importFile'
        ]);     
    });  
}); 

 