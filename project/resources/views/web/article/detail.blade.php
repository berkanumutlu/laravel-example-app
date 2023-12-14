@extends("web.layouts.index")
@section("style")
    <link href="{{ asset('assets/web/css/components/sidebar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/web/css/pages/articles.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/aos/aos.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/highlight/styles/default.min.css') }}" rel="stylesheet">
@endsection
@section("content")
    <main class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-xl-9">
                    <section class="article-detail" data-aos="zoom-in-right">
                        <div class="article-header">
                            <h1 class="title">{{ $record->title ?? '' }}</h1>
                            <ul class="meta">
                                <li class="author">by <a href="#">{{ $record->user?->name }}</a></li>
                                <li class="date">
                                    <time datetime="26-11-2023 20:00">{{ $record->publish_date ?? '' }}</time>
                                </li>
                                <li class="favorite-count">
                                    <a href="#" class="btn btn-favorite"><span class="material-icons-outlined">favorite_border</span></a>
                                    <span class="number">{{ $record->like_count ?? 0 }}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="article-content">
                            <div class="text">
                                @if(!empty($record->image))
                                    <div class="d-flex justify-content-center mb-3">
                                        <img src="{{ asset($record->image) }}" class="img-fluid w-75"
                                             alt="{{ $record->title ?? '' }}">
                                    </div>
                                @endif
                                {!! $record->body ?? '' !!}
                            </div>
                        </div>
                    </section>
                    <div class="article-detail-bottom" data-aos="fade-up">
                        <div class="tag-share-wrap">
                            <div class="tag-wrap">
                                <h4 class="mb-2">Tags:</h4>
                                @if(!empty($record->tags))
                                    <div class="tag-list">
                                        <ul class="nav list-unstyled">
                                            @foreach($record->tags as $item)
                                                <li class="tag-item"><a href="#">{{ $item }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="share-wrap">
                                <h4 class="mb-2">Share:</h4>
                            </div>
                        </div>
                    </div>
                    <section class="author" data-aos="fade-up">
                        <div class="author-card">
                            <div class="author-thumb">
                                <img width="180" height="180" src="{{ asset($record->user?->image) }}"
                                     alt="Author Image">
                            </div>
                            <div class="author-content">
                                <h4 class="name">{{ $record->user?->name ?? '' }}</h4>
                                <div class="designation">{{ $record->user?->title ?? '' }}</div>
                                <p class="description">{{ $record->user?->description ?? '' }}</p>
                                <div class="socials">
                                    <ul>
                                        <li class="github">
                                            <a aria-label="Learn more from Github"
                                               href="https://github.com/berkanumutlu"
                                               target="_blank" rel="nofollow">
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20"
                                                     height="20" viewBox="0 0 50 50">
                                                    <path
                                                        d="M 25 2 C 12.311335 2 2 12.311335 2 25 C 2 37.688665 12.311335 48 25 48 C 37.688665 48 48 37.688665 48 25 C 48 12.311335 37.688665 2 25 2 z M 25 4 C 36.607335 4 46 13.392665 46 25 C 46 25.071371 45.994849 25.141688 45.994141 25.212891 C 45.354527 25.153853 44.615508 25.097776 43.675781 25.064453 C 42.347063 25.017336 40.672259 25.030987 38.773438 25.125 C 38.843852 24.634651 38.893205 24.137377 38.894531 23.626953 C 38.991361 21.754332 38.362521 20.002464 37.339844 18.455078 C 37.586913 17.601352 37.876747 16.515218 37.949219 15.283203 C 38.031819 13.878925 37.910599 12.321765 36.783203 11.269531 L 36.494141 11 L 36.099609 11 C 33.416539 11 31.580023 12.12321 30.457031 13.013672 C 28.835529 12.386022 27.01222 12 25 12 C 22.976367 12 21.135525 12.391416 19.447266 13.017578 C 18.324911 12.126691 16.486785 11 13.800781 11 L 13.408203 11 L 13.119141 11.267578 C 12.020956 12.287321 11.919778 13.801759 11.988281 15.199219 C 12.048691 16.431506 12.321732 17.552142 12.564453 18.447266 C 11.524489 20.02486 10.900391 21.822018 10.900391 23.599609 C 10.900391 24.111237 10.947969 24.610071 11.017578 25.101562 C 9.2118173 25.017808 7.6020996 25.001668 6.3242188 25.046875 C 5.3845143 25.080118 4.6454422 25.135713 4.0058594 25.195312 C 4.0052628 25.129972 4 25.065482 4 25 C 4 13.392665 13.392665 4 25 4 z M 14.396484 13.130859 C 16.414067 13.322043 17.931995 14.222972 18.634766 14.847656 L 19.103516 15.261719 L 19.681641 15.025391 C 21.263092 14.374205 23.026984 14 25 14 C 26.973016 14 28.737393 14.376076 30.199219 15.015625 L 30.785156 15.273438 L 31.263672 14.847656 C 31.966683 14.222758 33.487184 13.321554 35.505859 13.130859 C 35.774256 13.575841 36.007486 14.208668 35.951172 15.166016 C 35.883772 16.311737 35.577304 17.559658 35.345703 18.300781 L 35.195312 18.783203 L 35.494141 19.191406 C 36.483616 20.540691 36.988121 22.000937 36.902344 23.544922 L 36.900391 23.572266 L 36.900391 23.599609 C 36.900391 26.095064 36.00178 28.092339 34.087891 29.572266 C 32.174048 31.052199 29.152663 32 24.900391 32 C 20.648118 32 17.624827 31.052192 15.710938 29.572266 C 13.797047 28.092339 12.900391 26.095064 12.900391 23.599609 C 12.900391 22.134903 13.429308 20.523599 14.40625 19.191406 L 14.699219 18.792969 L 14.558594 18.318359 C 14.326866 17.530484 14.042825 16.254103 13.986328 15.101562 C 13.939338 14.14294 14.166221 13.537027 14.396484 13.130859 z M 8.8847656 26.021484 C 9.5914575 26.03051 10.40146 26.068656 11.212891 26.109375 C 11.290419 26.421172 11.378822 26.727898 11.486328 27.027344 C 8.178972 27.097092 5.7047309 27.429674 4.1796875 27.714844 C 4.1152068 27.214494 4.0638483 26.710021 4.0351562 26.199219 C 5.1622058 26.092262 6.7509972 25.994233 8.8847656 26.021484 z M 41.115234 26.037109 C 43.247527 26.010033 44.835728 26.108156 45.962891 26.214844 C 45.934234 26.718328 45.883749 27.215664 45.820312 27.708984 C 44.24077 27.41921 41.699674 27.086688 38.306641 27.033203 C 38.411945 26.739677 38.499627 26.438219 38.576172 26.132812 C 39.471291 26.084833 40.344564 26.046896 41.115234 26.037109 z M 11.912109 28.019531 C 12.508849 29.215327 13.361516 30.283019 14.488281 31.154297 C 16.028825 32.345531 18.031623 33.177838 20.476562 33.623047 C 20.156699 33.951698 19.86578 34.312595 19.607422 34.693359 L 19.546875 34.640625 C 19.552375 34.634325 19.04975 34.885878 18.298828 34.953125 C 17.547906 35.020374 16.621615 35 15.800781 35 C 14.575781 35 14.03621 34.42121 13.173828 33.367188 C 12.696283 32.72356 12.114101 32.202331 11.548828 31.806641 C 10.970021 31.401475 10.476259 31.115509 9.8652344 31.013672 L 9.7832031 31 L 9.6992188 31 C 9.2325521 31 8.7809835 31.03379 8.359375 31.515625 C 8.1485707 31.756544 8.003277 32.202561 8.0976562 32.580078 C 8.1920352 32.957595 8.4308563 33.189581 8.6445312 33.332031 C 10.011254 34.24318 10.252795 36.046511 11.109375 37.650391 C 11.909298 39.244315 13.635662 40 15.400391 40 L 18 40 L 18 44.802734 C 10.967811 42.320535 5.6646795 36.204613 4.3320312 28.703125 C 5.8629338 28.414776 8.4265387 28.068108 11.912109 28.019531 z M 37.882812 28.027344 C 41.445538 28.05784 44.08105 28.404061 45.669922 28.697266 C 44.339047 36.201504 39.034072 42.31987 32 44.802734 L 32 39.599609 C 32 38.015041 31.479642 36.267712 30.574219 34.810547 C 30.299322 34.368135 29.975945 33.949736 29.615234 33.574219 C 31.930453 33.11684 33.832364 32.298821 35.3125 31.154297 C 36.436824 30.284907 37.287588 29.220424 37.882812 28.027344 z M 23.699219 34.099609 L 26.5 34.099609 C 27.312821 34.099609 28.180423 34.7474 28.875 35.865234 C 29.569577 36.983069 30 38.484177 30 39.599609 L 30 45.398438 C 28.397408 45.789234 26.72379 46 25 46 C 23.27621 46 21.602592 45.789234 20 45.398438 L 20 39.599609 C 20 38.508869 20.467828 37.011307 21.208984 35.888672 C 21.950141 34.766037 22.886398 34.099609 23.699219 34.099609 z M 12.308594 35.28125 C 13.174368 36.179258 14.222525 37 15.800781 37 C 16.579948 37 17.552484 37.028073 18.476562 36.945312 C 18.479848 36.945018 18.483042 36.943654 18.486328 36.943359 C 18.36458 37.293361 18.273744 37.645529 18.197266 38 L 15.400391 38 C 14.167057 38 13.29577 37.55443 12.894531 36.751953 L 12.886719 36.738281 L 12.880859 36.726562 C 12.716457 36.421191 12.500645 35.81059 12.308594 35.28125 z"></path>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="linkedin">
                                            <a aria-label="Learn more from LinkedIn" href="https://linkedin.com/"
                                               target="_blank" rel="nofollow">
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20"
                                                     height="20" viewBox="0 0 50 50">
                                                    <path
                                                        d="M 9 4 C 6.2504839 4 4 6.2504839 4 9 L 4 41 C 4 43.749516 6.2504839 46 9 46 L 41 46 C 43.749516 46 46 43.749516 46 41 L 46 9 C 46 6.2504839 43.749516 4 41 4 L 9 4 z M 9 6 L 41 6 C 42.668484 6 44 7.3315161 44 9 L 44 41 C 44 42.668484 42.668484 44 41 44 L 9 44 C 7.3315161 44 6 42.668484 6 41 L 6 9 C 6 7.3315161 7.3315161 6 9 6 z M 14 11.011719 C 12.904779 11.011719 11.919219 11.339079 11.189453 11.953125 C 10.459687 12.567171 10.011719 13.484511 10.011719 14.466797 C 10.011719 16.333977 11.631285 17.789609 13.691406 17.933594 A 0.98809878 0.98809878 0 0 0 13.695312 17.935547 A 0.98809878 0.98809878 0 0 0 14 17.988281 C 16.27301 17.988281 17.988281 16.396083 17.988281 14.466797 A 0.98809878 0.98809878 0 0 0 17.986328 14.414062 C 17.884577 12.513831 16.190443 11.011719 14 11.011719 z M 14 12.988281 C 15.392231 12.988281 15.94197 13.610038 16.001953 14.492188 C 15.989803 15.348434 15.460091 16.011719 14 16.011719 C 12.614594 16.011719 11.988281 15.302225 11.988281 14.466797 C 11.988281 14.049083 12.140703 13.734298 12.460938 13.464844 C 12.78117 13.19539 13.295221 12.988281 14 12.988281 z M 11 19 A 1.0001 1.0001 0 0 0 10 20 L 10 39 A 1.0001 1.0001 0 0 0 11 40 L 17 40 A 1.0001 1.0001 0 0 0 18 39 L 18 33.134766 L 18 20 A 1.0001 1.0001 0 0 0 17 19 L 11 19 z M 20 19 A 1.0001 1.0001 0 0 0 19 20 L 19 39 A 1.0001 1.0001 0 0 0 20 40 L 26 40 A 1.0001 1.0001 0 0 0 27 39 L 27 29 C 27 28.170333 27.226394 27.345035 27.625 26.804688 C 28.023606 26.264339 28.526466 25.940057 29.482422 25.957031 C 30.468166 25.973981 30.989999 26.311669 31.384766 26.841797 C 31.779532 27.371924 32 28.166667 32 29 L 32 39 A 1.0001 1.0001 0 0 0 33 40 L 39 40 A 1.0001 1.0001 0 0 0 40 39 L 40 28.261719 C 40 25.300181 39.122788 22.95433 37.619141 21.367188 C 36.115493 19.780044 34.024172 19 31.8125 19 C 29.710483 19 28.110853 19.704889 27 20.423828 L 27 20 A 1.0001 1.0001 0 0 0 26 19 L 20 19 z M 12 21 L 16 21 L 16 33.134766 L 16 38 L 12 38 L 12 21 z M 21 21 L 25 21 L 25 22.560547 A 1.0001 1.0001 0 0 0 26.798828 23.162109 C 26.798828 23.162109 28.369194 21 31.8125 21 C 33.565828 21 35.069366 21.582581 36.167969 22.742188 C 37.266572 23.901794 38 25.688257 38 28.261719 L 38 38 L 34 38 L 34 29 C 34 27.833333 33.720468 26.627107 32.990234 25.646484 C 32.260001 24.665862 31.031834 23.983076 29.517578 23.957031 C 27.995534 23.930001 26.747519 24.626988 26.015625 25.619141 C 25.283731 26.611293 25 27.829667 25 29 L 25 38 L 21 38 L 21 21 z"></path>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="instagram">
                                            <a aria-label="Learn more from Instagram" href="https://instagram.com/"
                                               target="_blank" rel="nofollow">
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20"
                                                     height="20" viewBox="0 0 50 50">
                                                    <path
                                                        d="M 16 3 C 8.8324839 3 3 8.8324839 3 16 L 3 34 C 3 41.167516 8.8324839 47 16 47 L 34 47 C 41.167516 47 47 41.167516 47 34 L 47 16 C 47 8.8324839 41.167516 3 34 3 L 16 3 z M 16 5 L 34 5 C 40.086484 5 45 9.9135161 45 16 L 45 34 C 45 40.086484 40.086484 45 34 45 L 16 45 C 9.9135161 45 5 40.086484 5 34 L 5 16 C 5 9.9135161 9.9135161 5 16 5 z M 37 11 A 2 2 0 0 0 35 13 A 2 2 0 0 0 37 15 A 2 2 0 0 0 39 13 A 2 2 0 0 0 37 11 z M 25 14 C 18.936712 14 14 18.936712 14 25 C 14 31.063288 18.936712 36 25 36 C 31.063288 36 36 31.063288 36 25 C 36 18.936712 31.063288 14 25 14 z M 25 16 C 29.982407 16 34 20.017593 34 25 C 34 29.982407 29.982407 34 25 34 C 20.017593 34 16 29.982407 16 25 C 16 20.017593 20.017593 16 25 16 z"></path>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="twitter">
                                            <a aria-label="Learn more from Twitter" href="https://twitter.com/"
                                               target="_blank" rel="nofollow">
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20"
                                                     height="20" viewBox="0 0 50 50">
                                                    <path
                                                        d="M 34.21875 5.46875 C 28.238281 5.46875 23.375 10.332031 23.375 16.3125 C 23.375 16.671875 23.464844 17.023438 23.5 17.375 C 16.105469 16.667969 9.566406 13.105469 5.125 7.65625 C 4.917969 7.394531 4.597656 7.253906 4.261719 7.277344 C 3.929688 7.300781 3.632813 7.492188 3.46875 7.78125 C 2.535156 9.386719 2 11.234375 2 13.21875 C 2 15.621094 2.859375 17.820313 4.1875 19.625 C 3.929688 19.511719 3.648438 19.449219 3.40625 19.3125 C 3.097656 19.148438 2.726563 19.15625 2.425781 19.335938 C 2.125 19.515625 1.941406 19.839844 1.9375 20.1875 L 1.9375 20.3125 C 1.9375 23.996094 3.84375 27.195313 6.65625 29.15625 C 6.625 29.152344 6.59375 29.164063 6.5625 29.15625 C 6.21875 29.097656 5.871094 29.21875 5.640625 29.480469 C 5.410156 29.742188 5.335938 30.105469 5.4375 30.4375 C 6.554688 33.910156 9.40625 36.5625 12.9375 37.53125 C 10.125 39.203125 6.863281 40.1875 3.34375 40.1875 C 2.582031 40.1875 1.851563 40.148438 1.125 40.0625 C 0.65625 40 0.207031 40.273438 0.0507813 40.71875 C -0.109375 41.164063 0.0664063 41.660156 0.46875 41.90625 C 4.980469 44.800781 10.335938 46.5 16.09375 46.5 C 25.425781 46.5 32.746094 42.601563 37.65625 37.03125 C 42.566406 31.460938 45.125 24.226563 45.125 17.46875 C 45.125 17.183594 45.101563 16.90625 45.09375 16.625 C 46.925781 15.222656 48.5625 13.578125 49.84375 11.65625 C 50.097656 11.285156 50.070313 10.789063 49.777344 10.445313 C 49.488281 10.101563 49 9.996094 48.59375 10.1875 C 48.078125 10.417969 47.476563 10.441406 46.9375 10.625 C 47.648438 9.675781 48.257813 8.652344 48.625 7.5 C 48.75 7.105469 48.613281 6.671875 48.289063 6.414063 C 47.964844 6.160156 47.511719 6.128906 47.15625 6.34375 C 45.449219 7.355469 43.558594 8.066406 41.5625 8.5 C 39.625 6.6875 37.074219 5.46875 34.21875 5.46875 Z M 34.21875 7.46875 C 36.769531 7.46875 39.074219 8.558594 40.6875 10.28125 C 40.929688 10.53125 41.285156 10.636719 41.625 10.5625 C 42.929688 10.304688 44.167969 9.925781 45.375 9.4375 C 44.679688 10.375 43.820313 11.175781 42.8125 11.78125 C 42.355469 12.003906 42.140625 12.53125 42.308594 13.011719 C 42.472656 13.488281 42.972656 13.765625 43.46875 13.65625 C 44.46875 13.535156 45.359375 13.128906 46.3125 12.875 C 45.457031 13.800781 44.519531 14.636719 43.5 15.375 C 43.222656 15.578125 43.070313 15.90625 43.09375 16.25 C 43.109375 16.65625 43.125 17.058594 43.125 17.46875 C 43.125 23.71875 40.726563 30.503906 36.15625 35.6875 C 31.585938 40.871094 24.875 44.5 16.09375 44.5 C 12.105469 44.5 8.339844 43.617188 4.9375 42.0625 C 9.15625 41.738281 13.046875 40.246094 16.1875 37.78125 C 16.515625 37.519531 16.644531 37.082031 16.511719 36.683594 C 16.378906 36.285156 16.011719 36.011719 15.59375 36 C 12.296875 35.941406 9.535156 34.023438 8.0625 31.3125 C 8.117188 31.3125 8.164063 31.3125 8.21875 31.3125 C 9.207031 31.3125 10.183594 31.1875 11.09375 30.9375 C 11.53125 30.808594 11.832031 30.402344 11.816406 29.945313 C 11.800781 29.488281 11.476563 29.097656 11.03125 29 C 7.472656 28.28125 4.804688 25.382813 4.1875 21.78125 C 5.195313 22.128906 6.226563 22.402344 7.34375 22.4375 C 7.800781 22.464844 8.214844 22.179688 8.355469 21.746094 C 8.496094 21.3125 8.324219 20.835938 7.9375 20.59375 C 5.5625 19.003906 4 16.296875 4 13.21875 C 4 12.078125 4.296875 11.03125 4.6875 10.03125 C 9.6875 15.519531 16.6875 19.164063 24.59375 19.5625 C 24.90625 19.578125 25.210938 19.449219 25.414063 19.210938 C 25.617188 18.96875 25.695313 18.648438 25.625 18.34375 C 25.472656 17.695313 25.375 17.007813 25.375 16.3125 C 25.375 11.414063 29.320313 7.46875 34.21875 7.46875 Z"></path>
                                                </svg>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="comments" data-aos="fade-up">
                        <h3 class="title">5 comments</h3>
                        <div class="list">
                            <ul>
                                <li>
                                    <div class="comment-item has-child" data-aos="fade-up">
                                        <div class="image">
                                            <img src="https://via.placeholder.com/100x100" alt="User Profile Image">
                                        </div>
                                        <div class="content">
                                            <div class="header">
                                                <h4 class="title">Berkan Ümütlü</h4>
                                                <a href="#" class="btn btn-reply">Reply</a>
                                            </div>
                                            <div class="meta">
                                                <span class="date">Dec 1, 2023</span>
                                            </div>
                                            <p class="comment">Suspendisse arcu erat, blandit nec tellus sed,
                                                pellentesque ultricies nibh. Donec sit amet nibh in sapien fermentum
                                                tempus. Curabitur lorem arcu, finibus non dictum in, convallis eu erat.
                                                Nulla sit amet quam eros. Integer faucibus et enim nec suscipit.</p>
                                        </div>
                                    </div>
                                    <ul class="child" data-aos="fade-up" data-aos-duration="1000">
                                        <li>
                                            <div class="comment-item">
                                                <div class="image">
                                                    <img src="https://via.placeholder.com/100x100"
                                                         alt="User Profile Image">
                                                </div>
                                                <div class="content">
                                                    <div class="header">
                                                        <h4 class="title">Berkan Ümütlü</h4>
                                                        <a href="#" class="btn btn-reply">Reply</a>
                                                    </div>
                                                    <div class="meta">
                                                        <span class="date">Dec 4, 2023</span>
                                                    </div>
                                                    <p class="comment">Curabitur vel dignissim felis. Donec laoreet
                                                        consequat nulla vel sodales. Quisque sed faucibus dolor.
                                                        Maecenas in ligula id turpis facilisis consequat a quis tellus.
                                                        Duis id dui nec sem venenatis suscipit.</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="comment-item">
                                                <div class="image">
                                                    <img src="https://via.placeholder.com/100x100"
                                                         alt="User Profile Image">
                                                </div>
                                                <div class="content">
                                                    <div class="header">
                                                        <h4 class="title">Berkan Ümütlü</h4>
                                                        <a href="#" class="btn btn-reply">Reply</a>
                                                    </div>
                                                    <div class="meta">
                                                        <span class="date">Dec 9, 2023</span>
                                                    </div>
                                                    <p class="comment">Maecenas sit amet vulputate velit, sit amet
                                                        tempor ante. Donec pulvinar enim nec nibh varius semper. Proin
                                                        sollicitudin ante justo. Suspendisse ultricies posuere lacus a
                                                        pulvinar. In facilisis erat sapien, id malesuada mauris aliquet
                                                        a.</p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <div class="comment-item" data-aos="fade-up">
                                        <div class="image">
                                            <img src="https://via.placeholder.com/100x100" alt="User Profile Image">
                                        </div>
                                        <div class="content">
                                            <div class="header">
                                                <h4 class="title">Berkan Ümütlü</h4>
                                                <a href="#" class="btn btn-reply">Reply</a>
                                            </div>
                                            <div class="meta">
                                                <span class="date">Oct 14, 2023</span>
                                            </div>
                                            <p class="comment">Quisque ut justo a massa mollis tincidunt. In viverra
                                                felis mauris, vel lobortis lectus finibus ac. Fusce bibendum lacus
                                                tincidunt felis porta, eu laoreet purus aliquam.</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="comment-item" data-aos="fade-up">
                                        <div class="image">
                                            <img src="https://via.placeholder.com/100x100" alt="User Profile Image">
                                        </div>
                                        <div class="content">
                                            <div class="header">
                                                <h4 class="title">Berkan Ümütlü</h4>
                                                <a href="#" class="btn btn-reply">Reply</a>
                                            </div>
                                            <div class="meta">
                                                <span class="date">Sep 25, 2023</span>
                                            </div>
                                            <p class="comment">Vestibulum interdum, erat sed interdum ullamcorper, diam
                                                lacus commodo arcu, sed molestie diam diam at eros. Vestibulum fermentum
                                                neque ut metus faucibus facilisis ut non turpis.</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </section>
                    <section class="comment-form" data-aos="fade-up">
                        <div class="header">
                            <h3 class="title">Post a Comment</h3>
                            <p class="description">In maximus faucibus mi sed accumsan. Suspendisse ut mi facilisis,
                                pharetra ante ac,
                                dapibus massa. Morbi aliquam magna erat, quis feugiat enim rhoncus eget. Maecenas et
                                sagittis augue.</p>
                        </div>
                        <div class="form">
                            <form action="#" method="POST">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <input type="text" name="fullname" id="fullname" class="form-control mb-3"
                                               placeholder="Full Name">
                                    </div>
                                    <div class="col-xl-6">
                                        <input type="text" name="email" id="email" class="form-control mb-3"
                                               placeholder="Email">
                                    </div>
                                    <div class="col-12">
                                            <textarea name="comment" id="comment" rows="5" class="form-control mb-3"
                                                      placeholder="Comment"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-comment">
                                            <i class="material-icons-outlined">send</i>Post Comment
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
                <div class="col-xl-3">
                    @include('web.layouts.sidebar')
                </div>
            </div>
        </div>
    </main>
@endsection
@section("scripts")
    <script src="{{ asset("assets/plugins/swiper/swiper-bundle.min.js") }}"></script>
    <script src="{{ asset("assets/web/js/components/sidebar.js") }}"></script>
    <script src="{{ asset("assets/plugins/aos/aos.js") }}"></script>
    <script src="{{ asset("assets/plugins/highlight/highlight.min.js") }}"></script>
    <script>
        $(document).ready(function () {
            AOS.init();
            hljs.highlightAll();
        });
    </script>
@endsection
