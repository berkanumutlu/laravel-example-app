@extends("web.layouts.index")
@section("style")
    <link href="{{ asset('assets/web/css/pages/article-detail.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/web/css/components/article-item.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/aos/aos.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/highlight/styles/default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/waitMe/waitMe.min.css') }}" rel="stylesheet">
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
                                <li class="author">by <a
                                        href="{{ route('article.author', ['user' => $record->user]) }}">{{ $record->user?->name }}</a>
                                    @if(!empty($record->category?->slug))
                                        in <a
                                            href="{{ route('article.category', ['slug' => $record->category?->slug]) }}">{{ $record->category?->name }}</a>
                                    @endif
                                </li>
                                @if(!empty($record->publish_date))
                                    <li class="date">
                                        @php
                                            $record_publish_date = \Illuminate\Support\Carbon::parse($record->publish_date)->format('d M Y');
                                        @endphp
                                        <span class="material-icons-outlined">calendar_month</span>
                                        <time datetime="{{ $record_publish_date }}">{{ $record_publish_date }}</time>
                                    </li>
                                @endif
                                <li class="read_time">
                                    <span class="material-icons-outlined">schedule</span>
                                    {{ $record->read_time ?? '' }} min.
                                </li>
                                <li class="view-count">
                                    <span
                                        class="material-icons-outlined">visibility</span>{{ $record->view_count ?? '' }}
                                </li>
                                <li class="like-count">
                                    @csrf
                                    <a href="{{ route('article.like') }}" data-id="{{ $record->id }}"
                                       class="btn btn-like">
                                        <span
                                            class="material-icons-outlined">{{ !empty($userLike) ? 'favorite' : 'favorite_border' }}</span></a>
                                    <span class="number">{{ $record->like_count ?? 0 }}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="article-content">
                            <div class="text">
                                @if(!empty($record->image))
                                    <div class="d-flex justify-content-center mb-3">
                                        <img data-src="{{ asset($record->image) }}"
                                             class="img-fluid w-75 rounded-1 lazyload" loading="lazy"
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
                                                <li class="tag-item"><a
                                                        href="{{ route('article.search', ['q' => $item]) }}">{{ $item }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="share-wrap">
                                <h4 class="mb-2">Share:</h4>
                                <div class="social-list">
                                    <ul>
                                        <li class="facebook">
                                            <a aria-label="Learn more from Facebook" href="https://facebook.com/">
                                                <i class="fa-brands fa-facebook-f"></i>
                                            </a>
                                        </li>
                                        <li class="instagram">
                                            <a aria-label="Learn more from Instagram" href="https://instagram.com/">
                                                <i class="fa-brands fa-instagram"></i>
                                            </a>
                                        </li>
                                        <li class="twitter">
                                            <a aria-label="Learn more from Twitter" href="https://twitter.com/">
                                                <i class="fa-brands fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li class="pinterest">
                                            <a aria-label="Learn more from Pinterest" href="https://pinterest.com/">
                                                <i class="fa-brands fa-pinterest-p"></i>
                                            </a>
                                        </li>
                                        <li class="linkedin">
                                            <a aria-label="Learn more from Linkedin" href="https://linkedin.com/">
                                                <i class="fa-brands fa-linkedin-in"></i>
                                            </a>
                                        </li>
                                        <li class="youtube">
                                            <a aria-label="Learn more from Youtube" href="https://youtube.com/">
                                                <i class="fa-brands fa-youtube"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <x-web.section-author
                        :authorImage="$record->user?->image"
                        :authorName="$record->user?->name"
                        :authorTitle="$record->user?->title"
                        :authorDescription="$record->user?->description"
                        :authorWebsite="$record->user?->website"
                        :authorSocials="$record->user?->socialsActive"
                    ></x-web.section-author>
                    @if(!empty($suggested_articles))
                        <section class="suggested-article-list" data-aos="fade-up">
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h2 class="fs-4 fw-bold">Recommended for you</h2>
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
                                    <div class="swiper">
                                        <div class="swiper-wrapper">
                                            @foreach($suggested_articles as $item)
                                                <div class="swiper-slide" data-aos="zoom-in-up">
                                                    <x-web.item-article :item="$item"></x-web.item-article>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endif
                    <x-web.section-comment-form
                        :headerTitle="'Post a Comment'"
                        :headerDescription="'In maximus faucibus mi sed accumsan. Suspendisse ut mi facilisis, pharetra ante ac, dapibus massa. Morbi aliquam magna erat, quis feugiat enim rhoncus eget. Maecenas et sagittis augue.'"
                        :formAction="route('article.comment.post', ['article' => $record->slug])"
                        :formMethod="'POST'"
                    ></x-web.section-comment-form>
                    <x-web.section-comments
                        :comments="$record->comments"
                        :commentsCount="$record->commentsCount"></x-web.section-comments>
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
    <script src="{{ asset("assets/plugins/highlight/highlight.min.js") }}"></script>
    <script src="{{ asset("assets/plugins/waitMe/waitMe.min.js") }}"></script>
    <script>
        $(document).ready(function () {
            AOS.init();
            hljs.highlightAll();
            let suggestedArticleList = new Swiper('.suggested-article-list .swiper', {
                speed: 400,
                spaceBetween: 15,
                slidesPerView: 3,
                pagination: {
                    el: '.swiper-pagination',
                    type: 'bullets',
                },
                navigation: {
                    nextEl: '.suggested-article-list .custom-pagination .custom-swiper-button-next',
                    prevEl: '.suggested-article-list .custom-pagination .custom-swiper-button-prev'
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
            $('.btn-like').on("click", function (e) {
                e.preventDefault();
                let self = $(this);
                @if(auth()->guard('web')->check())
                $.ajax({
                    url: self.attr('href'),
                    type: "POST",
                    headers: {'X-CSRF-TOKEN': self.prev('input[name="_token"]').val()},
                    dataType: "JSON",
                    data: {recordId: self.data('id')}
                }).done(function (response) {
                    if (response.hasOwnProperty('status')) {
                        if (response.status) {
                            if (response.hasOwnProperty('data')) {
                                if (response.data.hasOwnProperty('like_count')) {
                                    self.next('.number').text(response.data.like_count);
                                }
                                if (response.data.hasOwnProperty('icon')) {
                                    self.find('span').text(response.data.icon);
                                }
                            }
                        }
                    }
                });
                @else
                Swal.fire({
                    html: 'You need to log in to like the article.',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false,
                    icon: 'warning'
                });
                @endif
            });
        });
    </script>
@endsection
