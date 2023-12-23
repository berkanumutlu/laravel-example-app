@extends("admin.layouts.index")
@section("style")

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
                                    <td>
                                        <a href="{{ route('article.detail', ['slug' => $item->article?->slug]) }}"
                                           target="_blank">{{ $item->article?->title }}</a>
                                    </td>
                                    <td>{{ $item->user?->name }}</td>
                                    <td>{{ $item->parent?->comment }}</td>
                                    <td>{{ Str::limit(strip_tags($item->comment), 40) }}</td>
                                    <td>{{ $item->ip_address }}</td>
                                    <td>{{ $item->user_agent }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <x-admin.table-actions
                                        :recordId="$item->id"
                                        :approveURL="route('admin.article.comments.approve')"
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
