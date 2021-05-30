<?php

// Custom routes
// You can delete this route group if you don't need to add your custom routes.


use Illuminate\Support\Facades\Route;


Route::group([
    'namespace'  => 'Platform\Ecommerce\Http\Controllers\Customers',
    'middleware' => ['web', 'core', 'customer.guest'],
], function () {
    Route::get('dang-nhap', 'LoginGuestController@index')->name('guest.login');
    Route::post('dang-nhap', 'LoginGuestController@login')->name('login.post');
});

Route::group(['namespace' => 'Theme\Main\Http\Controllers', 'middleware' => 'web'], function () {
    Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {
        //Auth
        // Route::get('dang-nhap', 'LoginController@getViewLogin')->name('guest.login');
        Route::get('dang-ky', 'LoginController@getViewregister')->name('guest.register');
        Route::post('dang-ky', 'LoginController@register')->name('guest.post.register');

        //Get About US:
        Route::get('/ve-chung-toi', 'MainController@getAbout')->name('public.about-us');

        //Get Cart:
        Route::get('/cart', 'MainController@getCart')->name('public.get-cart');

        //Get Contact:
        Route::get('/lien-he', 'MainController@getContact')->name('public.get-contact');
        Route::post('/lien-he-shop', 'MainController@contact')->name('post-contact');

        Route::prefix('san-pham')->group(function() {
             Route::get('/', 'MainController@getProduct');
             Route::get('/{slug}', 'MainController@getProductCategory')->name('product.category');
             Route::get('{slug}/{slugProduct}', 'MainController@getProductDetail')->name('product.detail');
        });

        Route::prefix('tin-tuc')->group(function(){
            Route::get('/', 'MainController@getBlog')->name('get_reset');
            Route::get('{slug}', 'MainController@getBlogCategory')->name('blog.category');
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
