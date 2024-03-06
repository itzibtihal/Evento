<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class OrganizController extends Controller
{
    
    public function index()
{
    $recentOrganizers = User::whereHas('roles', function ($query) {
        $query->where('name', 'organizer');
    })
    ->orderBy('created_at', 'desc')
    ->take(3)
    ->get();

    $users = User::with('roles')->whereHas('roles', function ($query) {
        $query->where('name', 'organizer');
    })
    ->orderBy('created_at', 'desc')
    ->get();

    return view('admin.organ.index', compact('recentOrganizers','users'));
}
}