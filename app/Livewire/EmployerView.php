<?php

namespace App\Livewire;

use App\Models\Employer;
use App\Models\PositionPermission;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;


class EmployerView extends Component
{
    use WithPagination;
    public $search = '';
    public $perPage = 5;
    public $isActive = '';
    public $sortBy = 'users.created_at';
    public $sortDir = 'DESC';
    public $employerEditID;
    public $employerStatus;
    public $employerDeleteID;
    public $isOpen = false;
    public $isDeleteModalOpen = false;

    public function setSortBy($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDir = $this->sortDir == 'ASC' ? ($this->sortDir = 'DESC') : 'ASC';
            return;
        }
        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }

    public function resetFields()
    {
        $this->search = '';
        $this->perPage = 5;
        $this->sortBy = 'users.created_at';
        $this->sortDir = 'DESC';
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function edit($employerID)
    {
        $permission = PositionPermission::getPermission('update employer', Auth::user()->position_id);
        if ($permission) {
            $this->isOpen = true;
            $this->employerEditID = $employerID;
            $this->employerStatus = User::findOrFail($employerID)->status;
        } else {
            abort(404);
        }
    }

    public function update()
    {
        $permission = PositionPermission::getPermission('update employer', Auth::user()->position_id);
        if ($permission) {
            $this->validate([
                'employerStatus' => ['required'],
            ]);

            User::findOrFail($this->employerEditID)->update([
                'status' => $this->employerStatus,
            ]);
            $this->closeUpdateModal();
            request()->session()->flash('success', 'Employer status updated successfully');
        } else {
            abort(404);
        }
    }

    public function closeUpdateModal()
    {
        $this->isOpen = false;
        $this->reset('employerStatus');
        $this->employerEditID = '';
    }

    public function openDeleteModal($userID)
    {
        $this->isDeleteModalOpen = true;
        $this->employerDeleteID = $userID;
    }

    public function delete()
    {
        $permission = PositionPermission::getPermission('delete user', Auth::user()->position_id);
        if ($permission) {
            $user = User::findOrFail($this->employerDeleteID);
            $user->delete();
            $this->closeDeleteModal();
            request()->session()->flash('failure', 'Employer deleted !');
        } else {
            abort(404);
        }
    }
    public function closeDeleteModal()
    {
        $this->isDeleteModalOpen = false;
        $this->employerDeleteID = '';
    }
    public function render()
    {
        $employers = DB::table('employers')
        ->join('users', 'users.id', '=', 'employers.user_id')
        ->leftJoin('jobs', 'employers.id', '=', 'jobs.employer_id')
        ->select(
            'users.id as u_id',
            'employers.id as e_id',
            'users.name as user_name',
            'users.email as user_email',
            'users.status as user_status',
            'employers.name as company',
            'employers.user_id as user_id',
            DB::raw("COUNT(jobs.id) as total_jobs_count"),
            DB::raw("SUM(CASE WHEN jobs.status = 1 THEN 1 ELSE 0 END) as active_jobs_count"),
            DB::raw("SUM(CASE WHEN jobs.featured = 1 THEN 1 ELSE 0 END) as featured_jobs_count")
        )
        ->when($this->search, function ($query) {
            $query->where(function ($query) {
                $query->where('employers.name', 'like', '%' . $this->search . '%')
                    ->orWhere('users.name', 'like', '%' . $this->search . '%')
                    ->orWhere('users.email', 'like', '%' . $this->search . '%');
            });
        })
            ->when($this->isActive !== '', function ($query) {
                $query->where('users.status', $this->isActive);
            })
            ->when($this->sortBy !== 'name', function ($query) {
                $query->orderBy($this->sortBy, $this->sortDir); // Sort dynamically
            })
            ->groupBy(
                'users.id',
                'employers.id',
                'users.name',
                'users.email',
                'users.status',
                'employers.name',
                'employers.user_id'
            )
            ->paginate($this->perPage);



        return view('livewire.employer-view', [
            'employers' => $employers
        ]);
    }
}
