@if(!empty($responsive))
    <div class="table-responsive custom-scrollbar">
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
            @isset($footer)
                <tfoot>
                <tr>{!! $footer !!}</tr>
                </tfoot>
            @endisset
        </table>
        @if(!empty($responsive))
    </div>
@endif
