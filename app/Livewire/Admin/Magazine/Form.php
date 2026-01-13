<?php

namespace App\Livewire\Admin\Magazine;

use App\Models\Category;
use App\Models\MagazineArticle;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Form extends Component
{
    use WithFileUploads;

    public $articleId = null;
    public $title = '';
    public $date = '';
    public $text = '';
    public $image;
    public $imagePath;
    public $imageGallery = [];
    public $imageGalleryFiles = [];
    public $categoryId = null;
    public $order = 0;
    public $isPublished = false;

    public $allCategories = [];

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'text' => 'nullable|string',
            'categoryId' => 'nullable|exists:categories,id',
            'order' => 'nullable|integer',
            'isPublished' => 'boolean',
            'image' => 'nullable|image|max:10240',
            'imageGalleryFiles.*' => 'nullable|image|max:10240',
        ];
    }

    public function mount($id = null)
    {
        $this->allCategories = Category::orderBy('order')->orderBy('name')->get();

        if ($id) {
            $article = MagazineArticle::findOrFail($id);
            $this->articleId = $article->id;
            $this->title = $article->title;
            $this->date = $article->date->format('Y-m-d');
            $this->text = $article->text;
            $this->imageGallery = $article->image_gallery ?? [];
            $this->categoryId = $article->category_id;
            $this->order = $article->order;
            $this->isPublished = $article->is_published;
            $this->imagePath = $article->image;
        }
    }

    public function updatedTitle($value)
    {
        // Slug will be auto-generated on save
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
            'slug' => Str::slug($this->title),
            'date' => $this->date,
            'text' => $this->text,
            'category_id' => $this->categoryId,
            'order' => $this->order,
            'is_published' => $this->isPublished,
        ];

        // Handle main image upload
        if ($this->image) {
            if ($this->imagePath && Storage::disk('public')->exists($this->imagePath)) {
                Storage::disk('public')->delete($this->imagePath);
            }
            $data['image'] = $this->image->store('magazine', 'public');
        } elseif ($this->imagePath) {
            $data['image'] = $this->imagePath;
        }

        // Handle image gallery uploads
        $galleryImages = $this->imageGallery;
        foreach ($this->imageGalleryFiles as $file) {
            if ($file) {
                $galleryImages[] = $file->store('magazine/gallery', 'public');
            }
        }
        $data['image_gallery'] = $galleryImages;

        if ($this->articleId) {
            $article = MagazineArticle::findOrFail($this->articleId);
            $article->update($data);
            session()->flash('message', 'Article updated successfully.');
        } else {
            $article = MagazineArticle::create($data);
            session()->flash('message', 'Article created successfully.');
        }

        return redirect()->route('admin.magazine.index');
    }

    public function render()
    {
        return view('livewire.admin.magazine.form');
    }
}
