@extends("admin.layouts.index")
@section("head")

@endsection
@section("content")
    <div class="row">
        <div class="col-12">
            <x-admin.card>
                <x-slot name="header">
                    <h1 class="card-title">{{ $title }}</h1>
                </x-slot>
                <x-slot name="body">
                    <x-admin.table :class="'table-striped table-hover'" :responsive="true">
                        <x-slot name="columns">
                            @foreach($columns as $item)
                                <th scope="col" class="align-middle"> {{ $item }}</th>
                            @endforeach
                        </x-slot>
                        <x-slot name="rows">
                            @foreach($records as $item)
                                <tr>
                                    <th scope="row">{{ $item->id }}</th>
                                    <td>{{ Str::limit($item->title, 20) }}</td>
                                    <td>{{ Str::limit($item->slug, 20) }}</td>
                                    <td>{{ Str::limit($item->body, 40) }}</td>
                                    <td>
                                        @if(!empty($item->image))
                                            <a href="{{ $item->image }}" target="_blank">
                                                <img src="{{ $item->image }}" alt="{{ $item->title }}"
                                                     width="40" height="40"></a>
                                        @endif
                                    </td>
                                    <td>
                                        <x-admin.change-status
                                            :recordId="$item->id" :recordType="'status'"
                                            :recordTypeText="'Status'" :recordStatus="$item->status">
                                        </x-admin.change-status>
                                    </td>
                                    <td>{{ $item->read_time }}</td>
                                    <td>{{ $item->view_count }}</td>
                                    <td>{{ $item->like_count }}</td>
                                    <td>{{ $item->publish_date }}</td>
                                    <td>{{ $item->category?->name }}</td>
                                    <td>{{ $item->user?->name }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <x-admin.table-actions
                                        :recordId="$item->id"
                                        :editURL="route('admin.article.edit', ['id' => $item->id])"
                                    ></x-admin.table-actions>
                                </tr>
                            @endforeach
                        </x-slot>
                    </x-admin.table>
                </x-slot>
            </x-admin.card>
        </div>
    </div>
@endsection
@section("scripts")

@endsection
