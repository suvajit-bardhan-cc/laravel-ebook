<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController
{
    public function dashboard()
    {
        return view('admin.dashboard.index');
    }
}