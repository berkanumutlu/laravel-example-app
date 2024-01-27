@php
    $item_url = !empty($item->slug) ? route('article.detail', ['slug' => $item->slug]) : '';
@endphp
<div class="article-item" {{ $articleItemAttributes ?? '' }}>
    <div class="article-item-image-section">
        <a href="{{ $item_url }}" class="article-item-image-link">
            <img src="{{ asset($item->image) }}" class="article-item-image img-fluid" alt="{{ $item->title }}">
        </a>
        <a href="{{ route('article.category', ['slug' => $item->category?->slug]) }}"
           class="btn btn-danger article-item-category" {{ $articleCategoryLinkAttributes ?? '' }}>{{ $item->category?->name }}</a>
    </div>
    <div class="article-item-body">
        <div class="author">
            by <a href="#">{{ $item->user?->name }}</a>
        </div>
        <div class="title">
            <a href="{{ $item_url }}"><h4>{{ $item->title }}</h4></a>
        </div>
        <div class="date">
            <p>{{ $item->publish_date }}</p>
            <p class="ms-3">&#x25CF;{{ $item->read_time }} min</p>
        </div>
    </div>
</div>
