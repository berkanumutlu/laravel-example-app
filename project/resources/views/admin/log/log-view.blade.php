<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th colspan="2">Key</th>
            <th>Value</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($data))
            @if (is_array($data))
                @foreach ($data as $key => $value)
                    <tr>
                        <td colspan="2">{{ $key }}</td>
                        <td>
                            @if(is_string($value) && strtotime($value) !== false)
                                {{ \Carbon\Carbon::parse($value)->format('d M Y H:i:s') }}
                            @elseif (is_string($value) || is_numeric($value))
                                {!! $value !!}
                            @elseif (is_array($value))
                                @if (isset($value['old']) || isset($value['new']))
                                    {{ isset($value['old']) ? $value['old'] : 'null' }}
                                    <strong>&#10509;</strong> {{ isset($value['new']) ? $value['new'] : 'null' }}
                                @else
                                    @foreach ($value as $item)
                                        @if(!$loop->last)
                                            {{ $item.' ' }}
                                        @else
                                            {{ $item }}
                                        @endif
                                    @endforeach
                                @endif
                            @else
                                null
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
        @endif
        </tbody>
    </table>
</div>
