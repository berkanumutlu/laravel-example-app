@if(!empty($settings->show_sidebar_categories) && !empty($categories))
    <section class="sidebar sidebar-right category-list" data-aos="fade-left">
        <div class="title-section">
            <h4 class="title">Categories</h4>
        </div>
        <div class="content">
            <ul class="list-group list-unstyled">
                @foreach($categories as $item)
                    <li class="list-group-item">
                        <a href="{{ route('article.category', ['slug' => $item->slug]) }}"
                           class="list-group-item-action">{{ $item->name }}
                            <span class="float-end me-3" style="color: {{ $item->color }}">&#x25CF;</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endif
@if(!empty($settings->show_sidebar_videos))
    <section class="sidebar-video mt-4">
        <div class="row">
            <div class="col-12">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide" data-aos="zoom-in-up">
                            <iframe width="100%" height="250"
                                    src="https://www.youtube.com/embed/fEErySYqItI"
                                    title="Into The Nature - Cinematic Travel Video | Sony a6300"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen></iframe>
                        </div>
                        <div class="swiper-slide" data-aos="zoom-in-up">
                            <iframe width="100%" height="250"
                                    src="https://www.youtube.com/embed/bjxTIcuzB6k?si=gl7wHywarxjEHiDC"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen></iframe>
                        </div>
                        <div class="swiper-slide" data-aos="zoom-in-up">
                            <iframe width="100%" height="250"
                                    src="https://www.youtube.com/embed/TATT6toJrdY?list=PLe6YKWr4VVM1x2LIpiqmVvG4QgIvoDEdO"
                                    title="No copyright music | Copyright-free nature video | Copyright-free nature music for YouTube videos"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen></iframe>
                        </div>
                        <div class="swiper-slide" data-aos="zoom-in-up">
                            <iframe width="100%" height="250"
                                    src="https://www.youtube.com/embed/73GcBPduYE4?list=PLe6YKWr4VVM1x2LIpiqmVvG4QgIvoDEdO"
                                    title="copyright free music | No copyright music cinematic video | free nature video no copyright | Clips"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                <div class="custom-pagination text-end my-2">
                                    <span
                                        class="custom-swiper-button-prev material-icons-outlined btn btn-secondary"
                                        data-aos="fade-right">arrow_back</span>
                    <span
                        class="custom-swiper-button-next material-icons-outlined btn btn-secondary"
                        data-aos="fade-left">arrow_forward</span>
                </div>
            </div>
        </div>
    </section>
@endif
@if(!empty($settings->show_sidebar_authors))
    <section class="sidebar-authors mt-2">
        <div class="row">
            <div class="col-12">
                <h2 class="font-weight-600">Authors</h2>
            </div>
            <div class="col-12">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide" data-aos="zoom-in-left">
                            <a href="#" class="author-link">
                                <div class="author-image"
                                     style="background-image: url('{{ !empty($settings->image_default_author) ? asset($settings->image_default_author) : '' }}')"></div>
                                <div class="author-name">Berkan Ümütlü</div>
                            </a>
                        </div>
                        <div class="swiper-slide" data-aos="zoom-in-left">
                            <a href="#" class="author-link">
                                <div class="author-image"
                                     style="background-image: url('{{ !empty($settings->image_default_author) ? asset($settings->image_default_author) : '' }}')"></div>
                                <div class="author-name">Author2</div>
                            </a>
                        </div>
                        <div class="swiper-slide" data-aos="zoom-in-left">
                            <a href="#" class="author-link">
                                <div class="author-image"
                                     style="background-image: url('{{ !empty($settings->image_default_author) ? asset($settings->image_default_author) : '' }}')"></div>
                                <div class="author-name">Author3</div>
                            </a>
                        </div>
                        <div class="swiper-slide" data-aos="zoom-in-left">
                            <a href="#" class="author-link">
                                <div class="author-image"
                                     style="background-image: url('{{ !empty($settings->image_default_author) ? asset($settings->image_default_author) : '' }}')"></div>
                                <div class="author-name">Author4</div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="custom-pagination text-end my-2">
                    <span class="custom-swiper-button-prev material-icons-outlined btn btn-secondary"
                          data-aos="fade-right">arrow_back</span>
                    <span class="custom-swiper-button-next material-icons-outlined btn btn-secondary"
                          data-aos="fade-left">arrow_forward</span>
                </div>
            </div>
        </div>
    </section>
@endif
