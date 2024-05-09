<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Status;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;

class BackOfficeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function users()
    {
        $users = User::role('user')->get();
        return $users;
    }

    public function viewUsers(Request $request)
    {
        if ($request->ajax()) {
            $role = Role::where('name', 'user')->first();

            $users = DB::table('users as u')
                ->select('u.*', 's.description as status')
                ->join('model_has_roles as mhr', 'u.id', '=', 'mhr.model_id')
                ->join('statuses as s', 'u.status_id', '=', 's.id')
                ->where('mhr.role_id', $role->id)
                ->orderBy('u.created_at', 'desc')
                ->get();

            return DataTables::of($users)->addIndexColumn()->make(true);
        }

        return view('backoffice.users');
    }

    public function addUser(StoreUserRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        DB::beginTransaction();

        try {
            $user = User::create($validated);

            User::find($user->id)->assignRole('user');

            ActivityLog::create([
                'user_id' => auth()->user()->id,
                'action' => auth()->user()->name . ' added new user ' . $validated['name'],
            ]);

            DB::commit();

            return response([
                'response' => 'success',
                'alert' => 'Successfully added new user.',
            ], 200);
        } catch (Throwable $th) {
            DB::rollBack();

            return response([
                'response' => 'error',
                'alert' => 'Failed to add new user. ' . $th->getMessage(),
            ]);
        }
    }

    public function getUserStatuses()
    {
        $statuses = Status::where('category_id', getStatusCategoryByDescription('user')->id)->get();

        return $statuses;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = getAllTasks();

        return view('backoffice.index', ['tasks' => $tasks]);
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
