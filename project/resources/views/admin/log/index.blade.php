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
                                    <td>{{ $item->user?->name }}</td>
                                    <td>{{ $item->action }}</td>
                                    <td>{{ $item->loggable_type }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <x-admin.table-actions
                                        :recordId="$item->id"
                                        :viewModalContentAJAX="true"
                                        :viewModalAJAXURL="route('admin.log.show_ajax')"
                                    ></x-admin.table-actions>
                                </tr>
                            @endforeach
                        </x-slot>
                    </x-admin.table>
                    <x-admin.table-pagination :records="$records"></x-admin.table-pagination>
                </x-slot>
            </x-admin.card>
        </div>
    </div>
    <x-admin.modal
        :modalId="'viewModalAJAX'" :headerTitle="'Log'"
        :modalDialogClass="'modal-xl'"></x-admin.modal>
@endsection
@section("scripts")

@endsection
