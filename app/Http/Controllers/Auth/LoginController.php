<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Status;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    public function redirectTo()
    {
        $user = auth()->user();
        if ($user->hasRole('user')) {
            return '/user';
        } else {
            return '/backoffice';
        }
    }

    public function username()
    {
        return 'username';
    }

    protected function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect('/login');
    }

    protected function credentials(Request $request)
    {
        // only allow users that is active
        $status = Status::where('category_id', getStatusCategoryByDescription('user')->id)
            ->where('description', 'Active')
            ->first();

        return [
            'username' => $request->username,
            'password' => $request->password,
            'status_id' => $status->id
        ];
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
