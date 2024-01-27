<form action="{{ route('article.search') }}" class="search-form">
    <div class="input-group search-group {{ $class ?? '' }}">
        <input type="text" name="q" autocomplete="off" class="form-control search-input" placeholder="Search" required
               value="{{ request()->get('q') ?? '' }}">
        <div class="input-group-append search-group-button">
            <button type="submit" class="btn btn-outline-secondary search-button">
                <span class="material-icons search-icon">search</span></button>
        </div>
    </div>
</form>
