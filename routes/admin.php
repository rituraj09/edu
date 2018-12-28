
<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('employee')->user(); 
})->name('home');


//  Master========================================================
Route::group(['prefix'=>'master'], function() {
    Route::group(['prefix'=>'accounthead'], function() {
        Route::get('/', [
            'as' => 'accounthead.index',
            'middleware' => ['employee'],
            'uses' => 'Accounting\Master\AccountGroupsController@index'
        ]);    
        Route::get('/create', [
            'as' => 'accounthead.create',
            'middleware' => ['employee'],
            'uses' => 'Accounting\Master\AccountGroupsController@create'
        ]);       
        Route::post('/store', [
            'as' => 'accounthead.store',
            'middleware' => ['employee'],
            'uses' => 'Accounting\Master\AccountGroupsController@store'
        ]); 
        Route::post('/destroy/{id}', [
            'as' => 'accounthead.destroy',
            'middleware' => ['employee'],
            'uses' => 'Accounting\Master\AccountGroupsController@destroy'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'accounthead.edit',
            'middleware' => ['employee'],
            'uses' => 'Accounting\Master\AccountGroupsController@edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'accounthead.update',
            'middleware' => ['employee'],
            'uses' => 'Accounting\Master\AccountGroupsController@update'
        ]);
    });

 
}); 
