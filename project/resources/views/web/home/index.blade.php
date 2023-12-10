@extends("web.layouts.index")
@section("head")

@endsection
@section("style")
    <link href="{{ asset('assets/web/css/home.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/aos/aos.min.css') }}" rel="stylesheet">
@endsection
@section("content")
    @if(!empty($settings->show_feature_categories))
        <div class="feature-category-list">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-xl-3">
                        <div class="feature-category-item"
                             style="background-image: url('{{ !empty($settings->image_default_category) ? asset($settings->image_default_category) : '' }}')"
                             data-aos="flip-left">
                            <h2 class="title">Feature Category Title</h2>
                            <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque
                                tincidunt odio a velit faucibus, in mattis quam laoreet.</p>
                            <p class="footer-text">Lorem ipsum dolor sit amet</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="feature-category-item"
                             style="background-image: url('{{ !empty($settings->image_default_category) ? asset($settings->image_default_category) : '' }}')"
                             data-aos="flip-left">
                            <h2 class="title">Feature Category Title</h2>
                            <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque
                                tincidunt odio a velit faucibus, in mattis quam laoreet.</p>
                            <p class="footer-text">Lorem ipsum dolor sit amet</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="feature-category-item"
                             style="background-image: url('{{ !empty($settings->image_default_category) ? asset($settings->image_default_category) : '' }}')"
                             data-aos="flip-right">
                            <h2 class="title">Feature Category Title</h2>
                            <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque
                                tincidunt odio a velit faucibus, in mattis quam laoreet.</p>
                            <p class="footer-text">Lorem ipsum dolor sit amet</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="feature-category-item"
                             style="background-image: url('{{ !empty($settings->image_default_category) ? asset($settings->image_default_category) : '' }}')"
                             data-aos="flip-right">
                            <h2 class="title">Feature Category Title</h2>
                            <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque
                                tincidunt odio a velit faucibus, in mattis quam laoreet.</p>
                            <p class="footer-text">Lorem ipsum dolor sit amet</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <main class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-xl-9">
                    <section class="popular-article-list">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h2 class="font-weight-bold">Most Popular Articles</h2>
                                    <div class="custom-pagination">
                                        <span
                                            class="custom-swiper-button-prev material-icons-outlined btn btn-secondary"
                                            data-aos="fade-right">arrow_back</span>
                                        <span
                                            class="custom-swiper-button-next material-icons-outlined btn btn-secondary"
                                            data-aos="fade-left">arrow_forward</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <!-- Slider main container -->
                                <div class="swiper">
                                    <!-- Additional required wrapper -->
                                    <div class="swiper-wrapper">
                                        <!-- Slides -->
                                        <div class="swiper-slide" data-aos="zoom-in-up">
                                            <div class="article-item">
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
                                        <div class="swiper-slide" data-aos="zoom-in-up">
                                            <div class="article-item">
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
                                        <div class="swiper-slide" data-aos="zoom-in-up">
                                            <div class="article-item">
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
                                        <div class="swiper-slide" data-aos="zoom-in-up">
                                            <div class="article-item">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="home-description" data-aos="flip-up">
                        <div class="icon">
                            <span class="material-icons-outlined">send</span>
                        </div>
                        <div class="body">
                            <h4>Description Title</h4>
                            <p>It is a long established fact that a reader will be distracted by the readable
                                content of a page when looking at its layout.</p>
                            <a href="#" class="btn btn-warning">Join us</a>
                        </div>
                    </section>
                    <section class="last-article-list" data-aos="flip-down">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="my-3 font-weight-bold">Last Articles</h2>
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
                                            <a href="#"><h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                    Aliquam porta blandit risus ac consectetur.</h4></a>
                                        </div>
                                        <div class="date">
                                            <p>18 Oct 2023</p>
                                            <p class="ms-3">&#x25CF;10 min</p>
                                        </div>
                                    </div>
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
