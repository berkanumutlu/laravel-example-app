@php
    $record_url = !empty($record->slug) ? route('article.detail', ['slug' => $record->slug]) : '';
@endphp
<div class="article-item" {{ $articleItemAttributes ?? '' }}>
    <div class="article-item-image-section">
        <a href="{{ $record_url }}" class="article-item-image-link">
            <img src="{{ asset($record->image) }}" class="article-item-image img-fluid" alt="{{ $record->title }}">
        </a>
        <a href="{{ route('article.category', ['slug' => $record->category?->slug]) }}"
           class="btn btn-danger article-item-category" {{ $articleCategoryLinkAttributes ?? '' }}>{{ $record->category?->name }}</a>
    </div>
    <div class="article-item-body">
        <div class="author">
            Author: <a href="#">{{ $record->user?->name }}</a>
        </div>
        <div class="title">
            <a href="{{ $record_url }}"><h4>{{ $record->title }}</h4></a>
        </div>
        <div class="date">
            <p>{{ $record->publish_date }}</p>
            <p class="ms-3">&#x25CF;{{ $record->read_time }} min</p>
        </div>
    </div>
</div>
