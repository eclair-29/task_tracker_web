@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 d-flex justify-content-end pb-4">
            <a id="create_task_btn" class="btn btn-outline-danger" data-bs-toggle="modal"
                data-bs-target="#create_user_popup" role="button">
                Add User
            </a>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">All Users</div>

                <div class="card-body">
                    <x-alert />
                    <x-users :id="'backoffice_users_table'" />
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@include('backoffice.user-create')

@endsection