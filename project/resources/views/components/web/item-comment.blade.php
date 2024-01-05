<div
    class="comment-item {{ $item->children?->count() > 0 ? 'has-child' : '' }} {{ $item->is_deleted ? 'deleted' : '' }}"
    {{ isset($commentItemAOS) ? 'data-aos='.$commentItemAOS : '' }}>
    <div class="header">
        <div class="image">
            <img src="{{ $item->user->image }}" alt="{{ $item->user->name }} Profile Image">
        </div>
    </div>
    <div class="content">
        <div class="header">
            <h4 class="title">{{ $item->user->name }}</h4>
            <div class="btn-actions">
                <div class="action-like-comment">
                    @csrf
                    <a href="{{ route('article.comment.like') }}"
                       class="btn btn-like-comment {{ !is_null($item->currentUserLiked) ? 'active' : '' }}"
                       {{ $item->is_deleted ? '' : 'data-id='.$item->id.' data-type=like' }} rel="nofollow">
                        <span
                            class="{{ !is_null($item->currentUserLiked) ? 'material-icons' : 'material-icons-outlined' }}">thumb_up</span></a>
                    <span class="number">{{ $item->like_count ?? 0 }}</span>
                </div>
                <div class="action-dislike-comment">
                    @csrf
                    <a href="{{ route('article.comment.dislike') }}"
                       class="btn btn-dislike-comment {{ !is_null($item->currentUserDisliked) ? 'active' : '' }}"
                       {{ $item->is_deleted ? '' : 'data-id='.$item->id.' data-type=dislike' }} rel="nofollow">
                        <span
                            class="{{ !is_null($item->currentUserDisliked) ? 'material-icons' : 'material-icons-outlined' }}">thumb_down</span></a>
                    <span class="number">{{ $item->dislike_count ?? 0 }}</span>
                </div>
                <div class="action-reply-comment">
                    <a href="javascript:;" class="btn btn-reply-comment"
                       {{ $item->is_deleted ? '' : 'data-id='.$item->id }} rel="nofollow">
                        <span class="material-icons align-middle">reply</span>Reply</a>
                </div>
            </div>
        </div>
        <div class="meta">
            <span class="date">{{ $item->created_at }}</span>
        </div>
        <p class="comment">{{ $item->comment }}</p>
    </div>
</div>
