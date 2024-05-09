@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 d-flex justify-content-between align-items-center pb-4">
            <h1 class="page-title fw-bold">My Tasks</h1>
            <a id="create_task_btn" class="btn btn-outline-danger" data-bs-toggle="modal"
                data-bs-target="#create_task_popup" role="button">
                New Task
            </a>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">Tasks</div>

                <div class="card-body">
                    <x-alert />
                    <x-tasks :id="'user_tasks_table'" :tasks="$tasks" />
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@include('tasks.create')
@endsection