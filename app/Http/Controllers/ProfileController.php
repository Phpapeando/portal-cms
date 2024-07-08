<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Profile::paginate(15);

        return view('profiles.index', compact('profile'));
    }

    public function create()
    {
        return view('profiles.create');
    }
}
