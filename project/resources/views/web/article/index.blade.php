@extends("web.layouts.index")
@section("style")
    <link href="{{ asset('assets/web/css/components/sidebar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/web/css/pages/articles.min.css') }}" rel="stylesheet">
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
                                @foreach($records as $record)
                                    <div class="col-xl-4">
                                        <x-web.item-article
                                            :record="$record"
                                            :articleItemAttributes="'data-aos=flip-down'"
                                            :articleCategoryLinkAttributes="'data-aos=flip-right data-aos-easing=ease-out-cubic data-aos-duration=2500'"></x-web.item-article>
                                    </div>
                                @endforeach
                                @if($records->lastPage() > 1)
                                    <div class="col-12">
                                        <div class="pagination-section">
                                            {{ $records->links() }}
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </section>
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
    <script src="{{ asset("assets/web/js/components/sidebar.js") }}"></script>
    <script src="{{ asset("assets/plugins/aos/aos.js") }}"></script>
    <script>
        $(document).ready(function () {
            AOS.init();
        });
    </script>
@endsection
