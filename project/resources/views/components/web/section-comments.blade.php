<section class="comments" data-aos="fade-up">
    <h3 class="title {{ !empty($commentsCount) ? '' : 'no-comment' }}">{{ !empty($commentsCount) ? $commentsCount.' comments' : '0 comment' }}</h3>
    @if(!empty($commentsCount))
        <div class="list">
            <ul>
                @foreach($comments as $item)
                    <li>
                        <x-web.item-comment :item="$item"></x-web.item-comment>
                        @if($item->children?->count() > 0)
                            <ul class="child" data-aos="fade-up" data-aos-duration="1000">
                                @foreach($item->children as $child)
                                    <li>
                                        <x-web.item-comment :item="$child"></x-web.item-comment>
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
