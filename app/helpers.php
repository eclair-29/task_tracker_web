<?php

use App\Models\Status;
use App\Models\StatusCategory;

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
