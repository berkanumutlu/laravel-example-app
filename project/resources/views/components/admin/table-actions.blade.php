<td class="align-middle">
    <div class="d-flex align-items-center">
        @if(!empty($viewModalContent))
            <a data-id="{{ $recordId ?? '' }}" data-content="{!! htmlentities($viewModalContent) ?? '' !!}"
               data-user-fullname="{{ $userFullName ?? '' }}" data-creation-date="{{ $creationDate ?? '' }}"
               class="btnViewModal btn btn-secondary px-2 py-1" data-bs-placement="top" title="View"
               data-bs-toggle="modal" data-bs-target="#viewModal">
                <i class="material-icons m-0">visibility</i>
            </a>
        @endif
        @if(!empty($approveURL))
            <a href="{{ $approveURL }}" data-id="{{ $recordId ?? '' }}"
               class="btnApprove btn btn-success px-2 py-1 ms-2"
               data-bs-toggle="tooltip" data-bs-placement="top" title="Approve">
                <i class="material-icons m-0">task_alt</i>
            </a>
        @endif
        @if(!empty($editURL))
            <a href="{{ $editURL }}" data-id="{{ $recordId ?? '' }}" class="btnEdit btn btn-dark px-2 py-1 ms-2"
               data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                <i class="material-icons m-0">edit</i>
            </a>
        @endif
        @if(!empty($deleteURL))
            <a href="{{ $deleteURL }}" data-id="{{ $recordId ?? '' }}"
               class="btnDelete btn btn-danger px-2 py-1 ms-2 {{ $deleteURLClass ?? '' }}"
               data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                <i class="material-icons m-0">delete</i></a>
        @endif
        @if(!empty($restoreURL))
            <a href="{{ $restoreURL }}" data-id="{{ $recordId ?? '' }}"
               class="btnRestore btn btn-info px-2 py-1 ms-2 {{ $restoreURLClass ?? '' }}"
               data-bs-toggle="tooltip" data-bs-placement="top" title="Restore">
                <i class="material-icons m-0">undo</i></a>
        @endif
    </div>
</td>
