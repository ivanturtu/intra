<?php

namespace App\Livewire\Admin\IntraStudioTeamLeads;

use App\Models\IntraStudioTeamLead;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Form extends Component
{
    use WithFileUploads;

    public $teamLeadId = null;
    public $name = '';
    public $surname = '';
    public $role = '';
    public $qualification = '';
    public $incipit = '';
    public $visionPhrase = '';
    public $description = '';
    public $email = '';
    public $photo;
    public $photoPath;
    public $order = 0;
    public $quote = '';
    public $resumeLink = '';
    public $fullResume;
    public $fullResumePath;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'surname' => 'nullable|string|max:255',
            'role' => 'nullable|string|max:255',
            'qualification' => 'nullable|string|max:255',
            'incipit' => 'nullable|string',
            'visionPhrase' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'quote' => 'nullable|string',
            'resumeLink' => 'nullable|url|max:500',
            'fullResume' => 'nullable|mimes:pdf|max:10240',
            'photo' => 'nullable|image|max:10240',
            'order' => 'nullable|integer',
        ];
    }

    public function mount($id = null)
    {
        if ($id) {
            $teamLead = IntraStudioTeamLead::findOrFail($id);
            $this->teamLeadId = $teamLead->id;
            $this->name = $teamLead->name;
            $this->surname = $teamLead->surname;
            $this->role = $teamLead->role;
            $this->qualification = $teamLead->qualification ?? '';
            $this->incipit = $teamLead->incipit ?? '';
            $this->visionPhrase = $teamLead->vision_phrase ?? '';
            $this->description = $teamLead->description;
            $this->email = $teamLead->email;
            $this->photoPath = $teamLead->photo;
            $this->order = $teamLead->order;
            $this->quote = $teamLead->quote ?? '';
            $this->resumeLink = $teamLead->resume_link ?? '';
            $this->fullResumePath = $teamLead->full_resume;
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'surname' => $this->surname,
            'role' => $this->role,
            'qualification' => $this->qualification,
            'incipit' => $this->incipit,
            'vision_phrase' => $this->visionPhrase,
            'description' => $this->description,
            'email' => $this->email,
            'order' => $this->order,
            'quote' => $this->quote,
            'resume_link' => $this->resumeLink,
        ];

        // Handle photo upload
        if ($this->photo) {
            if ($this->photoPath && Storage::disk('public')->exists($this->photoPath)) {
                Storage::disk('public')->delete($this->photoPath);
            }
            $data['photo'] = $this->photo->store('intra-studio-team-leads', 'public');
        } elseif ($this->photoPath) {
            $data['photo'] = $this->photoPath;
        }

        // Handle full resume PDF upload
        if ($this->fullResume) {
            if ($this->fullResumePath && Storage::disk('public')->exists($this->fullResumePath)) {
                Storage::disk('public')->delete($this->fullResumePath);
            }
            $data['full_resume'] = $this->fullResume->store('team-leads-resumes', 'public');
        } elseif ($this->fullResumePath) {
            $data['full_resume'] = $this->fullResumePath;
        }

        if ($this->teamLeadId) {
            $teamLead = IntraStudioTeamLead::findOrFail($this->teamLeadId);
            $teamLead->update($data);
            session()->flash('message', 'INTRAstudio Team Lead updated successfully.');
        } else {
            IntraStudioTeamLead::create($data);
            session()->flash('message', 'INTRAstudio Team Lead created successfully.');
        }

        return redirect()->route('admin.intra-studio-team-leads.index');
    }

    public function render()
    {
        return view('livewire.admin.intra-studio-team-leads.form');
    }
}
