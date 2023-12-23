<td class="align-middle">
    <div class="d-flex align-items-center">
        @if(!empty($approveURL))
            <a href="{{ $approveURL }}" data-id="{{ $recordId ?? '' }}"
               class="btnApprove btn btn-success px-2 py-1 me-2">
                <i class="material-icons m-0">task_alt</i>
            </a>
        @endif
        @if(!empty($editURL))
            <a href="{{ $editURL }}" data-id="{{ $recordId ?? '' }}" class="btnEdit btn btn-dark px-2 py-1 me-2">
                <i class="material-icons m-0">edit</i>
            </a>
        @endif
        @if(!empty($deleteURL))
            <a href="{{ $deleteURL }}" data-id="{{ $recordId ?? '' }}" class="btnDelete btn btn-danger px-2 py-1">
                <i class="material-icons m-0">delete</i></a>
        @endif
    </div>
</td>
