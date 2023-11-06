@if(!empty($responsive))
    <div class="table-responsive">
        @endif
        <table class="table {{ $class ?? '' }}">
            @isset($columns)
                <thead>
                <tr>{!! $columns !!}</tr>
                </thead>
            @endisset
            @isset($rows)
                <tbody>{!! $rows !!}</tbody>
            @endisset
        </table>
        @if(!empty($responsive))
    </div>
@endif
