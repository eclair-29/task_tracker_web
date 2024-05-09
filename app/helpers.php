<?php

use App\Models\Status;
use App\Models\StatusCategory;
use Illuminate\Support\Facades\DB;

function getStatusCategoryByDescription($description)
{
    $statusCategory = StatusCategory::where('description', $description)->first();

    return $statusCategory;
}

function getUserStatusByDescription($description)
{
    $status = Status::where('category_id', getStatusCategoryByDescription('user')->id)
        ->where('description', $description)
        ->first();

    return $status;
}

function getTaskStatusByDescription($description)
{
    $status = Status::where('category_id', getStatusCategoryByDescription('task')->id)
        ->where('description', $description)
        ->first();

    return $status;
}

function getAllTasks()
{
    $tasks = DB::table('tasks as t')
        ->select('t.*', 's.description as status', 'at.id as assigned_to_id', 'at.name as assigned_to', 'cb.name as created_by', 'ub.name as updated_by', 'p.description as priority', 't.created_at', 't.updated_at')
        ->leftJoin('statuses as s', 't.status_id', '=', 's.id')
        ->leftJoin('users as at', 't.assigned_to', '=', 'at.id')
        ->leftJoin('users as cb', 't.created_by', '=', 'cb.id')
        ->leftJoin('users as ub', 't.updated_by', '=', 'ub.id')
        ->leftJoin('priorities as p', 't.priority_id', '=', 'p.id')
        ->orderBy('t.updated_at', 'desc')
        ->get();

    return $tasks;
}

function getAllTasksByUser($userId)
{
    $tasks = DB::table('tasks as t')
        ->select('t.*', 's.description as status', 'at.id as assigned_to_id', 'at.name as assigned_to', 'cb.name as created_by', 'ub.name as updated_by', 'p.description as priority', 't.created_at', 't.updated_at')
        ->leftJoin('statuses as s', 't.status_id', '=', 's.id')
        ->leftJoin('users as at', 't.assigned_to', '=', 'at.id')
        ->leftJoin('users as cb', 't.created_by', '=', 'cb.id')
        ->leftJoin('users as ub', 't.updated_by', '=', 'ub.id')
        ->leftJoin('priorities as p', 't.priority_id', '=', 'p.id')
        ->where('t.assigned_to', $userId)
        ->orderBy('t.updated_at', 'desc')
        ->get();

    return $tasks;
}
