<?php

namespace App\Livewire\Admin\Projects;

use App\Models\Category;
use App\Models\IntraStudioTeamLead;
use App\Models\Project;
use App\Models\ProjectTeamMember;
use App\Models\Team;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Form extends Component
{
    use WithFileUploads;

    public $projectId = null;
    public $mainImage;
    public $mainImagePath;
    public $title = '';
    public $shortDescription = '';
    public $sector = '';
    public $client = '';
    public $location = '';
    public $year = '';
    public $quote = '';
    public $imageGallery = [];
    public $imageGalleryFiles = [];
    public $description = '';
    public $selectedImage;
    public $selectedImagePath;
    public $teamMembers = [];
    public $intraStudioTeamLeads = [];
    public $categoryId = null;
    public $order = 0;
    public $isPublished = false;
    public $inHero = false;

    public $allIntraStudioTeamLeads = [];
    public $allCategories = [];

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'shortDescription' => 'nullable|string',
            'sector' => 'nullable|string|max:255',
            'client' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:1900|max:' . (date('Y') + 10),
            'quote' => 'nullable|string',
            'description' => 'nullable|string',
            'categoryId' => 'nullable|exists:categories,id',
            'order' => 'nullable|integer',
            'isPublished' => 'boolean',
            'inHero' => 'boolean',
            'mainImage' => 'nullable|image|max:10240',
            'selectedImage' => 'nullable|image|max:10240',
            'imageGalleryFiles.*' => 'nullable|image|max:10240',
        ];
    }

    public function mount($id = null)
    {
        $this->allIntraStudioTeamLeads = IntraStudioTeamLead::orderBy('order')->orderBy('name')->get();
        $this->allCategories = Category::orderBy('order')->orderBy('name')->get();

        if ($id) {
            $project = Project::findOrFail($id);
            $this->projectId = $project->id;
            $this->title = $project->title;
            $this->shortDescription = $project->short_description;
            $this->sector = $project->sector;
            $this->client = $project->client;
            $this->location = $project->location;
            $this->year = $project->year;
            $this->quote = $project->quote;
            $this->imageGallery = $project->image_gallery ?? [];
            $this->description = $project->description;
            $this->selectedImagePath = $project->selected_image;
            // Load project team members (simplified - only 2 fields)
            $this->teamMembers = $project->projectTeamMembers->map(function($member) {
                return [
                    'id' => $member->id,
                    'field1' => $member->name ?? '',
                    'field2' => $member->role ?? '',
                    'order' => $member->order,
                ];
            })->toArray();
            $this->categoryId = $project->category_id;
            $this->order = $project->order;
            $this->isPublished = $project->is_published;
            $this->inHero = $project->in_hero;
            $this->mainImagePath = $project->main_image;
            $this->intraStudioTeamLeads = $project->intraStudioTeamLeads->pluck('id')->toArray();
        } else {
            $this->teamMembers = [[
                'id' => null,
                'field1' => '',
                'field2' => '',
                'order' => 0,
            ]];
        }
    }

    public function addTeamMember()
    {
        $this->teamMembers[] = [
            'id' => null,
            'field1' => '',
            'field2' => '',
            'order' => count($this->teamMembers),
        ];
    }

    public function removeTeamMember($index)
    {
        unset($this->teamMembers[$index]);
        $this->teamMembers = array_values($this->teamMembers);
    }

    public function removeGalleryImage($index)
    {
        if (isset($this->imageGallery[$index])) {
            $imagePath = $this->imageGallery[$index];
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            unset($this->imageGallery[$index]);
            $this->imageGallery = array_values($this->imageGallery);
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'short_description' => $this->shortDescription,
            'sector' => $this->sector,
            'client' => $this->client,
            'location' => $this->location,
            'year' => $this->year ? (int) $this->year : null,
            'quote' => $this->quote,
            'description' => $this->description,
            'category_id' => $this->categoryId,
            'order' => $this->order,
            'is_published' => $this->isPublished,
            'in_hero' => $this->inHero,
        ];

        // Handle main image upload
        if ($this->mainImage) {
            if ($this->mainImagePath && Storage::disk('public')->exists($this->mainImagePath)) {
                Storage::disk('public')->delete($this->mainImagePath);
            }
            $data['main_image'] = $this->mainImage->store('projects', 'public');
        } elseif ($this->mainImagePath) {
            $data['main_image'] = $this->mainImagePath;
        }

        // Handle selected image upload
        if ($this->selectedImage) {
            if ($this->selectedImagePath && Storage::disk('public')->exists($this->selectedImagePath)) {
                Storage::disk('public')->delete($this->selectedImagePath);
            }
            $data['selected_image'] = $this->selectedImage->store('projects', 'public');
        } elseif ($this->selectedImagePath) {
            $data['selected_image'] = $this->selectedImagePath;
        }

        // Handle image gallery uploads
        $galleryImages = $this->imageGallery;
        foreach ($this->imageGalleryFiles as $file) {
            if ($file) {
                $galleryImages[] = $file->store('projects/gallery', 'public');
            }
        }
        $data['image_gallery'] = $galleryImages;

        if ($this->projectId) {
            $project = Project::findOrFail($this->projectId);
            $project->update($data);
            
            // Delete existing team members
            $project->projectTeamMembers()->delete();
            session()->flash('message', 'Project updated successfully.');
        } else {
            $project = Project::create($data);
            session()->flash('message', 'Project created successfully.');
        }

        // Save project team members (simplified - only 2 fields)
        foreach ($this->teamMembers as $index => $member) {
            if (!empty($member['field1']) || !empty($member['field2'])) {
                $memberData = [
                    'project_id' => $project->id,
                    'name' => $member['field1'] ?? '',
                    'role' => $member['field2'] ?? '',
                    'surname' => '',
                    'description' => '',
                    'email' => '',
                    'photo' => null,
                    'order' => $member['order'] ?? $index,
                ];
                
                ProjectTeamMember::create($memberData);
            }
        }

        // Sync INTRAstudio team leads
        $project->intraStudioTeamLeads()->sync($this->intraStudioTeamLeads);

        return redirect()->route('admin.projects.index');
    }

    public function render()
    {
        return view('livewire.admin.projects.form');
    }
}
