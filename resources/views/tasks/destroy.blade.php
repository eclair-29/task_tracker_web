<div class="modal fade popup" id="delete_task_popup_{{ $task->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title text-danger">Delete Task</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span class="fw-bold text-danger">Are you sure you want to delete this
                    task?</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-outline-danger delete-task-btn"
                    id="delete_task_btn_{{ $task->id }}">Delete</button>
            </div>
        </div>
    </div>
</div>