<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $siteUserCount = User::count();
        return view('admin.index', compact('siteUserCount')); 
    }

    
}

