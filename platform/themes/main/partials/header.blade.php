<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=1"
        name="viewport" />

    {!! Theme::header() !!}
</head>

<body class="size-1140" @if (class_exists('Language', false) && Language::getCurrentLocaleRTL()) dir="rtl" @endif>
    <script>
         var contact = "{{route('post-contact')}}";
    </script>
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
                            <li><a href="{!! theme_option('link_instagram') !!}"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="{!! theme_option('link_FB') !!}"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="{!! theme_option('link_linkedin') !!}"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="{!! theme_option('link_twitter') !!}"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="{!! theme_option('link_gmail') !!}"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="{!! theme_option('link_youtobe') !!}"><i class="fa fa-youtube"></i></a></li>
                            {{-- <li class="hide-s"><a href="#"><i class="fa fa-pinterest"></i></a></li> --}}
                        </ul>
                    </div>
                    <!-- contact details -->
                    <div class="l-6 hide-s hide-m line-right">
                        <div class="right">
                            <ul class="topbar-menu">
                                <li class="topbar-menu-item">
                                    @if (!empty(auth('customer')->user()))
                                        <span class="number-cart">
                                            {{ auth('customer')->user()->getCart->getDetailcart->count() }}
                                        </span>
                                    @else
                                        <span class="number-cart">
                                            0
                                        </span>
                                    @endif
                                    <a href="{{ route('public.get-cart') }}">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </li>
                                @if (!empty(auth('customer')->user()))
                                    <li><a href="javascript:void(0)">Xin chào {{ auth('customer')->user()->name }}</a></li>
                                    <li><a  href="{{ route('customer.logout') }}">Đăng xuất</a></li>
                                @else
                                    <li><a href="{{ route('guest.login') }}">Đăng nhập</a></li>
                                @endif
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
                        {!!
                            Menu::renderMenuLocation('header-menu-desktop', [
                                'options' => [],
                                'theme' => true,
                                'view' => 'nav-bar',
                            ])
                        !!}
                    </div>

                </div>
            </nav>
        </header>
        <!-- HEADER END -->
