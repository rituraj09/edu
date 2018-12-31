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
        Route::group(['prefix'=>'importclasses'], function() {
            Route::get('/', [
                'as' => 'importclasses.index',   
                'uses' => 'Master\MasterClassController@index'
            ]);   
            Route::get('/create', [
                'as' => 'importclasses.create',     
                'uses' => 'Master\MasterClassController@create'
            ]);   
            Route::post('/importFile', [
                'as' => 'importclasses.importFile',      
                'uses' => 'Master\MasterClassController@importFile'
            ]);
            Route::post('/store', [
                'as' => 'importclasses.store',      
                'uses' => 'Master\MasterClassController@store'
            ]);      
        });   
        //Section ********************************************
        Route::group(['prefix'=>'importsection'], function() {
            Route::get('/', [
                'as' => 'importsection.index',        
                'uses' => 'Master\MasterSectionController@index'
            ]);     
            Route::post('/importFile', [
                'as' => 'importsection.importFile',       
                'uses' => 'Master\MasterSectionController@importFile'
            ]);     
        });  
    }); 


// Route::get('importExport', 'Master/MasterClassController@index');
// Route::get('downloadExcel/{type}', 'Master/MasterClassController@downloadExcel');
// Route::post('importExcel', 'Master/MasterClassController@importExcel');