<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $blockedUsers = User::where('status', 1)
            ->orderBy('updated_at', 'desc')
            ->take(4)
            ->get();

            $users = User::whereHas('roles', function ($query) {
                $query->where('roles.id', 3);
            })->get();
            

        return view('admin.users.index' ,compact('blockedUsers','users'));
      
    }

    
    public function updateStatus(User $user)
    {
        $user->update(['status' => ($user->status == 0) ? 1 : 0]);
    
        return redirect()->back()->with('success', 'User status updated successfully.');
    }

    
}

