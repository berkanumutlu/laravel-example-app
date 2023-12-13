@extends("web.layouts.index")
@section("style")
    <link href="{{ asset('assets/web/css/home.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/web/css/articles.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/aos/aos.min.css') }}" rel="stylesheet">
@endsection
@section("content")
    <main class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-xl-9">
                    <section class="last-article-list" data-aos="flip-down">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="mb-3 font-weight-bold">{{ $title ?? '' }}</h2>
                            </div>
                            @if(!empty($records))
                                @foreach($records as $item)
                                    <div class="col-xl-4">
                                        <div class="article-item" data-aos="flip-down">
                                            <div class="article-item-image-section">
                                                <a href="#" class="article-item-image-link">
                                                    <img src="{{ $item->image }}"
                                                         class="article-item-image img-fluid" alt="{{ $item->title }}">
                                                </a>
                                                <a href="{{ route('article.category', ['slug' => $item->category?->slug]) }}"
                                                   class="btn btn-danger article-item-category"
                                                   data-aos="flip-right" data-aos-easing="ease-out-cubic"
                                                   data-aos-duration="2500">{{ $item->category?->name }}</a>
                                            </div>
                                            <div class="article-item-body">
                                                <div class="author">
                                                    Author: <a href="#">{{ $item->user?->name }}</a>
                                                </div>
                                                <div class="title">
                                                    <a href="#"><h4>{{ $item->title }}</h4></a>
                                                </div>
                                                <div class="date">
                                                    <p>{{ $item->publish_date }}</p>
                                                    <p class="ms-3">&#x25CF;{{ $item->read_time }} min</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            @if($records->lastPage() > 1)
                                <div class="col-12">
                                    <div class="pagination-section">
                                        {{ $records->links() }}
                                    </div>
                                </div>
                            @endif
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
    <script src="{{ asset("assets/plugins/aos/aos.js") }}"></script>
    <script>
        $(document).ready(function () {
            AOS.init();
            let swiper = new Swiper('.popular-article-list .swiper', {
                speed: 400,
                spaceBetween: 15,
                slidesPerView: 3,
                pagination: {
                    el: '.swiper-pagination',
                    type: 'bullets',
                },
                navigation: {
                    nextEl: '.popular-article-list .custom-pagination .custom-swiper-button-next',
                    prevEl: '.popular-article-list .custom-pagination .custom-swiper-button-prev'
                },
                /*autoplay: {
                    delay: 5000,
                },
                rewind: true*/
                breakpoints: {
                    // when window width is >= 320px
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 10
                    },
                    480: {
                        slidesPerView: 2,
                        spaceBetween: 10
                    },
                    576: {
                        slidesPerView: 2,
                        spaceBetween: 10
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 10
                    },
                    992: {
                        slidesPerView: 3,
                        spaceBetween: 15
                    },
                    1200: {
                        slidesPerView: 3,
                        spaceBetween: 15
                    },
                    1400: {
                        slidesPerView: 3,
                        spaceBetween: 15
                    }
                },
            });
            let sidebarVideoSwiper = new Swiper('.sidebar-video .swiper', {
                speed: 400,
                slidesPerView: 1,
                autoplay: {
                    delay: 5000,
                },
                loop: true,
                navigation: {
                    nextEl: '.sidebar-video .custom-pagination .custom-swiper-button-next',
                    prevEl: '.sidebar-video .custom-pagination .custom-swiper-button-prev'
                },
            });
            let sidebarAuthorSwiper = new Swiper('.sidebar-authors .swiper', {
                speed: 400,
                slidesPerView: 1,
                autoplay: {
                    delay: 5000,
                },
                loop: true,
                navigation: {
                    nextEl: '.sidebar-authors .custom-pagination .custom-swiper-button-next',
                    prevEl: '.sidebar-authors .custom-pagination .custom-swiper-button-prev'
                },
            });
        });
    </script>
@endsection
