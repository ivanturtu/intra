<?php

namespace App\Livewire\Admin\IntraStudioTeamLeads;

use App\Models\IntraStudioTeamLead;
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
        IntraStudioTeamLead::findOrFail($id)->delete();
        session()->flash('message', 'INTRAstudio Team Lead deleted successfully.');
    }

    public function render()
    {
        $teamLeads = IntraStudioTeamLead::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('surname', 'like', '%' . $this->search . '%')
                    ->orWhere('role', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->orderBy('order')
            ->orderBy('name')
            ->paginate($this->perPage);

        return view('livewire.admin.intra-studio-team-leads.index', [
            'teamLeads' => $teamLeads,
        ]);
    }
}
