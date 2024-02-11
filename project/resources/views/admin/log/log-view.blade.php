<table class="table">
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
                        @if (is_string($value))
                            {{ $value }}
                        @elseif (is_array($value))
                            @if (isset($value['old']) || isset($value['new']))
                                {{ $value['old'] ?? 'null' }} <strong>&#10509;</strong> {{ $value['new'] ?? 'null' }}
                            @else
                                @foreach ($value as $item)
                                    @if(!$loop->last)
                                        {{ $item.' ' }}
                                    @else
                                        {{ $item }}
                                    @endif
                                @endforeach
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
        @endif
    @endif
    </tbody>
</table>
