@php
    $item_url = '';
    if (!empty($item->slug)) {
        if (!empty($userPage)) {
            $item_url =  route('user.article.detail', ['article' => $item->slug]);
        } else {
            $item_url =  route('article.detail', ['slug' => $item->slug]);
        }
    }
    $item_image = $item->image;
    if (empty($item_image) && !empty($settings->image_default_article)) {
        $item_image = $settings->image_default_article;
    }
    $item_publish_date = \Illuminate\Support\Carbon::parse($item->publish_date)->format('d M Y');
@endphp
<div
    class="article-item {{ !empty($userPage) && $item->status == 0 ? 'disabled' : '' }}" {{ $articleItemAttributes ?? '' }}>
    <div class="article-item-image-section">
        <a href="{{ $item_url }}" class="article-item-image-link">
            <img data-src="{{ asset($item_image) }}" class="article-item-image img-fluid lazyload" loading="lazy"
                 alt="{{ $item->title }}">
        </a>
        @if(!is_null($item->category))
            <a href="{{ route('article.category', ['slug' => $item->category?->slug]) }}"
               class="btn btn-danger article-item-category" {{ $articleCategoryLinkAttributes ?? '' }}>{{ $item->category?->name }}</a>
        @endif
    </div>
    <div class="article-item-body">
        @if(!empty($item->user))
            <div class="author">
                by <a href="{{ route('article.author', ['user' => $item->user]) }}">{{ $item->user?->name }}</a>
            </div>
        @endif
        <div class="title">
            <a href="{{ $item_url }}"><h4>{{ $item->title }}</h4></a>
        </div>
        <div class="date">
            <p>{{ $item_publish_date }}</p>
            <p class="ms-3">&#x25CF;{{ $item->read_time }} min</p>
        </div>
    </div>
</div>
@pushonce("style")
    <link href="{{ asset('assets/web/css/components/article-item.min.css') }}" rel="stylesheet">
@endpushonce
