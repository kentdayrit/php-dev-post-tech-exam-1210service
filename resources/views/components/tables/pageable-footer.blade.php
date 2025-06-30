<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 gap-2">
    <div class="text-muted small mb-2">
        Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }} results
    </div>
    
    <div>
        {{ $data->appends(request()->query())->links() }}
    </div>
</div>