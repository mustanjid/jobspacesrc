<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Job;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $count = [
            'total_jobs' => Job::count(),

            'total_active_jobs' => Job::where('status', 1)->count(),

            'total_featured_jobs' => Job::where('featured', 1)
            ->where('status', 1) // Ensure the job is active
            ->whereHas('employer', function ($query) {
                $query->where('status', 1); // Ensure the employer is active
            })
            ->count(),

            'total_employers' => Employer::whereHas('user', function ($query) {
                $query->where('status', 1); // Ensure the user associated with the employer is active
            })
            ->count()
        ];
        return view('admin.index',['count' => $count]);
    }

}
