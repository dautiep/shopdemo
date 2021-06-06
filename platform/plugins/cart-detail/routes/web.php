<?php

Route::group(['namespace' => 'Platform\CartDetail\Http\Controllers', 'middleware' => ['web', 'core']], function () {

    Route::group(['prefix' => BaseHelper::getAdminPrefix(), 'middleware' => 'auth'], function () {

        Route::group(['prefix' => 'cart-details', 'as' => 'cart-detail.'], function () {
            Route::resource('', 'CartDetailController')->parameters(['' => 'cart-detail']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'CartDetailController@deletes',
                'permission' => 'cart-detail.destroy',
            ]);
        });
    });

});
