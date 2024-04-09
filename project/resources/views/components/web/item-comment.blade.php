<div
    class="comment-item {{ $item->children?->count() > 0 ? 'has-child' : '' }} {{ $item->is_deleted ? 'deleted' : '' }}"
    {{ isset($commentItemAOS) ? 'data-aos='.$commentItemAOS : '' }}>
    <div class="header">
        <div class="image">
            @if(!empty($item->user->image))
                <img data-src="{{ asset($item->user->image) }}" class="lazyload" loading="lazy"
                     alt="{{ $item->user->name }} Profile Image">
            @elseif(!empty($settings->image_default_author))
                <img data-src="{{ asset($settings->image_default_author) }}" class="lazyload" loading="lazy"
                     alt="Default Profile Image">
            @endif
        </div>
    </div>
    <div class="content">
        <div class="header">
            <h4 class="title">{{ $item->user->name }}</h4>
            <div class="btn-actions">
                <div class="action-like-comment">
                    @if(empty($userPage))
                        @csrf
                        <a href="{{ route('article.comment.like') }}"
                           class="btn btn-like-comment {{ !is_null($item->currentUserLiked) ? 'active' : '' }}"
                           {{ $item->is_deleted ? '' : 'data-id='.$item->id.' data-type=like' }} rel="nofollow">
                        <span
                            class="{{ !is_null($item->currentUserLiked) ? 'material-icons' : 'material-icons-outlined' }}">thumb_up</span></a>
                    @else
                        <a href="javascript:;" class="btn"><span class="material-icons-outlined">thumb_up</span></a>
                    @endif
                    <span class="number">{{ $item->like_count ?? 0 }}</span>
                </div>
                <div class="action-dislike-comment">
                    @if(empty($userPage))
                        @csrf
                        <a href="{{ route('article.comment.dislike') }}"
                           class="btn btn-dislike-comment {{ !is_null($item->currentUserDisliked) ? 'active' : '' }}"
                           {{ $item->is_deleted ? '' : 'data-id='.$item->id.' data-type=dislike' }} rel="nofollow">
                        <span
                            class="{{ !is_null($item->currentUserDisliked) ? 'material-icons' : 'material-icons-outlined' }}">thumb_down</span></a>
                    @else
                        <a href="javascript:;" class="btn"><span class="material-icons-outlined">thumb_down</span></a>
                    @endif
                    <span class="number">{{ $item->dislike_count ?? 0 }}</span>
                </div>
                @if(empty($userPage))
                    <div class="action-reply-comment">
                        <a href="javascript:;" class="btn btn-reply-comment"
                           {{ $item->is_deleted ? '' : 'data-id='.$item->id }} rel="nofollow">
                            <span class="material-icons align-middle">reply</span>Reply</a>
                    </div>
                @endif
            </div>
        </div>
        <div class="meta">
            <span class="date">{{ $item->created_at }}</span>
        </div>
        <p class="comment">{{ $item->comment }}</p>
    </div>
</div>
@pushonce("scripts")
    <script>
        $(document).ready(function () {
            $('.btn-like-comment, .btn-dislike-comment').on("click", function (e) {
                e.preventDefault();
                let self = $(this);
                self.attr('disabled', true);
                @if(auth()->guard('web')->check())
                $.ajax({
                    url: self.attr('href'),
                    type: "POST",
                    headers: {'X-CSRF-TOKEN': self.prev('input[name="_token"]').val()},
                    dataType: "JSON",
                    data: {recordId: self.data('id'), type: self.data('type')}
                }).done(function (response) {
                    if (response.hasOwnProperty('status')) {
                        if (response.status) {
                            if (response.hasOwnProperty('data')) {
                                if (response.data.hasOwnProperty('active')) {
                                    self.parents('.btn-actions').find('.btn-like-comment, .btn-dislike-comment').removeClass('active');
                                    self.parents('.btn-actions').find('.btn-like-comment, .btn-dislike-comment').find('span').removeClass().addClass('material-icons-outlined');
                                    if (response.data.active) {
                                        self.addClass('active');
                                    } else {
                                        self.removeClass('active');
                                    }
                                }
                                if (response.data.hasOwnProperty('like_count')) {
                                    self.parents('.btn-actions').find('.action-like-comment .number').text(response.data.like_count);
                                }
                                if (response.data.hasOwnProperty('dislike_count')) {
                                    self.parents('.btn-actions').find('.action-dislike-comment .number').text(response.data.dislike_count);
                                }
                                if (response.data.hasOwnProperty('iconClass')) {
                                    self.find('span').removeClass().addClass(response.data.iconClass);
                                }
                            }
                        }
                    }
                });
                @else
                Swal.fire({
                    html: 'You need to logged in to take any action on the comment.',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false,
                    icon: 'warning'
                });
                @endif
            });
        });
    </script>
@endpushonce
