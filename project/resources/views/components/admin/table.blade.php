@if(!empty($responsive))
    <div class="table-responsive">
        @endif
        <table class="table {{ $class ?? '' }}">
            @isset($columns)
                <thead>
                <tr>
                    @foreach($columns as $item)
                        <th scope="col"> {{ $item }}</th>
                    @endforeach
                </tr>
                </thead>
            @endisset
            @isset($rows)
                <tbody>
                @foreach($rows as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->slug }}</td>
                        <td>{{ Str::limit($item->description, 50) }}</td>
                        <td>
                            <div class="changeStatusSection">
                                <a href="javascript:;" data-id="{{ $item->id }}"
                                   class="changeStatus btn btn-outline-success px-2 py-1 me-2 {{ $item->status ? '' : 'd-none' }}">Active</a>
                                <a href="javascript:;" data-id="{{ $item->id }}"
                                   class="changeStatus btn btn-outline-warning px-2 py-1 me-2 {{ $item->status ? 'd-none' : '' }}">Passive</a>
                            </div>
                        </td>
                        <td>{{ $item->feature_status ? 'Active' : 'Passive' }}</td>
                        <td>{{ $item->order }}</td>
                        <td>{{ $item->parentCategory?->name }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td class="align-middle">
                            <div class="d-flex align-items-center">
                                <a href="javascript:;" class="btn btn-dark px-2 py-1 me-2"><i
                                        class="material-icons m-0">edit</i></a>
                                <a href="javascript:;" class="btn btn-danger px-2 py-1"><i
                                        class="material-icons m-0">delete</i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            @endisset
        </table>
        @if(!empty($responsive))
    </div>
@endif
