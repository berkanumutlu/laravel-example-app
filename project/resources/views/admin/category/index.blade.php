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
                    <x-admin.table
                        :columns="$columns" :rows="$records"
                        :class="'table-striped table-hover'"
                        :responsive="true"></x-admin.table>
                </x-slot>
            </x-admin.card>
        </div>
    </div>
@endsection
@section("scripts")

@endsection
