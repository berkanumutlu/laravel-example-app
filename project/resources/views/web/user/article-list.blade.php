@extends("web.layouts.index")
@section("style")
    <link href="{{ asset('assets/web/css/pages/user-profile.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/web/css/pages/articles.min.css') }}" rel="stylesheet">
@endsection
@section("content")
    <main class="py-5">
        <div class="container">
            <div class="card user-profile-card mb-3">
                <div class="card-header">
                    <h1 class="card-title">Article List</h1>
                    <p class="card-text">List of articles you've created. Total of {{ $article_list->total() }} records
                        were found.</p>
                </div>
            </div>
            <div class="row">
                @if(!empty($article_list))
                    @foreach($article_list as $item)
                        <div class="col-xl-3">
                            <x-web.item-article
                                :item="$item"
                                :articleItemAttributes="'data-aos=flip-down'"
                                :articleCategoryLinkAttributes="'data-aos=flip-right data-aos-easing=ease-out-cubic data-aos-duration=2500'"
                                :userPage="true"></x-web.item-article>
                        </div>
                    @endforeach
                    @if($article_list->lastPage() > 1)
                        <div class="col-12">
                            <div class="pagination-section">
                                {{ $article_list->links() }}
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </main>
@endsection
@section("scripts")

@endsection
