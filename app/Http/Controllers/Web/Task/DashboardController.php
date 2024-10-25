<?php

namespace App\Http\Controllers\Web\Task;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('task.dashboard');
    }
}
