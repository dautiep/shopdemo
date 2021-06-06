<?php

Route::group(['namespace' => 'Platform\Cart\Http\Controllers', 'middleware' => ['web', 'core']], function () {

    Route::group(['prefix' => BaseHelper::getAdminPrefix(), 'middleware' => 'auth'], function () {

        Route::group(['prefix' => 'carts', 'as' => 'cart.'], function () {
            Route::resource('', 'CartController')->parameters(['' => 'cart']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'CartController@deletes',
                'permission' => 'cart.destroy',
            ]);
        });
    });

});
