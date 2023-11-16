<div class="btnChangeStatusSection">
    <a href="{{ $url ?? 'javascript:;' }}" data-id="{{ $recordId }}" data-type="{{ $recordType }}"
       data-type-text="{{ $recordTypeText }}"
       class="btnChangeStatus btn px-2 py-1 me-2 {{ $recordStatus ? 'btn-outline-success' : 'btn-outline-warning' }}">{{ $recordStatus ? 'Active' : 'Passive' }}</a>
</div>
