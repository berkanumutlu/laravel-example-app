@extends("web.layouts.index")
@section("style")
    <link href="{{ asset('assets/web/css/pages/article-detail.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/aos/aos.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/highlight/styles/default.min.css') }}" rel="stylesheet">
    @if(!empty($userPage))
        <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/plugins/summernote/summernote-lite.min.css') }}" rel="stylesheet">
    @else
        <link href="{{ asset('assets/plugins/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/plugins/waitMe/waitMe.min.css') }}" rel="stylesheet">
    @endif
@endsection
@section("content")
    <main class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-xl-9">
                    @if (!empty($userPage))
                        <form
                            action="{{ !empty($record) ? route('user.article.edit', ['article' => $record]) : route('user.article.add') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @endif
                            <section class="article-detail" data-aos="zoom-in-right">
                                <div class="article-header">
                                    @if(!empty($userPage))
                                        <div class="mb-2">
                                            <input type="text" class="form-control" name="title" id="title"
                                                   placeholder="Article Title" required
                                                   value="{{ old('title') ?? ($record->title ?? '') }}">
                                        </div>
                                    @else
                                        <h1 class="title">{{ $record->title ?? '' }}</h1>
                                    @endif
                                    <ul class="meta">
                                        @if(!empty($record))
                                            <li class="author">by
                                                @if(!empty($record->user))
                                                    <a href="{{ route('article.author', ['user' => $record->user]) }}">{{ $record->user?->name }}</a>
                                                @endif
                                                @if(!empty($record->category?->slug))
                                                    @if(!empty($userPage))
                                                        in <select class="form-select bg-light" name="category_id"
                                                                   id="category_id" aria-label="Category">
                                                            <option value="{{ null }}">Category</option>
                                                            @if(!empty($category_list))
                                                                @foreach($category_list as $item)
                                                                    <option
                                                                        value="{{ $item->id }}" {{ (old('category_id') && old('category_id') == $item->id) || (isset($record) && $record->category_id == $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    @else
                                                        in <a
                                                            href="{{ route('article.category', ['slug' => $record->category?->slug]) }}">{{ $record->category?->name }}</a>
                                                    @endif
                                                @endif
                                            </li>
                                        @else
                                            <li class="author">
                                                Category <select class="form-select bg-light" name="category_id"
                                                                 id="category_id" aria-label="Category">
                                                    <option value="{{ null }}">Category</option>
                                                    @if(!empty($category_list))
                                                        @foreach($category_list as $item)
                                                            <option
                                                                value="{{ $item->id }}" {{ (old('category_id') && old('category_id') == $item->id) || (isset($record) && $record->category_id == $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </li>
                                        @endif
                                        @if(!empty($userPage))
                                            @if(!empty($record))
                                                <li class="date">
                                                    <span class="material-icons-outlined">calendar_month</span>
                                                    <input type="text"
                                                           class="form-control form-control-solid-bordered m-b-sm flatpickr2 bg-light"
                                                           name="publish_date" id="publish_date"
                                                           placeholder="Publish Date"
                                                           style="max-width: 170px;"
                                                           value="{{ old('publish_date') ?? ($record->publish_date ?? '') }}">
                                                </li>
                                            @endif
                                        @else
                                            @if(!empty($record->publish_date))
                                                <li class="date">
                                                    @php
                                                        $record_publish_date = \Illuminate\Support\Carbon::parse($record->publish_date)->format('d M Y');
                                                    @endphp
                                                    <span class="material-icons-outlined">calendar_month</span>
                                                    <time
                                                        datetime="{{ $record_publish_date }}">{{ $record_publish_date }}</time>
                                                </li>
                                            @endif
                                        @endif
                                        <li class="read_time">
                                            <span class="material-icons-outlined">schedule</span>
                                            @if(!empty($userPage))
                                                <input type="number"
                                                       class="form-control form-control-solid-bordered m-b-sm"
                                                       name="read_time" id="read_time" placeholder="Article Read Time"
                                                       style="max-width: 70px;" min="1"
                                                       value="{{ old('read_time') ?? ($record->read_time ?? '') }}">
                                                min.
                                            @else
                                                {{ $record->read_time ?? '' }} min.
                                            @endif
                                        </li>
                                        @if(!empty($record))
                                            <li class="view-count">
                                                <span
                                                    class="material-icons-outlined">visibility</span>{{ $record->view_count ?? '' }}
                                            </li>
                                            <li class="like-count">
                                                @if(!empty($userPage))
                                                    <span class="material-icons-outlined">favorite_border</span>
                                                @else
                                                    @csrf
                                                    <a href="{{ route('article.like') }}" data-id="{{ $record->id }}"
                                                       class="btn btn-like">
                                                    <span
                                                        class="material-icons-outlined">{{ !empty($userLike) ? 'favorite' : 'favorite_border' }}</span></a>
                                                @endif
                                                <span class="number">{{ $record->like_count ?? 0 }}</span>
                                            </li>
                                        @endif
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
                                        @if(!empty($userPage))
                                            <div class="mb-3">
                                                <label for="image" class="form-label mb-0">Image</label>
                                                <input type="file" name="image" id="image"
                                                       class="form-control form-control-solid-bordered"
                                                       accept="image/png, image/jpeg, image/jpg">
                                            </div>
                                        @endif
                                        @if(!empty($userPage))
                                            <textarea class="summernote form-control form-control-solid-bordered m-b-sm"
                                                      name="body" id="body" rows="3" placeholder="Description"
                                                      required>{!! old('body') ?? ($record->body ?? '') !!}</textarea>
                                        @else
                                            {!! $record->body ?? '' !!}
                                        @endif
                                    </div>
                                </div>
                            </section>
                            <div class="article-detail-bottom {{ !empty($userPage) ? 'mb-2' : '' }}" data-aos="fade-up">
                                <div class="tag-share-wrap">
                                    <div class="tag-wrap">
                                        <h4 class="mb-2">Tags:</h4>
                                        @if(!empty($userPage))
                                            <select
                                                class="form-control js-example-tokenizer" multiple="multiple"
                                                name="tags[]"
                                                id="tags" tabindex="-1" style="display: none; width: 100%"
                                                data-allow-clear="true">
                                                @if((!empty($record->tags) && is_array($record->tags)) || (old('tags') && is_array(old('tags'))))
                                                    @php
                                                        $tag_list = $record->tags ?? old('tags');
                                                    @endphp
                                                    @foreach($tag_list as $item)
                                                        <option value="{{ $item }}" selected>{{ $item }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        @else
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
                                        @endif
                                    </div>
                                    @if(empty($userPage))
                                        <div class="share-wrap">
                                            <h4 class="mb-2">Share:</h4>
                                            <div class="social-list">
                                                <ul>
                                                    <li class="facebook">
                                                        <a aria-label="Learn more from Facebook"
                                                           href="https://facebook.com/">
                                                            <i class="fa-brands fa-facebook-f"></i>
                                                        </a>
                                                    </li>
                                                    <li class="instagram">
                                                        <a aria-label="Learn more from Instagram"
                                                           href="https://instagram.com/">
                                                            <i class="fa-brands fa-instagram"></i>
                                                        </a>
                                                    </li>
                                                    <li class="twitter">
                                                        <a aria-label="Learn more from Twitter"
                                                           href="https://twitter.com/">
                                                            <i class="fa-brands fa-twitter"></i>
                                                        </a>
                                                    </li>
                                                    <li class="pinterest">
                                                        <a aria-label="Learn more from Pinterest"
                                                           href="https://pinterest.com/">
                                                            <i class="fa-brands fa-pinterest-p"></i>
                                                        </a>
                                                    </li>
                                                    <li class="linkedin">
                                                        <a aria-label="Learn more from Linkedin"
                                                           href="https://linkedin.com/">
                                                            <i class="fa-brands fa-linkedin-in"></i>
                                                        </a>
                                                    </li>
                                                    <li class="youtube">
                                                        <a aria-label="Learn more from Youtube"
                                                           href="https://youtube.com/">
                                                            <i class="fa-brands fa-youtube"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @if(!empty($userPage))
                                <div class="article-detail-bottom mt-0" data-aos="fade-up">
                                    <div class="form-floating mb-3">
                                <textarea class="form-control" name="seo_keywords" id="seo_keywords"
                                          style="height: 150px;"
                                          placeholder="SEO Keywords">{{ old('seo_keywords') ?? ($record->seo_keywords ?? '') }}</textarea>
                                        <label for="seo_keywords" class="form-label">SEO Keywords</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                <textarea class="form-control" name="seo_description" id="seo_description"
                                          style="height: 150px;"
                                          placeholder="SEO Description">{{ old('seo_description') ?? ($record->seo_description ?? '') }}</textarea>
                                        <label for="seo_description" class="form-label">SEO Description</label>
                                    </div>
                                    @if(!empty($record))
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" name="status"
                                                   id="status"
                                                {{ old('status') || !empty($record->status) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status">Article Status</label>
                                        </div>
                                    @endif
                                    <hr>
                                    <div class="col-12">
                                        <div class="d-flex flex-row justify-content-between">
                                            <button class="btn btn-primary d-flex align-items-center" type="submit">
                                                <i class="material-icons me-1">done</i>{{ !empty($record) ? 'Save' : 'Publish' }}
                                            </button>
                                            @if(!empty($record))
                                                @csrf
                                                <a href="{{ route('user.article.delete') }}"
                                                   data-id="{{ $record->id ?? '' }}"
                                                   class="btnDeleteArticle btn btn-danger d-flex align-items-center">
                                                    <i class="material-icons me-1">delete_forever</i>Delete
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if(!empty($userPage))
                        </form>
                    @endif
                    @if(empty($userPage))
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
                    @endif
                    @if(!empty($record->comments))
                        <x-web.section-comments
                            :comments="$record->comments"
                            :commentsCount="$record->commentsCount"
                            :userPage="$userPage ?? false"></x-web.section-comments>
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
    <script src="{{ asset("assets/plugins/aos/aos.js") }}"></script>
    <script src="{{ asset("assets/plugins/highlight/highlight.min.js") }}"></script>
    @if(!empty($userPage))
        <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/pages/select2.js') }}"></script>
        <script src="{{ asset('assets/plugins/flatpickr/flatpickr.js') }}"></script>
        <script src="{{ asset('assets/admin/js/pages/datepickers.js') }}"></script>
        <script src="{{ asset('assets/plugins/summernote/summernote-lite.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/summernote/lang/summernote-tr-TR.js') }}"></script>
        <script src="{{ asset('assets/admin/js/pages/text-editor.js') }}"></script>
    @else
        <script src="{{ asset("assets/plugins/swiper/swiper-bundle.min.js") }}"></script>
        <script src="{{ asset("assets/plugins/waitMe/waitMe.min.js") }}"></script>
    @endif
    <script>
        $(document).ready(function () {
            AOS.init();
            hljs.highlightAll();
            @if(!empty($userPage))
            $('.btnDeleteArticle').on("click", function (e) {
                e.preventDefault();
                let $this = $(this);
                Swal.fire({
                    text: 'Do you want to delete this article?',
                    icon: 'error',
                    showCancelButton: true,
                    cancelButtonColor: '#babbbd',
                    confirmButtonColor: '#ff6673',
                    confirmButtonText: 'Yes',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = $this.attr('href');
                        let recordId = $this.data('id');
                        $.ajax({
                            url: url,
                            type: "POST",
                            headers: {'X-CSRF-TOKEN': $this.prev('input[name="_token"]').val()},
                            dataType: "JSON",
                            data: {'id': recordId}
                        }).done(function (response) {
                            if (response.hasOwnProperty('status')) {
                                if (response.status) {
                                    $("form button").prop("disabled", true);
                                }
                            }
                        });
                    }
                });
            })
            @else
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
            @endif
        });
    </script>
@endsection
