<?php

namespace App\Livewire\Admin\MagazineCategories;

use App\Models\MagazineCategory;
use Livewire\Component;
use Illuminate\Support\Str;

class Form extends Component
{
    public $categoryId = null;
    public $name = '';
    public $slug = '';
    public $description = '';
    public $order = 0;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:magazine_categories,slug,' . $this->categoryId,
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
        ];
    }

    public function mount($id = null)
    {
        if ($id) {
            $category = MagazineCategory::findOrFail($id);
            $this->categoryId = $category->id;
            $this->name = $category->name;
            $this->slug = $category->slug;
            $this->description = $category->description;
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

        if ($this->categoryId) {
            $category = MagazineCategory::findOrFail($this->categoryId);
            $category->update($data);
            session()->flash('message', 'Category updated successfully.');
        } else {
            MagazineCategory::create($data);
            session()->flash('message', 'Category created successfully.');
        }

        return redirect()->route('admin.magazine-categories.index');
    }

    public function render()
    {
        return view('livewire.admin.magazine-categories.form');
    }
}
