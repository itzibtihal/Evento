<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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

    
    // public function updateStatus(User $user)
    // {
    //     $user->update(['status' => ($user->status == 0) ? 1 : 0]);
    
    //     return redirect()->back()->with('success', 'User status updated successfully.');
    // }

    public function updateStatus(Request $request)
    {
        $userId = $request->input('userId');
        $status = $request->input('status');

        // Validate the inputs if needed

        $user = User::find($userId);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Update the user status
        $user->status = $status;
        $user->save();

        return response()->json(['message' => 'User status updated successfully']);
    }
    
}

