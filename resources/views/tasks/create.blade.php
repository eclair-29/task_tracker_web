<div class="modal fade popup" id="create_task_popup" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Create New Task</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('tasks.store') }}" method="post" enctype="multipart/form-data" id="create_task">
                    @csrf
                    <div class="row">
                        <div class="col-12 pb-3">
                            <label for="description" class="form-label">
                                Task Description
                                <span class="text-danger fw-bold"> *</span>
                            </label>
                            <input type="text" class="form-control" name="description" value="" id="description">
                        </div>
                        <div class="col-6 pb-3">
                            <label for="ticket_id" class="form-label">
                                Ticket ID
                            </label>
                            <input type="text" class="form-control" readonly name="ticket_id" id="ticket_id" value="">
                            <div class="form-text">Ticket ID is auto-generated</div>
                        </div>
                        <div class="col-6 pb-3">
                            <label for="assigned_to" class="form-label">
                                Assign To
                                @role('admin')
                                <span class="text-danger fw-bold"> *</span>
                                @endrole
                            </label>
                            @role('user')
                            <input type="text" class="form-control" name="assigned_to_full"
                                value="{{ Auth::user()->name }}">
                            <input type="text" class="form-control" name="assigned_to" id="assigned_to" hidden
                                value="{{ Auth::user()->id }}">
                            @else
                            <select class="form-select" name="assigned_to" id="assigned_to">
                                <option value="">Select User</option>
                            </select>
                            @endrole
                        </div>
                        <div class="col-6 pb-3">
                            <label for="status" class="form-label">
                                Status
                                <span class="text-danger fw-bold"> *</span>
                            </label>
                            <select class="form-select" name="status" id="status">
                                <option value="">Select Status</option>
                            </select>
                        </div>
                        <div class="col-6 pb-3">
                            <label for="priority" class="form-label">
                                Priority
                                <span class="text-danger fw-bold"> *</span>
                            </label>
                            <select class="form-select" name="priority" id="priority">
                                <option value="">Select Priority</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-danger" form="create_task">Save</button>
            </div>
        </div>
    </div>
</div>