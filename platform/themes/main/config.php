<?php

use Platform\Theme\Theme;

return [

    /*
    |--------------------------------------------------------------------------
    | Inherit from another theme
    |--------------------------------------------------------------------------
    |
    | Set up inherit from another if the file is not exists,
    | this is work with "layouts", "partials" and "views"
    |
    | [Notice] assets cannot inherit.
    |
    */

    'inherit' => null, //default

    /*
    |--------------------------------------------------------------------------
    | Listener from events
    |--------------------------------------------------------------------------
    |
    | You can hook a theme when event fired on activities
    | this is cool feature to set up a title, meta, default styles and scripts.
    |
    | [Notice] these event can be override by package config.
    |
    */

    'events' => [

        // Before event inherit from package config and the theme that call before,
        // you can use this event to set meta, breadcrumb template or anything
        // you want inheriting.
        'before' => function ($theme) {
            // You can remove this line anytime.
        },

        // Listen on event before render a theme,
        // this event should call to assign some assets,
        // breadcrumb template.
        'beforeRenderTheme' => function (Theme $theme) {
            $theme->asset()->add('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css'); //fontawesome
            $theme->asset()->add('fontawesome2', 'https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css'); //fontawesome
            // $theme->asset()->container('after_header')->add('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css'); //bootstrap
            // $theme->asset()->container('after_header')->add('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css');


            $theme->asset()->container('after_header')->usePath()->add('myresponsee', 'templates/css/myresponsee.css');
            $theme->asset()->container('after_header')->usePath()->add('style1', 'templates/css/style.css');
            $theme->asset()->container('after_header')->usePath()->add('common', 'css/common.css');
            $theme->asset()->container('after_header')->usePath()->add('carousel', 'templates/css/owl-carousel/owl.carousel.css');
            $theme->asset()->container('after_header')->usePath()->add('theme', 'templates/css/owl-carousel/owl.theme.css');
            $theme->asset()->container('after_header')->usePath()->add('responsive', 'templates/css/responsive.css');

            $theme->asset()->container('after_header')->usePath()->add('fonts', 'templates/css/fonts.css');
            // $theme->asset()->container('after_header')->usePath()->add('hover', 'templates/css/hover.css');
            // $theme->asset()->container('after_header')->usePath()->add('imagehover', 'templates/css/imagehover.css');
            // $theme->asset()->container('after_header')->usePath()->add('normalize', 'templates/css/normalize.css');

            // $theme->asset()->container('after_header')->usePath()->add('common', 'css/common.css'); //css

            // $theme->asset()->container('footer')->usePath()->add('jquery', 'templates/js/jquery.min.js'); //js
            $theme->asset()->container('footer')->usePath()->add('jquery-3.1.1', 'templates/js/jquery-3.1.1.min.js');
            $theme->asset()->container('footer')->usePath()->add('jquery-1.8.3', 'templates/js/jquery-1.8.3.min.js');
            $theme->asset()->container('footer')->usePath()->add('jquery-ui', 'templates/js/jquery-ui.min.js');
            $theme->asset()->container('footer')->usePath()->add('carousel', 'templates/js/owl-carousel/owl.carousel.js');
            $theme->asset()->container('footer')->usePath()->add('carousel1', 'templates/js/owl-carousel/owl.carousel.min.js');
            $theme->asset()->container('footer')->usePath()->add('custom', 'templates/js/custom.js'); //js
            // $theme->asset()->container('footer')->usePath()->add('script', 'templates/js/script.js'); //js
            $theme->asset()->container('footer')->usePath()->add('jQuery.scrollSpeed', 'templates/js/jQuery.scrollSpeed.js'); //js
            $theme->asset()->container('footer')->usePath()->add('modernizr', 'templates/js/modernizr.js'); //js
            $theme->asset()->container('footer')->usePath()->add('respond', 'templates/js/respond.js'); //js
            $theme->asset()->container('footer')->usePath()->add('responsee', 'templates/js/responsee.js'); //js

            // <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
            // <script type="text/javascript" src="js/jquery-ui.min.js"></script>
            // <script type="text/javascript" src="owl-carousel/owl.carousel.js"></script>
            // <script type="text/javascript" src="js/custom.js"></script>
            // $theme->asset()->container('footer')->add('jqueryboostrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js');
            // $theme->asset()->container('footer')->add('aos.js', 'https://unpkg.com/aos@next/dist/aos.js');
            // $theme->asset()->container('footer')->usePath()->add('common', 'js/common.js'); //js

            if (function_exists('shortcode')) {
                $theme->composer(['index', 'page', 'post'], function (\Platform\Shortcode\View\View $view) {
                    $view->withShortcodes();
                });
            }
        },

        // Listen on event before render a layout,
        // this should call to assign style, script for a layout.
        'beforeRenderLayout' => [

            'default' => function ($theme) {
                // $theme->asset()->usePath()->add('ipad', 'css/layouts/ipad.css');
            }
        ]
    ]
];
