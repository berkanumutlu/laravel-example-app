<section class="author" data-aos="fade-up">
    <div class="author-card">
        <div class="author-thumb">
            <div class="author-image">
                @php
                    $author_image = $authorImage;
                    $is_author_image_null = false;
                    if (empty($author_image)) {
                        $author_image = $settings->image_default_author;
                        $is_author_image_null = true;
                    }
                    $author_name = $authorName ?? 'Author';
                @endphp
                @if(Route::is('user.profile'))
                    <img data-src="{{ asset($author_image) }}"
                         data-src-default="{{ asset($settings->image_default_author) }}"
                         class="lazyload reload_image_file" loading="lazy"
                         alt="{{ $author_name }} Image" width="120" height="120">
                    <input type="file" name="image" id="image" class="d-none reload_image_file_input"
                           accept="image/png, image/jpeg, image/jpg">
                    <a href="javascript:;" class="edit-author-image"><i class="fa-solid fa-camera-rotate"></i></a>
                    <input type="text" name="image_file_deleted" class="d-none"
                           value="{!! $is_author_image_null ? 1 : 0 !!}">
                    <a href="javascript:;" class="delete-author-image"
                        {!! $is_author_image_null ? 'style="display:none"' : '' !!}>
                        <i class="fa-regular fa-trash-can"></i></a>
                @else
                    <img data-src="{{ asset($author_image) }}" class="lazyload" loading="lazy"
                         alt="{{ $author_name }} Image" width="120" height="120">
                @endif
            </div>
        </div>
        <div class="author-content">
            <h4 class="name">{{ $author_name }}</h4>
            <div class="designation">{{ $authorTitle ?? '' }}</div>
            <div class="description">{!! $authorDescription ?? '' !!}</div>
            @if(Route::is('user.profile'))
                <div class="socials">
                    <ul class="social-list">
                        <li class="social-item website" {!! !empty($authorWebsite) ? '' : 'style="display:none"' !!}>
                            <a aria-label="Learn more from my website" href="{{ $authorWebsite }}" target="_blank"
                               rel="nofollow"><i class="fa-solid fa-globe"></i></a>
                        </li>
                        @if($authorSocials->count() > 0)
                            @php
                                $user_socials = $authorSocials->pluck('link','social_id')->toArray();
                            @endphp
                            @foreach($authorSocials as $item)
                                @php
                                    $item_social_name = $item->social?->name;
                                    $item_social_name_lowercase = \Illuminate\Support\Str::lower($item_social_name);
                                @endphp
                                <li class="social-item {{ $item_social_name_lowercase }}" {!! !empty($user_socials[$item->social_id]) ? '' : 'style="display:none"' !!}>
                                    <a aria-label="Learn more from {{ $item_social_name }}" href="{{ $item->link }}"
                                       target="_blank" rel="nofollow">
                                        <i class="fa-brands fa-{{ $item_social_name_lowercase }}"></i></a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            @elseif($authorSocials->count() > 0 || !empty($authorWebsite))
                <div class="socials">
                    <ul class="social-list">
                        @if(!empty($authorWebsite))
                            <li class="social-item website">
                                <a aria-label="Learn more from my website" href="{{ $authorWebsite }}" target="_blank"
                                   rel="nofollow"><i class="fa-solid fa-globe"></i></a>
                            </li>
                        @endif
                        @if($authorSocials->count() > 0)
                            @foreach($authorSocials as $item)
                                @if(!empty($item->link))
                                    @php
                                        $item_social_name = $item->social?->name;
                                        $item_social_name_lowercase = \Illuminate\Support\Str::lower($item_social_name);
                                    @endphp
                                    <li class="social-item {{ $item_social_name_lowercase }}">
                                        <a aria-label="Learn more from {{ $item_social_name }}" href="{{ $item->link }}"
                                           target="_blank" rel="nofollow">
                                            <i class="fa-brands fa-{{ $item_social_name_lowercase }}"></i></a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </div>
            @endif
        </div>
    </div>
</section>
@pushonce("style")
    <link href="{{ asset('assets/web/css/components/author-card.min.css') }}" rel="stylesheet">
@endpushonce
@if(Route::is('user.profile'))
    @pushonce("scripts")
        <script>
            $(document).ready(function () {
                $(".edit-author-image").on("click", function (e) {
                    e.preventDefault();
                    $("#image").trigger('click');
                });
                $(".delete-author-image").on("click", function (e) {
                    e.preventDefault();
                    let image_file = $('.reload_image_file');
                    let image_file_input = $('.reload_image_file_input');
                    let image_file_src = image_file.attr('src');
                    let image_file_data_src = image_file.data('src');
                    let is_image_changed = image_file_src !== image_file_data_src;
                    let image_file_data_src_default = image_file.data('src-default');
                    let image_file_deleted = $('input[name="image_file_deleted"]');
                    let is_exist_image_deleted = image_file_deleted.val();
                    let swal_text = '';
                    if (is_image_changed) {
                        swal_text = 'Do you want to delete the image you uploaded?';
                    } else {
                        swal_text = 'Do you want to delete the existing image?';
                    }
                    Swal.fire({
                        text: swal_text,
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
                            image_file_input.val('');
                            if (is_image_changed && is_exist_image_deleted == 0) {
                                image_file.attr('src', image_file_data_src);
                            } else {
                                image_file.attr('src', image_file_data_src_default);
                                image_file_deleted.val(1);
                                $(this).hide();
                            }
                        }
                    });
                });
            });
        </script>
    @endpushonce
@endif
