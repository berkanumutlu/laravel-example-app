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
