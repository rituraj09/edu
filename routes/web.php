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

Route::group(['prefix'=>'master'], function() {
    //Class********************************************
    Route::group(['prefix'=>'importclasses'], function() {
        Route::get('/', [
            'as' => 'importclasses.index', 
            'uses' => 'Master\MasterClassController@index'
        ]);     
    }); 
    Route::group(['prefix'=>'importClassFile'], function() {
        Route::post('/', [
            'as' => 'importClass.importExcel', 
            'uses' => 'Master\MasterClassController@importExcel'
        ]);     
    });  
    //Section ********************************************
    Route::group(['prefix'=>'importsection'], function() {
        Route::get('/', [
            'as' => 'importsection.index', 
            'uses' => 'Master\MasterSectionController@index'
        ]);     
    }); 
    Route::group(['prefix'=>'importSectionFile'], function() {
        Route::post('/', [
            'as' => 'importSection.importExcel', 
            'uses' => 'Master\MasterSectionController@importExcel'
        ]);     
    });  
}); 


// Route::get('importExport', 'Master/MasterClassController@index');
// Route::get('downloadExcel/{type}', 'Master/MasterClassController@downloadExcel');
// Route::post('importExcel', 'Master/MasterClassController@importExcel');