<td class="align-middle">
    <div class="d-flex align-items-center">
        <a href="{{ $editURL ?? 'javascript:;' }}"
           data-id="{{ $recordId ?? '' }}"
           class="btnEdit btn btn-dark px-2 py-1 me-2">
            <i class="material-icons m-0">edit</i>
        </a>
        <a href="{{ $deleteURL ?? 'javascript:;' }}"
           data-id="{{ $recordId ?? '' }}"
           class="btnDelete btn btn-danger px-2 py-1">
            <i class="material-icons m-0">delete</i></a>
    </div>
</td>
