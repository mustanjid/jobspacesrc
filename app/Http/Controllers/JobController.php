<?php

namespace App\Http\Controllers;

use App\Events\JobCreate;
use App\Models\Job;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::latest()
            ->with(['employer', 'tags', 'employer.user'])
            ->where('status', 1) // Active jobs
            ->whereHas('employer.user', function ($query) {
                $query->where('status', 1); // Active employer
            })
            ->get()
            ->groupBy('featured');

        $tags = Tag::whereHas('jobs', function ($query) {
            $query->where('status', 1) // Active jobs
            ->whereHas('employer', function ($query) {
                $query->where('status', 1) // Active employers
                ->whereHas('user', function ($query) {
                    $query->where('status', 1); // Active users
                });
            });
        })
        ->withCount('jobs') // Count the number of jobs related to each tag
        ->orderByDesc('jobs_count') // Order by the job count in descending order
        ->limit(8) // Limit to top 8 tags
        ->get();

        $featuredJobs = $jobs->get(1)?->take(6); // Top 6 featured jobs
        $nonFeaturedJobs = $jobs->get(0)?->take(9);

        return view('job.index', [
            'featuredJobs' => $featuredJobs,
            'jobs' => $nonFeaturedJobs,
            'tags' => $tags
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('job.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated  = $request->validate([
            'title' => ['required'],
            'salary' => ['required'],
            'location' => ['required'],
            'schedule' => ['required', Rule::in(['Part Time', 'Full Time'])],
            'featured' => 'nullable',
            'url' => ['required', 'active_url'],
            'tags' => 'nullable|array',
            'tags.*' => 'string',

        ]);

        $featuredValue = $validated['featured'] ?? ''; // Default to an empty string if 'featured' is not set

        if ($featuredValue == '') {
            $featured = 0;
        } else if ($featuredValue == '0') {
            $featured = 0;
        } else {
            $featured = 1;
        }


        $job = Auth::user()->employer->jobs()->create([
            'title' => $validated['title'],
            'salary' => $validated['salary'],
            'location' => $validated['location'],
            'schedule' => $validated['schedule'],
            'url' => $validated['url'],
            'featured' => $featured,
        ]);

        if (isset($validated['tags'])) {
            foreach ($validated['tags'] as $tagName) {
                $tagName = strtolower(trim($tagName));
                $tag = Tag::firstOrCreate(['name' => $tagName]); // Will create or find existing tag
                // Attach the tag only if it's not already attached to the job
                if (!$job->tags->contains($tag->id)) {
                    $job->tags()->attach($tag);
                }
            }
        }


        event(new JobCreate([
            'title' => $job->title,
            'salary' => $job->salary,
        ]));

        return redirect('/')->with('message', 'Job posted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobRequest $request, Job $job)
    {
        //
    }

    public function fetchTags()
    {
        $tags = Tag::withCount('jobs') 
        ->orderBy('jobs_count', 'desc')
        ->take(5)
        ->get();
        return response()->json($tags);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        //
    }
}
