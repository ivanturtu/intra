<?php

namespace App\Livewire\Admin\Projects;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    protected $queryString = ['search'];

    public function delete($id)
    {
        Project::findOrFail($id)->delete();
        session()->flash('message', 'Project deleted successfully.');
    }

    public function render()
    {
        $projects = Project::query()
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('client', 'like', '%' . $this->search . '%')
                    ->orWhere('sector', 'like', '%' . $this->search . '%');
            })
            ->orderBy('order')
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.admin.projects.index', [
            'projects' => $projects,
        ]);
    }
}
