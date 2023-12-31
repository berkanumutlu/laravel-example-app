<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Laravel Example App">
    <meta name="keywords" content="web,laravel, laravel example app">
    <meta name="author" content="Berkan Ümütlü">
    <title>{{ isset($title) ? $title . ' - '.$site_name : $site_name }}</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ $favicon }}"/>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ $favicon }}"/>
    @yield("head")
    <link href="{{ asset('assets/web/css/fonts/font.min.css') }}" rel="stylesheet">
    <link href="{{ asset("assets/plugins/material-icons/iconfont/material-icons.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/plugins/fontawesome/css/all.min.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/plugins/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/web/css/style.min.css") }}" rel="stylesheet">
    @yield("style")
</head>
<body>
<header>
    <div class="container">
        <div class="header-top">
            <div class="row align-items-center">
                <div class="col-lg-2">
                    <div class="header-logo">
                        <a href="{{ route('home') }}" class="header-logo-link">
                            @if(!empty($site_image))
                                <img src="{{ $site_image }}" class="img-fluid" alt="{{ $site_name }} Logo">
                            @else
                                <img src="{{ asset('assets/web/images/logomark.min.svg') }}" class="img-fluid"
                                     alt="{{ $site_name }} Logo">
                                <img src="{{ asset('assets/web/images/logotype.min.svg') }}" class="img-fluid ms-4"
                                     alt="{{ $site_name }} Logo Text">
                            @endif
                        </a>
                    </div>
                </div>
                <div class="col-lg-8 d-none d-md-block">
                    <div class="header-text">
                        <p class="text-center text-secondary fst-italic">{!! $settings->text_header ?? '' !!}</p>
                    </div>
                </div>
                <div class="col-lg-2 d-none d-lg-block">
                    <div class="header-search">
                        <x-web.search-group></x-web.search-group>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand d-none" href="#">{{ $site_name }}</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" aria-current="page"
                               href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('article.index') ? 'active' : '' }}"
                               href="{{ route('article.index') }}">Articles</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 user-actions-navbar">
                        @if(auth()->guard('web')->check())

                        @else
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('register') ? 'active' : '' }}"
                                   href="{{ route('register') }}">
                                    <span class="material-icons-outlined me-1">person_add</span>Register</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span class="material-icons-outlined me-1">login</span>Login</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </nav>
            <x-web.search-group :class="'d-lg-none'"></x-web.search-group>
        </div>
    </div>
</header>
@yield("content")
<footer class="container-fluid">
    <div class="container text-center">
        <p class="mb-0">Copyright © 2023 Berkan Ümütlü. All Right Reserved.</p>
    </div>
</footer>
<script src="{{ asset('assets/plugins/jquery/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
@include('sweetalert::alert')
<script src="{{ asset('assets/web/js/main.js') }}"></script>
@yield("scripts")
</body>
</html>
