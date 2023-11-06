<div class="btnChangeStatusSection">
    <a href="javascript:;" data-id="{{ $recordId }}" data-type="{{ $recordType }}"
       data-type-text="{{ $recordTypeText }}"
       class="btnChangeStatus btn btn-outline-success px-2 py-1 me-2 {{ $recordStatus ? '' : 'd-none' }}">Active</a>
    <a href="javascript:;" data-id="{{ $recordId }}" data-type="{{ $recordType }}"
       data-type-text="{{ $recordTypeText }}"
       class="btnChangeStatus btn btn-outline-warning px-2 py-1 me-2 {{ $recordStatus ? 'd-none' : '' }}">Passive</a>
</div>
