<div class="modal fade popup" id="create_user_popup" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Add User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('backoffice.utilities.users.store') }}" method="post"
                    enctype="multipart/form-data" id="create_user">
                    @csrf
                    <div class="row">
                        <div class="col-12 pb-3">
                            <label for="name" class="form-label">
                                Name
                                <span class="text-danger fw-bold"> *</span>
                            </label>
                            <input type="text" class="form-control" name="name" value="" id="name">
                        </div>
                        <div class="col-6 pb-3">
                            <label for="username" class="form-label">
                                Username
                                <span class="text-danger fw-bold"> *</span>
                            </label>
                            <input type="text" class="form-control" name="username" id="username" value="">
                        </div>
                        <div class="col-6 pb-3">
                            <label for="email" class="form-label">
                                Email
                                <span class="text-danger fw-bold"> *</span>
                            </label>
                            <input type="email" class="form-control" name="email" id="email">
                        </div>
                        <div class="col-6 pb-3">
                            <label for="user_status" class="form-label">
                                Status
                                <span class="text-danger fw-bold"> *</span>
                            </label>
                            <select class="form-select" name="user_status" id="user_status">
                                <option value="">Select Status</option>
                            </select>
                        </div>
                        <div class="col-6 pb-3">
                            <label for="password" class="form-label">
                                Temporary Password
                                <span class="text-danger fw-bold"> *</span>
                            </label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-danger" form="create_user">Save</button>
            </div>
        </div>
    </div>
</div>