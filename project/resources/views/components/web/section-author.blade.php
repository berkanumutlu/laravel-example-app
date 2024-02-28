<section class="author" data-aos="fade-up">
    <div class="author-card">
        <div class="author-thumb">
            <div class="author-image">
                @php
                    $author_image = $authorImage ?? $settings->image_default_author;
                    $author_name = $authorName ?? 'Author';
                @endphp
                <img data-src="{{ asset($author_image) }}" class="lazyload" loading="lazy"
                     alt="{{ $author_name }} Image" width="120" height="120">
                @if(Route::is('user.profile'))
                    <a href="javascript:;" class="edit-author-image"><i class="fa-solid fa-camera-rotate"></i></a>
                    <a href="javascript:;" class="delete-author-image"><i class="fa-regular fa-trash-can"></i></a>
                @endif
            </div>
        </div>
        <div class="author-content">
            <h4 class="name">{{ $author_name }}</h4>
            <div class="designation">{{ $authorTitle ?? '' }}</div>
            <div class="description">{!! $authorDescription ?? '' !!}</div>
            <div class="socials">
                <ul>
                    <li class="website">
                        <a aria-label="Learn more from my website" href="https://example.com" target="_blank"
                           rel="nofollow"><i class="fa-solid fa-globe"></i></a>
                    </li>
                    <li class="instagram">
                        <a aria-label="Learn more from Instagram" href="https://instagram.com" target="_blank"
                           rel="nofollow"><i class="fa-brands fa-instagram"></i></a>
                    </li>
                    <li class="twitter">
                        <a aria-label="Learn more from Twitter" href="https://twitter.com" target="_blank"
                           rel="nofollow"><i class="fa-brands fa-twitter"></i></a>
                    </li>
                    <li class="facebook">
                        <a aria-label="Learn more from Facebook" href="https://facebook.com" target="_blank"
                           rel="nofollow"><i class="fa-brands fa-facebook"></i></a>
                    </li>
                    <li class="youtube">
                        <a aria-label="Learn more from Youtube" href="https://youtube.com" target="_blank"
                           rel="nofollow"><i class="fa-brands fa-youtube"></i></a>
                    </li>
                    <li class="google">
                        <a aria-label="Learn more from Google" href="https://google.com" target="_blank" rel="nofollow">
                            <i class="fa-brands fa-google"></i></a>
                    </li>
                    <li class="whatsapp">
                        <a aria-label="Contact us on Whatsapp" href="https://whatsapp.com" target="_blank"
                           rel="nofollow"><i class="fa-brands fa-whatsapp"></i></a>
                    </li>
                    <li class="telegram">
                        <a aria-label="Contact us on Telegram" href="https://telegram.org" target="_blank"
                           rel="nofollow"><i class="fa-brands fa-telegram"></i></a>
                    </li>
                    <li class="skype">
                        <a aria-label="Contact us on Skype" href="https://skype.com" target="_blank" rel="nofollow">
                            <i class="fa-brands fa-skype"></i></a>
                    </li>
                    <li class="linkedin">
                        <a aria-label="Learn more from LinkedIn" href="https://www.linkedin.com/in/berkanumutlu"
                           target="_blank" rel="nofollow"><i class="fa-brands fa-linkedin"></i></a>
                    </li>
                    <li class="github">
                        <a aria-label="Learn more from Github" href="https://github.com/berkanumutlu" target="_blank"
                           rel="nofollow"><i class="fa-brands fa-github"></i></a>
                    </li>
                    <li class="medium">
                        <a aria-label="Learn more from Medium" href="https://medium.com/@berkanumutlu" target="_blank"
                           rel="nofollow"><i class="fa-brands fa-medium"></i></a>
                    </li>
                    <li class="pinterest">
                        <a aria-label="Learn more from Pinterest" href="https://pinterest.com" target="_blank"
                           rel="nofollow"><i class="fa-brands fa-pinterest"></i></a>
                    </li>
                    <li class="tumblr">
                        <a aria-label="Learn more from Tumblr" href="https://tumblr.com" target="_blank" rel="nofollow">
                            <i class="fa-brands fa-tumblr"></i></a>
                    </li>
                    <li class="dribbble">
                        <a aria-label="Learn more from Dribbble" href="https://dribbble.com/berkanumutlu"
                           target="_blank" rel="nofollow"><i class="fa-brands fa-dribbble"></i></a>
                    </li>
                    <li class="wordpress">
                        <a aria-label="Learn more from Wordpress" href="https://wordpress.com" target="_blank"
                           rel="nofollow"><i class="fa-brands fa-wordpress"></i></a>
                    </li>
                    <li class="discord">
                        <a aria-label="Join our Discord" href="https://discord.com" target="_blank" rel="nofollow">
                            <i class="fa-brands fa-discord"></i></a>
                    </li>
                    <li class="paypal">
                        <a aria-label="Donate on Paypal" href="https://paypal.com" target="_blank" rel="nofollow">
                            <i class="fa-brands fa-paypal"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
@push("style")
    <link href="{{ asset('assets/web/css/components/author-card.min.css') }}" rel="stylesheet">
@endpush
@if(Route::is('user.profile'))
    @push("scripts")
        <script>
            $(document).ready(function () {
                $(".edit-author-image").on("click", function () {
                    $("#image").trigger('click');
                });
            });
        </script>
    @endpush
@endif
