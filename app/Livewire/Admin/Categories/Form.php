<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Form extends Component
{
    use WithFileUploads;

    public $categoryId = null;
    public $name = '';
    public $slug = '';
    public $description = '';
    public $coverImage;
    public $coverImagePath;
    public $order = 0;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug,' . $this->categoryId,
            'description' => 'nullable|string',
            'coverImage' => 'nullable|image|max:10240',
            'order' => 'nullable|integer',
        ];
    }

    public function mount($id = null)
    {
        if ($id) {
            $category = Category::findOrFail($id);
            $this->categoryId = $category->id;
            $this->name = $category->name;
            $this->slug = $category->slug;
            $this->description = $category->description;
            $this->coverImagePath = $category->cover_image;
            $this->order = $category->order;
        }
    }

    public function updatedName($value)
    {
        if (empty($this->slug)) {
            $this->slug = Str::slug($value);
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'slug' => $this->slug ?: Str::slug($this->name),
            'description' => $this->description,
            'order' => $this->order,
        ];

        // Handle cover image upload
        if ($this->coverImage) {
            if ($this->coverImagePath && Storage::disk('public')->exists($this->coverImagePath)) {
                Storage::disk('public')->delete($this->coverImagePath);
            }
            $data['cover_image'] = $this->coverImage->store('categories', 'public');
        } elseif ($this->coverImagePath) {
            $data['cover_image'] = $this->coverImagePath;
        }

        if ($this->categoryId) {
            $category = Category::findOrFail($this->categoryId);
            $category->update($data);
            session()->flash('message', 'Category updated successfully.');
        } else {
            Category::create($data);
            session()->flash('message', 'Category created successfully.');
        }

        return redirect()->route('admin.categories.index');
    }

    public function render()
    {
        return view('livewire.admin.categories.form');
    }
}
