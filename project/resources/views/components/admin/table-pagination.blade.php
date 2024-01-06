<div class="mt-3 d-flex justify-content-between align-items-center">
    @if(isset($records))
        Showing {{ $records->currentPage() == 1 ? $records->currentPage() : $records->currentPage() * $records->perPage() - $records->perPage() + 1 }}
        to {{ $records->currentPage() * $records->perPage() > $records->total() ? $records->total() : $records->currentPage() * $records->perPage() }}
        of {{ $records->total() }} entries
        {{ $records->onEachSide(1)->links() }}
    @endif
</div>
