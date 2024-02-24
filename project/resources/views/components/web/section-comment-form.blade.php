<section class="comment-form" data-aos="fade-up">
    <div class="header">
        @if(!empty($headerTitle))
            <h3 class="title">{!! $headerTitle !!}</h3>
        @endif
        @if(!empty($headerDescription))
            <p class="description">{!! $headerDescription !!}</p>
        @endif
    </div>
    <div class="form">
        <form action="{{ $formAction ?? '' }}" method="{{ $formMethod ?? 'GET' }}">
            @csrf
            <input type="hidden" name="comment_id" value="">
            <div class="reply-comment" data-aos="fade-left">
                <div class="header">
                    <h3 class="title"><i class="material-icons-outlined me-1">reply</i>Reply</h3>
                    <div class="action-remove-reply-comment">
                        <a href="javascript:;" class="btn btn-remove-reply-comment" rel="nofollow">
                            <span class="material-icons align-middle">cancel</span></a>
                    </div>
                </div>
                <div class="comment-item"></div>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <input type="text" name="fullname" id="fullname" class="form-control mb-3" placeholder="Full Name"
                           required>
                </div>
                <div class="col-xl-6">
                    <input type="text" name="email" id="email" class="form-control mb-3" placeholder="Email" required>
                </div>
                <div class="col-12">
                    <textarea name="comment" id="comment" rows="5" class="form-control mb-3" placeholder="Comment"
                              required></textarea>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-comment"><i class="material-icons-outlined">send</i>
                        Post Comment
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>
@push("scripts")
    <script src="{{ asset("assets/web/js/components/section-comment-form.js") }}"></script>
@endpush
