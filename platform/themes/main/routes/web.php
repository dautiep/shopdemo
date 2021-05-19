<?php

// Custom routes
// You can delete this route group if you don't need to add your custom routes.


use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Theme\Main\Http\Controllers', 'middleware' => 'web'], function () {
    Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {
        //Get About US:
        Route::get('/ve-chung-toi', 'MainController@getAbout')
            ->name('public.about-us');


     
      

        //Get Cart:
        Route::get('/cart', 'MainController@getCart')
            ->name('public.get-cart');
        //Get Contact:
        Route::get('/lien-he', 'MainController@getContact')
            ->name('public.get-contact');
        
            Route::prefix('san-pham')->group(function() {
             Route::get('{slug}', 'MainController@getProduct')->name('product.category');
             Route::get('{slug}/{slugPost}', 'MainController@getproductdetail')->name('product.detail');
        });
            //Get Product Detail:
        //     //Get Product:
        //     Route::get('/product', 'MainController@getProduct')
        //         ->name('public.get-product');
        // Route::get('/product-detail', 'MainController@getProductDetail')
        //     ->name('public.get-product-detail');
        //        //Get Blog:
        Route::prefix('tin-tuc')->group(function(){
            Route::get('/', 'MainController@getBlog')->name('get_reset');
           
        });
      

        Route::prefix('tin-tuc')->group(function() {
             Route::get('{slug}/{slugPost}', 'MainController@getBlogDetail')->name('blog.detail');
        });
    });
});

Theme::routes();

Route::group(['namespace' => 'Theme\Main\Http\Controllers', 'middleware' => 'web'], function () {
    Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {

        Route::get('/', 'MainController@index')
            ->name('public.index');

        Route::get('sitemap.xml', 'MainController@getSiteMap')
            ->name('public.sitemap');

        Route::get('{slug?}' . config('core.base.general.public_single_ending_url'), 'MainController@getView')
            ->name('public.single');
    });
});
