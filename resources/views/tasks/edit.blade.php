<div class="modal fade popup" id="edit_task_popup_{{ $task->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Edit Task</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('tasks.update', $task->id) }}" method="post" class="edit-task"
                    id="edit_task_{{ $task->id }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 pb-3">
                            <label for="description" class="form-label">
                                Task Description
                                <span class="text-danger fw-bold"> *</span>
                            </label>
                            <input type="text" class="form-control" name="description" value="{{ $task->description }}"
                                id="description_{{ $task->id }}">
                        </div>
                        <div class="col-6 pb-3">
                            <label for="ticket_id" class="form-label">
                                Ticket ID
                            </label>
                            <input type="text" class="form-control" readonly name="ticket_id"
                                id="ticket_id_{{ $task->id }}" value="{{ $task->ticket_id }}">
                            <div class="form-text">Ticket ID is auto-generated</div>
                        </div>
                        <div class="col-6 pb-3">
                            <label for="assigned_to" class="form-label">
                                Re-assign To
                                @role('admin')
                                <span class="text-danger fw-bold"> *</span>
                                @endrole
                            </label>
                            @role('user')
                            <input readonly type="text" class="form-control" name="assigned_to_full"
                                value="{{ Auth::user()->name }}">
                            <input type="text" class="form-control" name="assigned_to" id="assigned_to_{{ $task->id }}"
                                hidden value="{{ Auth::user()->id }}">
                            @else
                            <select class="form-select" name="assigned_to" id="assigned_to_{{ $task->id }}">
                                <option selected value="{{ $task->assigned_to_id }}">{{ $task->assigned_to }}</option>
                            </select>
                            @endrole
                        </div>
                        <div class="col-6 pb-3">
                            <label for="status" class="form-label">
                                Status
                                <span class="text-danger fw-bold"> *</span>
                            </label>
                            <select class="form-select" name="status" id="status_{{ $task->id }}">
                                <option selected value="{{ $task->status_id }}">{{ $task->status }}</option>
                            </select>
                        </div>
                        <div class="col-6 pb-3">
                            <label for="priority" class="form-label">
                                Priority
                                <span class="text-danger fw-bold"> *</span>
                            </label>
                            <select class="form-select" name="priority" id="priority_{{ $task->id }}">
                                <option selected value="{{ $task->priority_id }}">{{ $task->priority }}</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-danger" form="edit_task_{{ $task->id }}">Update</button>
            </div>
        </div>
    </div>
</div>