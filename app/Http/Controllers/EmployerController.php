<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;

class EmployerController extends Controller
{
    // public function index(){
    //     $empjobs = Job::latest()->with('employer')->
    //     where('employer_id', Auth::user()->employer->id)
    //     ->paginate(10);
    //     return view('employer.index', data: ['empjobs'=> $empjobs]);
    // }

    public function edit(Employer $employer)
    {
        return view('employer.edit', ['employer' => $employer]);
    }

    public function update(Request $request, Employer $employer)
    {
        $employerAttributes = $request->validate([
            'employer' => ['required'],
            'logo' => ['nullable', File::types(['jpeg', 'jpg', 'png', 'webp'])],
        ]);

        if ($request->logo) {
            $logoPath = $request->logo->store('logos');
            $employer->update([
                'name' => $employerAttributes['employer'],
                'logo' => $logoPath
            ]);
        } else {
            $employer->update([
                'name' => $employerAttributes['employer']
            ]);
        }

        return redirect('/');
    }
}
