@extends("web.layouts.index")
@section("style")
    <link href="{{ asset('assets/web/css/home.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/web/css/articles.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/aos/aos.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/highlight/styles/default.min.css') }}" rel="stylesheet">
@endsection
@section("content")
    <main class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-xl-9">
                    <section class="article-detail">
                        <div class="article-header">
                            <div class="date">
                                <time datetime="26-11-2023 20:00">26 November 2023</time>
                                <ul class="category-list nav list-unstyled">
                                    <li class="category-item"><a href="#">CSS</a></li>
                                    <li class="category-item"><a href="#">HTML</a></li>
                                    <li class="category-item"><a href="#">PHP</a></li>
                                </ul>
                            </div>
                            <div class="author">
                                Author: <a href="#">Berkan Ümütlü</a>
                            </div>
                        </div>
                        <div class="article-content">
                            <h1 class="title">Article Title</h1>
                            <div class="text">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sodales massa et
                                    urna aliquet, eu placerat leo pretium. Nulla at mauris sed justo convallis iaculis.
                                    Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
                                    egestas. Mauris eu orci viverra, imperdiet arcu eu, lobortis metus. Aliquam diam
                                    augue, dictum sed mauris ac, ullamcorper convallis est. Ut rutrum lectus vitae
                                    tellus interdum imperdiet. Morbi congue turpis mauris, ac eleifend purus congue nec.
                                    Fusce nec mauris nunc. Mauris vitae magna sit amet felis placerat auctor a et ipsum.
                                    Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos
                                    himenaeos. Nullam augue magna, pharetra blandit mauris sollicitudin, sagittis tempus
                                    justo. Donec nec sapien feugiat, sodales arcu non, finibus felis. Pellentesque
                                    viverra at tortor id pretium. Integer a placerat turpis.</p>
                                <pre>
                                    <code class="language-js">
                                        var number1 = 10
                                        // Comment line

                                        var number2 = 20

                                        var result = number1 + number2
                                    </code>
                                </pre>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-xl-3">
                    <section class="sidebar sidebar-right category-list" data-aos="fade-left">
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
                    <section class="sidebar-video mt-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="swiper">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide" data-aos="zoom-in-up">
                                            <iframe width="100%" height="250"
                                                    src="https://www.youtube.com/embed/fEErySYqItI"
                                                    title="Into The Nature - Cinematic Travel Video | Sony a6300"
                                                    frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                    allowfullscreen></iframe>
                                        </div>
                                        <div class="swiper-slide" data-aos="zoom-in-up">
                                            <iframe width="100%" height="250"
                                                    src="https://www.youtube.com/embed/bjxTIcuzB6k?si=gl7wHywarxjEHiDC"
                                                    title="YouTube video player" frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                    allowfullscreen></iframe>
                                        </div>
                                        <div class="swiper-slide" data-aos="zoom-in-up">
                                            <iframe width="100%" height="250"
                                                    src="https://www.youtube.com/embed/TATT6toJrdY?list=PLe6YKWr4VVM1x2LIpiqmVvG4QgIvoDEdO"
                                                    title="No copyright music | Copyright-free nature video | Copyright-free nature music for YouTube videos"
                                                    frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                    allowfullscreen></iframe>
                                        </div>
                                        <div class="swiper-slide" data-aos="zoom-in-up">
                                            <iframe width="100%" height="250"
                                                    src="https://www.youtube.com/embed/73GcBPduYE4?list=PLe6YKWr4VVM1x2LIpiqmVvG4QgIvoDEdO"
                                                    title="copyright free music | No copyright music cinematic video | free nature video no copyright | Clips"
                                                    frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                    allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-pagination text-end my-2">
                                    <span
                                        class="custom-swiper-button-prev material-icons-outlined btn btn-secondary"
                                        data-aos="fade-right">arrow_back</span>
                                    <span
                                        class="custom-swiper-button-next material-icons-outlined btn btn-secondary"
                                        data-aos="fade-left">arrow_forward</span>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="sidebar-authors mt-2">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="font-weight-600">Authors</h2>
                            </div>
                            <div class="col-12">
                                <div class="swiper">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide" data-aos="zoom-in-left">
                                            <a href="#" class="author-link">
                                                <div class="author-image"
                                                     style="background-image: url('https://via.placeholder.com/250x250');"></div>
                                                <div class="author-name">Berkan Ümütlü</div>
                                            </a>
                                        </div>
                                        <div class="swiper-slide" data-aos="zoom-in-left">
                                            <a href="#" class="author-link">
                                                <div class="author-image"
                                                     style="background-image: url('https://via.placeholder.com/250x250');"></div>
                                                <div class="author-name">Author2</div>
                                            </a>
                                        </div>
                                        <div class="swiper-slide" data-aos="zoom-in-left">
                                            <a href="#" class="author-link">
                                                <div class="author-image"
                                                     style="background-image: url('https://via.placeholder.com/250x250');"></div>
                                                <div class="author-name">Author3</div>
                                            </a>
                                        </div>
                                        <div class="swiper-slide" data-aos="zoom-in-left">
                                            <a href="#" class="author-link">
                                                <div class="author-image"
                                                     style="background-image: url('https://via.placeholder.com/250x250');"></div>
                                                <div class="author-name">Author4</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-pagination text-end my-2">
                                    <span
                                        class="custom-swiper-button-prev material-icons-outlined btn btn-secondary"
                                        data-aos="fade-right">arrow_back</span>
                                    <span
                                        class="custom-swiper-button-next material-icons-outlined btn btn-secondary"
                                        data-aos="fade-left">arrow_forward</span>
                                </div>
                            </div>
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
    <script src="{{ asset("assets/plugins/highlight/highlight.min.js") }}"></script>
    <script>
        $(document).ready(function () {
            AOS.init();
            hljs.highlightAll();
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
                breakpoints: {
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
