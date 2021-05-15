<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=1"
        name="viewport" />

    {!! Theme::header() !!}
</head>

<body class="size-1140" @if (class_exists('Language', false) && Language::getCurrentLocaleRTL()) dir="rtl" @endif>
    <!-- HIDDEN PRODUCTS MENU START -->
    <div id="page-main-content">
        <!-- HEADER START -->
        <header>
            <!-- top bar start -->
            <div id="topbar-primary" class="background-primary">
                <div class="line">
                    <!-- social icons -->
                    <div class="s-12 m-12 l-6">
                        <ul>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                            <li class="hide-s"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        </ul>
                    </div>
                    <!-- contact details -->
                    <div class="l-6 hide-s hide-m line-right">
                        <div class="right">
                            <ul class="topbar-menu">
                                <li class="topbar-menu-item">
                                    <span class="number-cart">
                                        0
                                    </span>
                                    <a href="#">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </li>
                                <li><a href="#">info@website.com</a></li>
                                <li><a href="#">+971 123 456 789</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- top bar end -->

            <!-- navigation and logo -->
            <nav class="background-dark">
                <div class="line">
                    <!-- logo -->
                    <div class="s-12 l-3">
                        <div class="fullwidth">
                            <a href="{{ route('public.index') }}" class="logo"><img
                                    src="{{ Theme::asset()->url('img/logo.png') }}" alt=""></a>
                        </div>
                    </div>

                    <!-- navigation -->
                    <div class="top-nav s-12 m-12 l-9">
                        <a class="nav-text"></a>
                        <ul class="right chevron">
                            <li><a class="hvr-sweep-to-bottom">Home</a>
                                <ul>
                                    <li><a href="{{ route('public.index') }}" class="hvr-sweep-to-bottom">Home Page
                                        </a></li>
                                </ul>
                            </li>
                            <li><a href="{{ route('public.get-product') }}" class="hvr-sweep-to-bottom">Product</a>
                                <ul>
                                    <li><a href="{{ route('public.get-product-detail') }}"
                                            class="hvr-sweep-to-bottom">Product-Detail</a></li>
                            </li>
                        </ul>
                        </li>
                        <li><a class="hvr-sweep-to-bottom">Design One</a>
                            <ul>
                                <li><a href="{{ route('public.about-us') }}" class="hvr-sweep-to-bottom">About
                                        Us</a></li>
                                <li><a href="{{ route('public.get-contact') }}" class="hvr-sweep-to-bottom">Contact
                                        Us</a></li>
                                <li><a href="{{ route('public.get-product') }}" class="hvr-sweep-to-bottom">Products
                                        Category</a></li>
                                <li><a href="{{ route('public.get-product-detail') }}"
                                        class="hvr-sweep-to-bottom">Product Detail</a></li>
                                <li><a href="{{ route('public.get-cart') }}" class="hvr-sweep-to-bottom">Cart</a>
                                </li>
                                <li><a href="{{ route('public.blog') }}" class="hvr-sweep-to-bottom">Blog</a></li>
                                <li><a href="{{ route('public.blog-post') }}" class="hvr-sweep-to-bottom">Blog
                                        Post</a></li>
                                <li><a href="{{ route('public.get-cart') }}" class="hvr-sweep-to-bottom">Page Not
                                        Found</a>
                                </li>
                            </ul>
                        </li>
                    </div>

                </div>
            </nav>
        </header>
        <!-- HEADER END -->
