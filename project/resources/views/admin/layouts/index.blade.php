<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="Berkan Ümütlü">
    <meta name="csrf_token" content="{{ csrf_token() }}"/>
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- Title -->
    <title>@yield('title', isset($title) ? $title . ' - Admin Panel' : 'Admin Panel - Laravel Example App')</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ $favicon }}"/>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ $favicon }}"/>
    @yield("head")
    <!-- Fonts -->
    <link href="{{ asset('assets/admin/css/fonts/poppins.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/fonts/montserrat.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/fonts/materialicons.min.css') }}" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/perfectscroll/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/pace/pace.css') }}" rel="stylesheet">
    <!-- Theme Styles -->
    <link href="{{ asset('assets/admin/css/main.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/custom.min.css') }}" rel="stylesheet">
    @yield("style")
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="app align-content-stretch d-flex flex-wrap">
    @include("components.admin.sidebar")
    <div class="app-container">
        @if(!empty($search_form))
            @include("components.admin.search")
        @endif
        @include("components.admin.header")
        <div class="app-content">
            <div class="content-wrapper">
                <div class="container">
                    @yield("content")
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Javascripts -->
<script src="{{ asset('assets/plugins/jquery/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/perfectscroll/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pace/pace.min.js') }}"></script>
@include('sweetalert::alert')
<script src="{{ asset('assets/admin/js/main.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/custom.js') }}"></script>
@yield("scripts")
</body>
</html>
