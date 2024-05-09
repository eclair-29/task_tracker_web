<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\ActivityLog;
use App\Models\Priority;
use App\Models\Status;
use Carbon\Carbon;
use App\Models\Task;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Throwable;

class TasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function generateTicketId()
    {
        $currentMonth = Carbon::now()->format('m');
        $series = $currentMonth . '' . Carbon::now()->format('y');
        $taskCountPerMonth = Task::whereMonth('created_at', $currentMonth)->max('id');
        $zeroFilledId = str_pad($taskCountPerMonth + 1, 4, '0', STR_PAD_LEFT);

        // ticket id
        $ticketId =  'TASK_' . $series . '_' . $zeroFilledId;
        return $ticketId;
    }

    public function all()
    {
        $tasks = getAllTasks();

        return DataTables::of($tasks)->addIndexColumn()->make(true);
    }

    public function user()
    {
        $tasks = getAllTasksByUser(auth()->user()->id);

        return DataTables::of($tasks)->addIndexColumn()->make(true);
    }

    public function statuses()
    {
        $statuses = Status::where('category_id', getStatusCategoryByDescription('task')->id)->get();

        return $statuses;
    }

    public function priorities()
    {
        $priorities = Priority::all();

        return $priorities;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $validated = $request->validated();

        $validated['assigned_to'] = auth()->user()->hasRole('user')
            ? $request->assigned_to
            : $validated['assigned_to'];
        $validated['ticket_id'] = $request->ticket_id;
        $validated['created_by'] = auth()->user()->id;
        $validated['updated_by'] = auth()->user()->id;

        $roles = auth()->user()->roles()->pluck('name');

        DB::beginTransaction();

        try {
            Task::create($validated);
            ActivityLog::create([
                'user_id' => auth()->user()->id,
                'action' => auth()->user()->name . ' created a new task with ticket id ' . $request->ticket_id,
            ]);

            DB::commit();

            return response([
                'roles' => $roles,
                'response' => 'success',
                'alert' => 'Successfully created task.',
            ], 200);
        } catch (Throwable $th) {
            DB::rollBack();

            return response([
                'response' => 'error',
                'alert' => 'Failed to create task. ' . $th->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, string $id)
    {
        $validated = $request->validated();

        $validated['assigned_to'] = auth()->user()->hasRole('user')
            ? $request->assigned_to
            : $validated['assigned_to'];
        $validated['ticket_id'] = $request->ticket_id;
        $validated['updated_by'] = auth()->user()->id;

        $roles = auth()->user()->roles()->pluck('name');

        DB::beginTransaction();

        try {
            $task = Task::find($id);
            $task->update($validated);

            ActivityLog::create([
                'user_id' => auth()->user()->id,
                'action' => auth()->user()->name . ' updated a task with ticket id ' . $request->ticket_id,
            ]);

            DB::commit();

            return response([
                'roles' => $roles,
                'response' => 'success',
                'alert' => 'Successfully updated task.',
            ], 200);
        } catch (Throwable $th) {
            DB::rollBack();
            return response([
                'response' => 'error',
                'alert' => 'Failed to update task. ' . $th->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $roles = auth()->user()->roles()->pluck('name');

        DB::beginTransaction();
        try {
            $task = Task::find($id);

            ActivityLog::create([
                'user_id' => auth()->user()->id,
                'action' => auth()->user()->name . ' deleted a task with ticket id ' . $task->ticket_id,
            ]);

            $task->delete();

            DB::commit();

            return response([
                'roles' => $roles,
                'response' => 'success',
                'alert' => 'Successfully deleted task.',
            ], 200);
        } catch (Throwable $th) {
            DB::rollBack();
            return response([
                'response' => 'error',
                'alert' => 'Failed to delete task. ' . $th->getMessage(),
            ]);
        }
    }
}
