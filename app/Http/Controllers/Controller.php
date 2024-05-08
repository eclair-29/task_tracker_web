<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $user = auth()->user();

        if ($user) {
            if ($user->hasRole('user')) {
                return redirect('/user');
            }

            if ($user->hasRole('admin')) {
                return redirect('/backoffice');
            }
        }

        return redirect('/login');
    }
}
