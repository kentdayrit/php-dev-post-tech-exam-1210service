<div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="delete-modal-label" aria-hidden="true">
   <form action="#" method="POST" id="delete-form">
    @method('DELETE')
    @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    Are you sure you want to delete this item?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </form>
</div>