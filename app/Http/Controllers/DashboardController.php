<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Site;
use App\Models\User;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalProfiles = Profile::count();
        $totalSites = Site::count();

        $sites = Site::with('profiles.users')->get();
        
        return view('dashboard.index', compact('totalUsers', 'totalProfiles', 'totalSites', 'sites'));
    }
}
