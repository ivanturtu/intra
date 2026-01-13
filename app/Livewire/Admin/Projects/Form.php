<?php

namespace App\Livewire\Admin\Projects;

use App\Models\Category;
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
    public $teamLeads = [];
    public $categoryId = null;
    public $order = 0;
    public $isPublished = false;
    public $inHero = false;

    public $allTeams = [];
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
        $this->allTeams = Team::orderBy('name')->get();
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
            // Load project team members
            $this->teamMembers = $project->projectTeamMembers->map(function($member) {
                return [
                    'id' => $member->id,
                    'name' => $member->name,
                    'surname' => $member->surname,
                    'role' => $member->role,
                    'description' => $member->description,
                    'email' => $member->email,
                    'photo' => $member->photo,
                    'order' => $member->order,
                ];
            })->toArray();
            $this->categoryId = $project->category_id;
            $this->order = $project->order;
            $this->isPublished = $project->is_published;
            $this->inHero = $project->in_hero;
            $this->mainImagePath = $project->main_image;
            $this->teamLeads = $project->teamLeads->pluck('id')->toArray();
        } else {
            $this->teamMembers = [[
                'id' => null,
                'name' => '',
                'surname' => '',
                'role' => '',
                'description' => '',
                'email' => '',
                'photo' => null,
                'order' => 0,
            ]];
        }
    }

    public function addTeamMember()
    {
        $this->teamMembers[] = [
            'id' => null,
            'name' => '',
            'surname' => '',
            'role' => '',
            'description' => '',
            'email' => '',
            'photo' => null,
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

        // Save project team members
        foreach ($this->teamMembers as $index => $member) {
            if (!empty($member['name']) || !empty($member['surname']) || !empty($member['role'])) {
                $memberData = [
                    'project_id' => $project->id,
                    'name' => $member['name'] ?? '',
                    'surname' => $member['surname'] ?? '',
                    'role' => $member['role'] ?? '',
                    'description' => $member['description'] ?? '',
                    'email' => $member['email'] ?? '',
                    'order' => $member['order'] ?? $index,
                ];
                
                // Handle photo upload for this team member
                if (isset($this->teamMemberPhotos[$index]) && $this->teamMemberPhotos[$index]) {
                    // Delete old photo if exists
                    if (isset($member['photo']) && $member['photo'] && Storage::disk('public')->exists($member['photo'])) {
                        Storage::disk('public')->delete($member['photo']);
                    }
                    $memberData['photo'] = $this->teamMemberPhotos[$index]->store('team-members', 'public');
                } elseif (isset($member['photo']) && $member['photo']) {
                    $memberData['photo'] = $member['photo'];
                }
                
                ProjectTeamMember::create($memberData);
            }
        }

        // Sync team leads
        $project->teamLeads()->sync($this->teamLeads);

        return redirect()->route('admin.projects.index');
    }

    public function render()
    {
        return view('livewire.admin.projects.form');
    }
}
