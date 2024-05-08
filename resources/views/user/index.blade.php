@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header">{{ Auth::user()->name . " Tasks" }}</div>

                <div class="card-body">
                    {{ __('Tasks data table here!') }}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection