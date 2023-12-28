<div {{ $attributes->class(['modal', 'fade', $modalClass ?? '']) }}
     {{ isset($modalId) ? 'id=' . $modalId : '' }}
     tabindex="-1" aria-hidden="true">
    <div {{ $attributes->class(['modal-dialog', $modalDialogClass ?? '']) }}>
        <div class="modal-content">
            <div class="modal-header">
                @if(!empty($modalHeaderCustom))
                    {!! $modalHeaderCustom !!}
                @else
                    <h1 class="modal-title fs-5">{!! $headerTitle ?? '' !!}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                @endif
            </div>
            <div class="modal-body">
                @if(!empty($modalBodyCustom))
                    {!! $modalBodyCustom !!}
                @endif
            </div>
            <div class="modal-footer">
                @if(!empty($modalFooterCustom))
                    {!! $modalFooterCustom !!}
                @endif
            </div>
        </div>
    </div>
</div>
