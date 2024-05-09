@props(['id', 'tasks'])

<table class="table table-bordered py-3 table-striped" id="{{ $id }}" width="100%">
    <thead>
        <tr>
            <th class="text-center fw-bold">Action</th>
            <th class="text-center fw-bold">Ticket ID</th>
            <th class="text-center fw-bold">Description</th>
            <th class="text-center fw-bold">Status</th>
            <th class="text-center fw-bold">Priority</th>
            <th class="text-center fw-bold">Assigned To</th>
            <th class="text-center fw-bold">Created By</th>
            <th class="text-center fw-bold">Created Date</th>
            <th class="text-center fw-bold">Updated By</th>
            <th class="text-center fw-bold">Updated Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tasks as $task)
        @include('tasks.destroy')
        @include('tasks.edit')
        @endforeach
    </tbody>
</table>