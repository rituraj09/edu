<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
    //Class********************************************  
    Route::group(['prefix'=>'master'], function() {
        Route::group(['prefix'=>'classes'], function() {
            Route::get('/import', [
                'as' => 'classes.import',   
                'uses' => 'Master\MasterClassController@index'
            ]);   
            Route::get('/create', [
                'as' => 'classes.create',     
                'uses' => 'Master\MasterClassController@create'
            ]);   
            Route::post('/importFile', [
                'as' => 'classes.importFile',      
                'uses' => 'Master\MasterClassController@importFile'
            ]);
            Route::post('/store', [
                'as' => 'classes.store',      
                'uses' => 'Master\MasterClassController@store'
            ]);    
            Route::post('/destroy/{id}', [
                'as' => 'classes.destroy', 
                'uses' => 'Master\MasterClassController@destroy'
            ]);
            Route::get('/edit/{id}', [
                'as' => 'classes.edit', 
                'uses' => 'Master\MasterClassController@edit'
            ]);
            Route::post('/update/{id}', [
                'as' => 'classes.update', 
                'uses' => 'Master\MasterClassController@update'
            ]);  
        });   
        //Section ********************************************
        Route::group(['prefix'=>'sections'], function() {
            Route::get('/import', [
                'as' => 'sections.import',        
                'uses' => 'Master\MasterSectionController@index'
            ]);     
            Route::get('/create', [
                'as' => 'sections.create',     
                'uses' => 'Master\MasterSectionController@create'
            ]);   
            Route::post('/importFile', [
                'as' => 'sections.importFile',      
                'uses' => 'Master\MasterSectionController@importFile'
            ]);
            Route::post('/store', [
                'as' => 'sections.store',      
                'uses' => 'Master\MasterSectionController@store'
            ]);    
            Route::post('/destroy/{id}', [
                'as' => 'sections.destroy', 
                'uses' => 'Master\MasterSectionController@destroy'
            ]);
            Route::get('/edit/{id}', [
                'as' => 'sections.edit', 
                'uses' => 'Master\MasterSectionController@edit'
            ]);
            Route::post('/update/{id}', [
                'as' => 'sections.update', 
                'uses' => 'Master\MasterSectionController@update'
            ]);      
        });  

          //Students ********************************************
          Route::group(['prefix'=>'students'], function() {
            Route::get('/import', [
                'as' => 'students.import',        
                'uses' => 'Master\StudentController@index'
            ]);     
            Route::get('/create', [
                'as' => 'students.create',     
                'uses' => 'Master\StudentController@create'
            ]);   
            Route::post('/importFile', [
                'as' => 'students.importFile',      
                'uses' => 'Master\StudentController@importFile'
            ]);
            Route::post('/store', [
                'as' => 'students.store',      
                'uses' => 'Master\StudentController@store'
            ]);    
            Route::post('/destroy/{id}', [
                'as' => 'students.destroy', 
                'uses' => 'Master\StudentController@destroy'
            ]);
            Route::get('/edit/{id}', [
                'as' => 'students.edit', 
                'uses' => 'Master\StudentController@edit'
            ]);
            Route::post('/update/{id}', [
                'as' => 'students.update', 
                'uses' => 'Master\StudentController@update'
            ]); 
            Route::get('/', [
                'as' => 'students.view',        
                'uses' => 'Master\StudentController@classview'
            ]); 
            Route::get('/details/{id}', [
                'as' => 'students.details',        
                'uses' => 'Master\StudentController@view'
            ]); 
            Route::get('/show/{id}', [
                'as' => 'students.show', 
                'uses' => 'Master\StudentController@show'
            ]);      
        });  
    }); 


    Route::post('ajaxdata/ajaxsections', 'AjaxController@ajaxsections')->name('ajaxdata.ajaxsections');
// Route::get('importExport', 'Master/MasterClassController@index');
// Route::get('downloadExcel/{type}', 'Master/MasterClassController@downloadExcel');
// Route::post('importExcel', 'Master/MasterClassController@importExcel');