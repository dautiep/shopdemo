<?php

// Custom routes
// You can delete this route group if you don't need to add your custom routes.
use Illuminate\Support\Facades\Route;

Route::get('dang-nhap', 'Platform\Ecommerce\Http\Controllers\Customers\LoginGuestController@index')->middleware('web')->name('guest.login');
Route::post('dang-nhap', 'Platform\Ecommerce\Http\Controllers\Customers\LoginController@login')->middleware('web')->name('login.post');

Route::group(['namespace' => 'Theme\Main\Http\Controllers', 'middleware' => 'customer'], function () {
    Route::get('cart', 'MainController@getCart')->name('public.get-cart');
});

Route::group(['namespace' => 'Theme\Main\Http\Controllers', 'middleware' => 'web'], function () {
    Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {
        //Auth
        Route::get('dang-ky', 'LoginController@getViewregister')->name('guest.register');
        Route::post('dang-ky', 'LoginController@register')->name('guest.post.register');
        Route::get('quen-mat-khau', 'LoginController@forgetPassword')->name('guest.forget.password');
        Route::post('quen-mat-khau', 'LoginController@postForgetPassword')->name('guest.post.forget.password');
        Route::get('dat-lai-mat-khau/{id}', 'LoginController@resetPassword')->name('guest.reset.password');
        Route::post('dat-lai-mat-khau/{id}', 'LoginController@postResetPassword')->name('guest.post.reset.password');

        //cart
        Route::prefix('cart')->group(function () {
            Route::post('add-to-cart', 'CartController@addCart')->name('cart.add');
            Route::group(['middleware' => 'customer'], function () {
                Route::get('', 'CartController@getCart')->name('public.get-cart');
                Route::post('update-cart', 'CartController@updateCart')->name('cart.update');
                Route::post('remove-detail-cart', 'CartController@removeDetailCart')->name('cart.remove-detail');
                Route::get('/checkout', 'CartController@payment')->name('cart.checkout');
                Route::post('/confirm-checkout', 'CartController@createOrder')->name('cart.create.order');
                Route::get('/select-type-payment/{order}', 'CartController@getViewSelectPayment')->name('cart.select.payment');
                Route::post('/payment-ship', 'CartController@paymentShip')->name('cart.payment.ship');
                Route::get('/pay-online-by-vnpay/{order}','CartController@GetPayonline')->name('paymet.Getonline');
                Route::post('/pay-online-by-vnpay','CartController@payOnline')->name('paymet.online');
                Route::get('/VNPay/return','CartController@VNPayreturn')->name('VNPay.return');
            });
        });


        //Get About US:
        Route::get('/ve-chung-toi', 'MainController@getAbout')->name('public.about-us');

        //Get Contact:
        Route::get('/lien-he', 'MainController@getContact')->name('public.get-contact');
        Route::post('/lien-he', "MainController@postContact")->name('contact.post');
        Route::post('/lien-he-shop', 'MainController@contact')->name('post-contact');

        Route::prefix('san-pham')->group(function() {
             Route::get('/', 'MainController@getProduct')->name('product.index');
             Route::get('tim-kiem', 'MainController@searchProduct')->name('product.search');
             Route::get('/{slug}', 'MainController@getProductCategory')->name('product.category');
             Route::get('{slug}/{slugProduct}', 'MainController@getProductDetail')->name('product.detail');
        });

        //tin-tuc
        Route::prefix('tin-tuc')->group(function(){
            Route::get('/', 'MainController@getBlog')->name('get_reset');
            Route::get('tim-kiem', 'MainController@searchBlog')->name('blog.search');
            Route::get('tag/{slug}', 'MainController@getBlogTag')->name('blog.tag');
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
