@extends("web.layouts.index")
@section("head")

@endsection
@section("style")
    <link href="{{ asset('assets/web/css/pages/home.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/web/css/components/article-item.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/aos/aos.min.css') }}" rel="stylesheet">
@endsection
@section("content")
    @if(!empty($settings->show_feature_categories) && !empty($feature_category_list))
        <div class="feature-category-list">
            <div class="container">
                <div class="row">
                    @foreach($feature_category_list as $item)
                        <div class="col-md-6 col-xl-3">
                            <a href="{{ route('article.category', ['slug' => $item->slug]) }}"
                               class="feature-category-item-link">
                                <div class="feature-category-item"
                                     style="background-image: url('{{ !empty($item->image) ? asset($item->image) : asset($settings->image_default_category) }}')"
                                     data-aos="flip-left">
                                    <h2 class="title">{{ $item->name }}</h2>
                                    <p class="description">{!! $item->description !!}</p>
                                    <p class="footer-text">{{ $item->articlesActive?->count() ? $item->articlesActive?->count().' articles' : '0 article' }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <main class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-xl-9">
                    @if(!empty($popular_article_list))
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
                                            @foreach($popular_article_list as $item)
                                                <div class="swiper-slide" data-aos="zoom-in-up">
                                                    <x-web.item-article
                                                        :item="$item"
                                                        :articleItemAttributes="'data-aos=flip-down'"
                                                        :articleCategoryLinkAttributes="'data-aos=flip-right data-aos-easing=ease-out-cubic data-aos-duration=2500'"></x-web.item-article>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endif
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
                    @if(!empty($last_article_list))
                        <section class="last-article-list" data-aos="flip-down">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="my-3 font-weight-bold">Last Articles</h2>
                                </div>
                                @foreach($last_article_list as $item)
                                    <div class="col-xl-4">
                                        <x-web.item-article
                                            :item="$item"
                                            :articleItemAttributes="'data-aos=flip-down'"
                                            :articleCategoryLinkAttributes="'data-aos=flip-right data-aos-easing=ease-out-cubic data-aos-duration=2500'"></x-web.item-article>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endif
                </div>
                <div class="col-xl-3">
                    @include('components.web.sidebar')
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
            let popularArticleList = new Swiper('.popular-article-list .swiper', {
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
        });
    </script>
@endsection
