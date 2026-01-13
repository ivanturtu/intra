<?php

namespace App\Livewire\Admin\MagazineCategories;

use App\Models\MagazineCategory;
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
        MagazineCategory::findOrFail($id)->delete();
        session()->flash('message', 'Category deleted successfully.');
    }

    public function render()
    {
        $categories = MagazineCategory::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('slug', 'like', '%' . $this->search . '%');
            })
            ->orderBy('order')
            ->orderBy('name')
            ->paginate($this->perPage);

        return view('livewire.admin.magazine-categories.index', [
            'categories' => $categories,
        ]);
    }
}
