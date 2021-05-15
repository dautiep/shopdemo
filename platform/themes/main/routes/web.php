<?php

// Custom routes
// You can delete this route group if you don't need to add your custom routes.
Route::group(['namespace' => 'Theme\Main\Http\Controllers', 'middleware' => 'web'], function () {
    Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {
        //Get About US:
        Route::get('/about-us', 'MainController@getAbout')
            ->name('public.about-us');
        //Get Blog:
        Route::get('/blog', 'MainController@getBlog')
            ->name('public.blog');
        //Get Blog-post:
        Route::get('/blog-post', 'MainController@getBlogPost')
            ->name('public.blog-post');
        //Get Cart:
        Route::get('/cart', 'MainController@getCart')
            ->name('public.get-cart');
        //Get Contact:
        Route::get('/contact', 'MainController@getContact')
            ->name('public.get-contact');
        //Get Product:
        Route::get('/product', 'MainController@getProduct')
            ->name('public.get-product');
        //Get Product Detail:
        Route::get('/product-detail', 'MainController@getProductDetail')
            ->name('public.get-product-detail');
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
