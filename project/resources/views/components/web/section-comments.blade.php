<section class="comments" data-aos="fade-up">
    <h3 class="title {{ !empty($commentsCount) ? '' : 'no-comment' }}">{{ !empty($commentsCount) ? $commentsCount.' comments' : '0 comment' }}</h3>
    @if(!empty($commentsCount))
        <div class="list">
            <ul>
                @foreach($comments as $item)
                    <li>
                        <x-web.item-comment :item="$item" :commentItemAOS="'fade-up'"></x-web.item-comment>
                        @if($item->children?->count() > 0)
                            <ul class="child" data-aos="fade-up" data-aos-duration="1000">
                                @foreach($item->children as $child)
                                    <li>
                                        <x-web.item-comment
                                            :item="$child"
                                            :commentItemAOS="'fade-left'"></x-web.item-comment>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</section>
@push("scripts")
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
@endpush
