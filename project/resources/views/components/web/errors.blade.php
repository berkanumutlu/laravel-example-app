@if($errors->any())
    <div class="alert alert-danger {{ $alertClass ?? '' }}">
        <ul class="list-group list-unstyled {{ $ulClass ?? '' }}">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
