@extends("web.layouts.index")
@section("head")

@endsection
@section("style")
    <link href="{{ asset('assets/web/css/home.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/aos/aos.min.css') }}" rel="stylesheet">
@endsection
@section("content")
    <div class="feature-category-list">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="feature-category-item" data-aos="flip-left">
                        <h2 class="title">Feature Category Title</h2>
                        <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque
                            tincidunt odio a velit faucibus, in mattis quam laoreet.</p>
                        <p class="footer-text">Lorem ipsum dolor sit amet</p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="feature-category-item" data-aos="flip-left">
                        <h2 class="title">Feature Category Title</h2>
                        <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque
                            tincidunt odio a velit faucibus, in mattis quam laoreet.</p>
                        <p class="footer-text">Lorem ipsum dolor sit amet</p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="feature-category-item" data-aos="flip-right">
                        <h2 class="title">Feature Category Title</h2>
                        <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque
                            tincidunt odio a velit faucibus, in mattis quam laoreet.</p>
                        <p class="footer-text">Lorem ipsum dolor sit amet</p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3" data-aos="flip-right">
                    <div class="feature-category-item">
                        <h2 class="title">Feature Category Title</h2>
                        <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque
                            tincidunt odio a velit faucibus, in mattis quam laoreet.</p>
                        <p class="footer-text">Lorem ipsum dolor sit amet</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                                            class="custom-swiper-button-prev material-icons-outlined btn btn-secondary">arrow_back</span>
                                        <span
                                            class="custom-swiper-button-next material-icons-outlined btn btn-secondary">arrow_forward</span>
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
                                            <div class="popular-item">
                                                <a href="#" class="d-block">
                                                    <img src="https://via.placeholder.com/600x400" class="img-fluid"
                                                         alt="Slider 1">
                                                </a>
                                                <div class="popular-item-body">
                                                    <div class="author">
                                                        Author: <a href="#">Berkan Ümütlü</a>
                                                    </div>
                                                    <div class="title">
                                                        <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                            Aliquam
                                                            porta blandit risus ac consectetur.</h4>
                                                    </div>
                                                    <div class="date">
                                                        <p>18 Oct 2023</p>
                                                        <p class="ms-3">&#x25CF;10 min</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide" data-aos="zoom-in-up">
                                            <div class="popular-item">
                                                <a href="#" class="d-block">
                                                    <img src="https://via.placeholder.com/600x400" class="img-fluid"
                                                         alt="Slider 1">
                                                </a>
                                                <div class="popular-item-body">
                                                    <div class="author">
                                                        Author: <a href="#">Berkan Ümütlü</a>
                                                    </div>
                                                    <div class="title">
                                                        <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                            Aliquam
                                                            porta blandit risus ac consectetur.</h4>
                                                    </div>
                                                    <div class="date">
                                                        <p>18 Oct 2023</p>
                                                        <p class="ms-3">&#x25CF;10 min</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide" data-aos="zoom-in-up">
                                            <div class="popular-item">
                                                <a href="#" class="d-block">
                                                    <img src="https://via.placeholder.com/600x400" class="img-fluid"
                                                         alt="Slider 1">
                                                </a>
                                                <div class="popular-item-body">
                                                    <div class="author">
                                                        Author: <a href="#">Berkan Ümütlü</a>
                                                    </div>
                                                    <div class="title">
                                                        <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                            Aliquam
                                                            porta blandit risus ac consectetur.</h4>
                                                    </div>
                                                    <div class="date">
                                                        <p>18 Oct 2023</p>
                                                        <p class="ms-3">&#x25CF;10 min</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide" data-aos="zoom-in-up">
                                            <div class="popular-item">
                                                <a href="#" class="d-block">
                                                    <img src="https://via.placeholder.com/600x400" class="img-fluid"
                                                         alt="Slider 1">
                                                </a>
                                                <div class="popular-item-body">
                                                    <div class="author">
                                                        Author: <a href="#">Berkan Ümütlü</a>
                                                    </div>
                                                    <div class="title">
                                                        <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                            Aliquam
                                                            porta blandit risus ac consectetur.</h4>
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
                </div>
                <div class="col-xl-3">
                    <section class="sidebar sidebar-right category-list">
                        <div class="title-section">
                            <h4 class="title">Categories</h4>
                        </div>
                        <div class="content">
                            <ul class="list-group list-unstyled">
                                <li class="list-group-item"><a href="#" class="list-group-item-action">PHP
                                        <span class="text-warning float-end me-3">&#x25CF;</span></a>
                                </li>
                                <li class="list-group-item"><a href="#" class="list-group-item-action">HTML
                                        <span class="text-primary float-end me-3">&#x25CF;</span></a></li>
                                <li class="list-group-item"><a href="#" class="list-group-item-action">CSS
                                        <span class="text-danger float-end me-3">&#x25CF;</span></a></li>
                                <li class="list-group-item"><a href="#" class="list-group-item-action">JS
                                        <span class="text-success float-end me-3">&#x25CF;</span></a></li>
                            </ul>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>
@endsection
@section("scripts")
    <script src="{{ asset("assets/plugins/swiper/swiper-bundle.min.js") }}"></script>
    <script src="{{ asset("assets/plugins/aos/aos.js") }}"></script>
    <script>
        AOS.init();
        $(document).ready(function () {
            let swiper = new Swiper('.popular-article-list .swiper', {
                speed: 400,
                spaceBetween: 15,
                slidesPerView: 3,
                pagination: {
                    el: '.swiper-pagination',
                    type: 'bullets',
                },
                navigation: {
                    nextEl: '.custom-swiper-button-next',
                    prevEl: '.custom-swiper-button-prev'
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
        });
    </script>
@endsection
