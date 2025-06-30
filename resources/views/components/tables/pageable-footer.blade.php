<div class="d-flex justify-content-between align-items-center mt-4 flex-wrap">
    <div class="text-muted small mb-2">
        Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }} results
    </div>
    
    <div>
        {{ $data->appends(request()->query())->links() }}
    </div>
</div>