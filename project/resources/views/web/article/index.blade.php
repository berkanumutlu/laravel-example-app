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
                            <div class="col-xl-4">
                                <div class="article-item" data-aos="flip-down">
                                    <div class="article-item-image-section">
                                        <a href="#" class="article-item-image-link">
                                            <img src="https://via.placeholder.com/600x400"
                                                 class="article-item-image img-fluid" alt="Slider 1">
                                        </a>
                                        <a href="#" class="btn btn-danger article-item-category"
                                           data-aos="flip-right" data-aos-easing="ease-out-cubic"
                                           data-aos-duration="2500">CSS</a>
                                    </div>
                                    <div class="article-item-body">
                                        <div class="author">
                                            Author: <a href="#">Berkan Ümütlü</a>
                                        </div>
                                        <div class="title">
                                            <a href="#"><h4>Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing elit.
                                                    Aliquam
                                                    porta blandit risus ac consectetur.</h4></a>
                                        </div>
                                        <div class="date">
                                            <p>18 Oct 2023</p>
                                            <p class="ms-3">&#x25CF;10 min</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="article-item" data-aos="flip-down">
                                    <div class="article-item-image-section">
                                        <a href="#" class="article-item-image-link">
                                            <img src="https://via.placeholder.com/600x400"
                                                 class="article-item-image img-fluid" alt="Slider 1">
                                        </a>
                                        <a href="#" class="btn btn-primary article-item-category"
                                           data-aos="flip-right" data-aos-easing="ease-out-cubic"
                                           data-aos-duration="2500">HTML</a>
                                    </div>
                                    <div class="article-item-body">
                                        <div class="author">
                                            Author: <a href="#">Berkan Ümütlü</a>
                                        </div>
                                        <div class="title">
                                            <a href="#"><h4>Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing elit.
                                                    Aliquam
                                                    porta blandit risus ac consectetur.</h4></a>
                                        </div>
                                        <div class="date">
                                            <p>18 Oct 2023</p>
                                            <p class="ms-3">&#x25CF;10 min</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="article-item" data-aos="flip-down">
                                    <div class="article-item-image-section">
                                        <a href="#" class="article-item-image-link">
                                            <img src="https://via.placeholder.com/600x400"
                                                 class="article-item-image img-fluid" alt="Slider 1">
                                        </a>
                                        <a href="#" class="btn btn-success article-item-category"
                                           data-aos="flip-right" data-aos-easing="ease-out-cubic"
                                           data-aos-duration="2500">JS</a>
                                    </div>
                                    <div class="article-item-body">
                                        <div class="author">
                                            Author: <a href="#">Berkan Ümütlü</a>
                                        </div>
                                        <div class="title">
                                            <a href="#"><h4>Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing elit.
                                                    Aliquam
                                                    porta blandit risus ac consectetur.</h4></a>
                                        </div>
                                        <div class="date">
                                            <p>18 Oct 2023</p>
                                            <p class="ms-3">&#x25CF;10 min</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="article-item" data-aos="flip-down">
                                    <div class="article-item-image-section">
                                        <a href="#" class="article-item-image-link">
                                            <img src="https://via.placeholder.com/600x400"
                                                 class="article-item-image img-fluid" alt="Slider 1">
                                        </a>
                                        <a href="#" class="btn btn-warning article-item-category"
                                           data-aos="flip-right" data-aos-easing="ease-out-cubic"
                                           data-aos-duration="2500">PHP</a>
                                    </div>
                                    <div class="article-item-body">
                                        <div class="author">
                                            Author: <a href="#">Berkan Ümütlü</a>
                                        </div>
                                        <div class="title">
                                            <a href="#"><h4>Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing elit.
                                                    Aliquam
                                                    porta blandit risus ac consectetur.</h4></a>
                                        </div>
                                        <div class="date">
                                            <p>18 Oct 2023</p>
                                            <p class="ms-3">&#x25CF;10 min</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="article-item" data-aos="flip-down">
                                    <div class="article-item-image-section">
                                        <a href="#" class="article-item-image-link">
                                            <img src="https://via.placeholder.com/600x400"
                                                 class="article-item-image img-fluid" alt="Slider 1">
                                        </a>
                                        <a href="#" class="btn btn-danger article-item-category"
                                           data-aos="flip-right" data-aos-easing="ease-out-cubic"
                                           data-aos-duration="2500">CSS</a>
                                    </div>
                                    <div class="article-item-body">
                                        <div class="author">
                                            Author: <a href="#">Berkan Ümütlü</a>
                                        </div>
                                        <div class="title">
                                            <a href="#"><h4>Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing elit.
                                                    Aliquam
                                                    porta blandit risus ac consectetur.</h4></a>
                                        </div>
                                        <div class="date">
                                            <p>18 Oct 2023</p>
                                            <p class="ms-3">&#x25CF;10 min</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="article-item" data-aos="flip-down">
                                    <div class="article-item-image-section">
                                        <a href="#" class="article-item-image-link">
                                            <img src="https://via.placeholder.com/600x400"
                                                 class="article-item-image img-fluid" alt="Slider 1">
                                        </a>
                                        <a href="#" class="btn btn-danger article-item-category"
                                           data-aos="flip-right" data-aos-easing="ease-out-cubic"
                                           data-aos-duration="2500">CSS</a>
                                    </div>
                                    <div class="article-item-body">
                                        <div class="author">
                                            Author: <a href="#">Berkan Ümütlü</a>
                                        </div>
                                        <div class="title">
                                            <a href="#"><h4>Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing elit.
                                                    Aliquam
                                                    porta blandit risus ac consectetur.</h4></a>
                                        </div>
                                        <div class="date">
                                            <p>18 Oct 2023</p>
                                            <p class="ms-3">&#x25CF;10 min</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="article-item" data-aos="flip-down">
                                    <div class="article-item-image-section">
                                        <a href="#" class="article-item-image-link">
                                            <img src="https://via.placeholder.com/600x400"
                                                 class="article-item-image img-fluid" alt="Slider 1">
                                        </a>
                                        <a href="#" class="btn btn-primary article-item-category"
                                           data-aos="flip-right" data-aos-easing="ease-out-cubic"
                                           data-aos-duration="2500">HTML</a>
                                    </div>
                                    <div class="article-item-body">
                                        <div class="author">
                                            Author: <a href="#">Berkan Ümütlü</a>
                                        </div>
                                        <div class="title">
                                            <a href="#"><h4>Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing elit.
                                                    Aliquam
                                                    porta blandit risus ac consectetur.</h4></a>
                                        </div>
                                        <div class="date">
                                            <p>18 Oct 2023</p>
                                            <p class="ms-3">&#x25CF;10 min</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="article-item" data-aos="flip-down">
                                    <div class="article-item-image-section">
                                        <a href="#" class="article-item-image-link">
                                            <img src="https://via.placeholder.com/600x400"
                                                 class="article-item-image img-fluid" alt="Slider 1">
                                        </a>
                                        <a href="#" class="btn btn-success article-item-category"
                                           data-aos="flip-right" data-aos-easing="ease-out-cubic"
                                           data-aos-duration="2500">JS</a>
                                    </div>
                                    <div class="article-item-body">
                                        <div class="author">
                                            Author: <a href="#">Berkan Ümütlü</a>
                                        </div>
                                        <div class="title">
                                            <a href="#"><h4>Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing elit.
                                                    Aliquam
                                                    porta blandit risus ac consectetur.</h4></a>
                                        </div>
                                        <div class="date">
                                            <p>18 Oct 2023</p>
                                            <p class="ms-3">&#x25CF;10 min</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="article-item" data-aos="flip-down">
                                    <div class="article-item-image-section">
                                        <a href="#" class="article-item-image-link">
                                            <img src="https://via.placeholder.com/600x400"
                                                 class="article-item-image img-fluid" alt="Slider 1">
                                        </a>
                                        <a href="#" class="btn btn-warning article-item-category"
                                           data-aos="flip-right" data-aos-easing="ease-out-cubic"
                                           data-aos-duration="2500">PHP</a>
                                    </div>
                                    <div class="article-item-body">
                                        <div class="author">
                                            Author: <a href="#">Berkan Ümütlü</a>
                                        </div>
                                        <div class="title">
                                            <a href="#"><h4>Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing elit.
                                                    Aliquam
                                                    porta blandit risus ac consectetur.</h4></a>
                                        </div>
                                        <div class="date">
                                            <p>18 Oct 2023</p>
                                            <p class="ms-3">&#x25CF;10 min</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="article-item" data-aos="flip-down">
                                    <div class="article-item-image-section">
                                        <a href="#" class="article-item-image-link">
                                            <img src="https://via.placeholder.com/600x400"
                                                 class="article-item-image img-fluid" alt="Slider 1">
                                        </a>
                                        <a href="#" class="btn btn-danger article-item-category"
                                           data-aos="flip-right" data-aos-easing="ease-out-cubic"
                                           data-aos-duration="2500">CSS</a>
                                    </div>
                                    <div class="article-item-body">
                                        <div class="author">
                                            Author: <a href="#">Berkan Ümütlü</a>
                                        </div>
                                        <div class="title">
                                            <a href="#"><h4>Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing elit.
                                                    Aliquam
                                                    porta blandit risus ac consectetur.</h4></a>
                                        </div>
                                        <div class="date">
                                            <p>18 Oct 2023</p>
                                            <p class="ms-3">&#x25CF;10 min</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="article-item" data-aos="flip-down">
                                    <div class="article-item-image-section">
                                        <a href="#" class="article-item-image-link">
                                            <img src="https://via.placeholder.com/600x400"
                                                 class="article-item-image img-fluid" alt="Slider 1">
                                        </a>
                                        <a href="#" class="btn btn-primary article-item-category"
                                           data-aos="flip-right" data-aos-easing="ease-out-cubic"
                                           data-aos-duration="2500">HTML</a>
                                    </div>
                                    <div class="article-item-body">
                                        <div class="author">
                                            Author: <a href="#">Berkan Ümütlü</a>
                                        </div>
                                        <div class="title">
                                            <a href="#"><h4>Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing elit.
                                                    Aliquam
                                                    porta blandit risus ac consectetur.</h4></a>
                                        </div>
                                        <div class="date">
                                            <p>18 Oct 2023</p>
                                            <p class="ms-3">&#x25CF;10 min</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="article-item" data-aos="flip-down">
                                    <div class="article-item-image-section">
                                        <a href="#" class="article-item-image-link">
                                            <img src="https://via.placeholder.com/600x400"
                                                 class="article-item-image img-fluid" alt="Slider 1">
                                        </a>
                                        <a href="#" class="btn btn-success article-item-category"
                                           data-aos="flip-right" data-aos-easing="ease-out-cubic"
                                           data-aos-duration="2500">JS</a>
                                    </div>
                                    <div class="article-item-body">
                                        <div class="author">
                                            Author: <a href="#">Berkan Ümütlü</a>
                                        </div>
                                        <div class="title">
                                            <a href="#"><h4>Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing elit.
                                                    Aliquam
                                                    porta blandit risus ac consectetur.</h4></a>
                                        </div>
                                        <div class="date">
                                            <p>18 Oct 2023</p>
                                            <p class="ms-3">&#x25CF;10 min</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="pagination-section">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
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
