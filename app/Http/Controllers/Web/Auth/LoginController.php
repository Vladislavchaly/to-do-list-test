<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function __invoke()
    {
        return view('auth.login');
    }
}
