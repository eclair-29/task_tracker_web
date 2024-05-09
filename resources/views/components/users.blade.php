@props(['id', 'tasks'])

<table class="table table-bordered py-3 table-striped" id="{{ $id }}" width="100%">
    <thead>
        <tr>
            <th class="text-center fw-bold">Action</th>
            <th class="text-center fw-bold">Name</th>
            <th class="text-center fw-bold">Username</th>
            <th class="text-center fw-bold">Email</th>
            <th class="text-center fw-bold">Status</th>
            <th class="text-center fw-bold">Added Date</th>
        </tr>
    </thead>
</table>