<?php

namespace App\Livewire;

use App\Models\Job;
use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class JobView extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 5;
    public $isActive = '';
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';
    public $jobEditID;
    public $jobEditTitle,
        $jobEditSalary,
        $jobEditLocation,
        $jobEditUrl,
        $jobEditSchedule,
        $jobEditFeature,
        $jobEditEmployer,
        $jobEditStatus;
    public $jobDeleteID;

    public $isOpen = false;
    public $isDeleteModalOpen = false;
    public $isAddModalOpen = false;

    public $tagInput = '';
    public $selectedTags = [];
    public $suggestedTags;

    public function mount()
    {
        // Example: Get suggested tags
        $this->suggestedTags = Tag::withCount('jobs')  // Counting jobs related to each tag
        ->orderByDesc('jobs_count')  // Sorting tags by job count in descending order
        ->take(5)  // Limiting the result to the top 7 tags
        ->get();


    }

    public function addTag()
    {
        // Validate the tag input
        $this->validate(['tagInput' => 'required|string|max:255']);

        // Check if the user has already added the maximum number of tags
        if (count($this->selectedTags) >= 5) {
            $this->addError('tag_limit', 'You can only add up to 5 tags.');
            return;
        }

        // Prevent duplicate tags
        if (collect($this->selectedTags)->contains('name', $this->tagInput)) {
            $this->addError('duplicate_tag', 'This tag has already been added.');
            return;
        }

        // Add the new tag to the selected tags array
        $this->selectedTags[] = ['id' => null, 'name' => $this->tagInput];

        // Clear the input field and reset errors
        $this->tagInput = '';
        $this->resetErrorBag();
    }

    public function selectSuggestedTag($tagId)
    {
        // Check if the user has already selected the maximum number of tags
        if (count($this->selectedTags) >= 5) {
            $this->addError('tag_limit', 'You can only add up to 5 tags.');
            return;
        }

        // Retrieve the tag by ID
        $tag = $this->suggestedTags->firstWhere('id', $tagId);

        // Prevent duplicate additions
        if (!$tag || collect($this->selectedTags)->contains('id', $tagId)) {
            $this->addError('duplicate_tag', 'This tag has already been added.');
            return;
        }

        // Add the suggested tag to the selected tags array
        $this->selectedTags[] = ['id' => $tag->id, 'name' => $tag->name];

        $this->resetErrorBag();
    }

    public function removeTag($tagId)
    {
        $this->selectedTags = array_filter($this->selectedTags, function ($tag) use ($tagId) {
            return $tag['id'] !== $tagId;
        });
        // Re-index the array after removal to avoid array gaps
        $this->selectedTags = array_values($this->selectedTags);
    }

    public function setSortBy($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDir = ($this->sortDir == "ASC") ? $this->sortDir = "DESC" : "ASC";
            return;
        }
        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }

    public function resetFields()
    {
        $this->search = '';
        $this->perPage = 5;
        $this->isActive = '';
        $this->sortBy = 'created_at';
        $this->sortDir = 'DESC';
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function closeDeleteModal()
    {
        $this->isDeleteModalOpen = false;
        $this->jobDeleteID = '';
    }
    public function openDeleteModal($jobID)
    {
        $this->isDeleteModalOpen = true;
        $this->jobDeleteID = $jobID;
    }

    public function delete()
    {
        $job = Job::findOrFail($this->jobDeleteID);
        $job->delete();
        $this->closeDeleteModal();
        session()->flash('failure', 'Job deleted !');
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->selectedTags = [];
        $this->reset('jobEditTitle', 'jobEditSalary',
         'jobEditSalary', 'jobEditLocation',
            'jobEditUrl',
            'jobEditSchedule',
            'jobEditFeature',
            'jobEditStatus'
        );
    }


    public function edit($jobID)
    {
        $this->isOpen = true;
        $this->jobEditID = $jobID;
        $job = Job::findOrFail($jobID);

        $this->jobEditTitle = $job->title;
        $this->jobEditSalary = $job->salary;
        $this->jobEditLocation = $job->location;
        $this->jobEditUrl = $job->url;
        $this->jobEditSchedule = $job->schedule;
        $this->jobEditFeature = $job->featured;
        $this->jobEditStatus = $job->status;

        // Get the existing tags
        $this->selectedTags = $job->tags->map(function ($tag) {
            return ['id' => $tag->id, 'name' => strtolower($tag->name)];
        })->toArray();

        // Get suggested tags excluding the ones already assigned to the job
        $this->suggestedTags = Tag::whereNotIn('id', $job->tags->pluck('id'))->take(7)->get();

        // Clear input for new tag
        $this->tagInput = '';

    }

    public function update()
    {
        $this->validate(
            [
                'jobEditTitle' => ['required'],
                'jobEditSalary' => ['required'],
                'jobEditLocation' => ['required'],
                'jobEditUrl' => ['required', 'active_url'],
                'jobEditSchedule' => ['required', Rule::in(['Part Time', 'Full Time'])],
                'jobEditFeature' => ['required'],
                'jobEditStatus' => ['required'],
            ]
        );

        $job = Job::findOrFail($this->jobEditID);
        $job->update([
            'title' => $this->jobEditTitle,
            'salary' => $this->jobEditSalary,
            'location' => $this->jobEditLocation,
            'url' => $this->jobEditUrl,
            'schedule' => $this->jobEditSchedule,
            'featured' => $this->jobEditFeature,
            'status' => $this->jobEditStatus,
        ]);

        // Sync tags
        $tagIds = collect($this->selectedTags)->map(function ($tag) {
            // Convert tag name to lowercase before checking or creating
            $tagName = strtolower($tag['name']);
            return Tag::firstOrCreate(['name' => $tagName])->id;
        })->toArray();


        $job->tags()->sync($tagIds);

        $this->closeModal();
        session()->flash('success', 'Job updated successfully.');
    }


    public function openAddModal()
    {
        $this->isAddModalOpen = true;
    }

    public function closeAddModal()
    {
        $this->isAddModalOpen = false;
        $this->selectedTags = [];
        $this->reset(
            'jobEditTitle',
            'jobEditSalary',
            'jobEditLocation',
            'jobEditUrl',
            'jobEditSchedule',
            'jobEditFeature',
            'jobEditEmployer',
            'jobEditStatus',
        );
    }

    public function add()
    {
        $this->validate([
            'jobEditTitle' => ['required'],
            'jobEditSalary' => ['required'],
            'jobEditLocation' => ['required'],
            'jobEditUrl' => ['required', 'active_url'],
            'jobEditSchedule' => ['required', Rule::in(['Part Time', 'Full Time'])],
            'jobEditFeature' => ['required'],
            'jobEditStatus' => ['required'],
            'jobEditEmployer' => ['required'],
        ]);

        DB::transaction(function () {
            $job = Job::create([
                'employer_id' => $this->jobEditEmployer,
                'title' => $this->jobEditTitle,
                'salary' => $this->jobEditSalary,
                'location' => $this->jobEditLocation,
                'url' => $this->jobEditUrl,
                'schedule' => $this->jobEditSchedule,
                'featured' => $this->jobEditFeature,
                'status' => $this->jobEditStatus,
            ]);

            $tagIds = $this->syncTags($this->selectedTags);
            $job->tags()->sync($tagIds);
        });

        $this->closeAddModal();
        session()->flash('success', 'Job added successfully.');
    }

    private function syncTags($tags)
    {
        return collect($tags)->map(function ($tag) {
            // Convert tag name to lowercase before checking or creating
            $tagName = strtolower($tag['name']);
            return Tag::firstOrCreate(['name' => $tagName])->id;
        })->toArray();
    }

    public function render()
    {
        $jobs = Job::with('employer')
            ->search($this->search)
            ->when($this->isActive !== '', function ($query) {
                $query->where('status', $this->isActive);
            })->when($this->sortBy === 'name', function ($query) {
                // Join employers table for sorting by employer name
                $query->Join('employers', 'jobs.employer_id', '=', 'employers.id')
                    ->orderBy($this->sortBy, $this->sortDir);
            })
            ->when($this->sortBy !== 'name', function ($query) {
                // Sort by other job columns
                $query->orderBy($this->sortBy, $this->sortDir);
            })
            ->paginate($this->perPage);

        return view('livewire.job-view', ['jobs' => $jobs]);
    }
}
