<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;


class OrganizerController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        return view('organizer.index'); 
    }
}
