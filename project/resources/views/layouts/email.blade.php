<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', isset($title) ? $title.' - '.$site_name : 'Email Title - '.$site_name)</title>
    <style>
        html, body {
            font-family: 'Railwey', sans-serif;
            background-color: #eaeaea;
        }

        .card {
            margin: 2rem auto;
            padding: 16px;
            max-width: 90%;
            background-color: #fff;
            border-radius: 4px;
        }

        @media screen and (min-width: 768px) {
            .card {
                max-width: 70%;
            }
        }

        @media screen and (min-width: 1200px) {
            .card {
                max-width: 60%;
            }
        }

        .card-header {
            padding-bottom: 16px;
            border-bottom: 1px solid #cccccc;
            text-align: center;
        }

        .card-header .title {
            margin: 0;
            font-size: 32px;
            line-height: 38px;
            color: #333;
        }

        .card-content {
            padding: 32px 0;
            display: block;
        }

        .card-footer {
            padding-top: 16px;
            border-top: 1px solid #cccccc;
            text-align: center;
        }

        .card-footer .copyright-text {
            font-size: 14px;
            line-height: 24px;
            color: #666666;
        }

        .card-footer .copyright-link {
            color: inherit;
            font-weight: bold;
            text-decoration: none;
            transition: .5s;
        }

        .card-footer .copyright-link:hover {
            color: #F05340;
        }

        .card-footer .copyright-logo {
            margin-top: 12px;
        }

        .m-0 {
            margin: 0 !important;
        }

        .m-auto {
            margin: auto !important;
        }

        .text-start {
            text-align: left !important;
        }

        .text-end {
            text-align: right !important;
        }

        .text-center {
            text-align: center !important;
        }

        .btn {
            display: inline-block;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        @media (prefers-reduced-motion: reduce) {
            .btn {
                transition: none;
            }
        }

        .btn:hover {
            color: #212529;
        }

        .btn-check:focus + .btn, .btn:focus {
            outline: 0;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .btn:disabled, .btn.disabled, fieldset:disabled .btn {
            pointer-events: none;
            opacity: 0.65;
        }

        .btn-black {
            color: #fff;
            background-color: #212529;
            border-color: #212529;
        }

        .btn-black:hover {
            color: #fff;
            background-color: #343a42;
            border-color: #363e44;
        }

        .btn-check:focus + .btn-black, .btn-black:focus {
            color: #fff;
            background-color: #1c1f23;
            border-color: #1a1e21;
            box-shadow: 0 0 0 0.25rem rgba(66, 70, 73, 0.5);
        }

        .btn-check:checked + .btn-black, .btn-check:active + .btn-black, .btn-black:active, .btn-black.active, .show > .btn-black.dropdown-toggle {
            color: #fff;
            background-color: #1a1e21;
            border-color: #191c1f;
        }

        .btn-check:checked + .btn-black:focus, .btn-check:active + .btn-black:focus, .btn-black:active:focus, .btn-black.active:focus, .show > .btn-black.dropdown-toggle:focus {
            box-shadow: 0 0 0 0.25rem rgba(66, 70, 73, 0.5);
        }

        .btn-black:disabled, .btn-black.disabled {
            color: #fff;
            background-color: #212529;
            border-color: #212529;
        }

        .btn-outline-black {
            color: #212529;
            border-color: #212529;
        }

        .btn-outline-black:hover {
            color: #fff;
            background-color: #212529;
            border-color: #212529;
        }

        .btn-check:focus + .btn-outline-black, .btn-outline-black:focus {
            box-shadow: 0 0 0 0.25rem rgba(33, 37, 41, 0.5);
        }

        .btn-check:checked + .btn-outline-black, .btn-check:active + .btn-outline-black, .btn-outline-black:active, .btn-outline-black.active, .btn-outline-black.dropdown-toggle.show {
            color: #fff;
            background-color: #212529;
            border-color: #212529;
        }

        .btn-check:checked + .btn-outline-black:focus, .btn-check:active + .btn-outline-black:focus, .btn-outline-black:active:focus, .btn-outline-black.active:focus, .btn-outline-black.dropdown-toggle.show:focus {
            box-shadow: 0 0 0 0.25rem rgba(33, 37, 41, 0.5);
        }

        .btn-outline-black:disabled, .btn-outline-black.disabled {
            color: #212529;
            background-color: transparent;
        }
    </style>
    @yield("head")
</head>
<body>
<div class="card">
    <div class="card-header">
        <h1 class="title">{{ $title ?? '' }}</h1>
    </div>
    <div class="card-content">
        @yield("content")
    </div>
    <div class="card-footer">
        <div class="copyright-text">
            This mail sent by <a href="{{ route('home') }}" class="copyright-link" target="_blank"
                                 rel="nofollow">{{ $site_name }}</a>
        </div>
        <div class="copyright-logo">
            <a href="{{ route('home') }}" class="copyright-link" target="_blank" rel="nofollow">
                <img src="{{ asset($site_logo) }}" width="88" height="25" alt="{{ $site_name }}">
            </a>
        </div>
    </div>
</div>
</body>
</html>
