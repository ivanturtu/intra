<?php

namespace App\Livewire\Admin\Magazine;

use App\Models\MagazineArticle;
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
        MagazineArticle::findOrFail($id)->delete();
        session()->flash('message', 'Article deleted successfully.');
    }

    public function render()
    {
        $articles = MagazineArticle::query()
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('text', 'like', '%' . $this->search . '%');
            })
            ->with('category')
            ->orderBy('date', 'desc')
            ->orderBy('order')
            ->paginate($this->perPage);

        return view('livewire.admin.magazine.index', [
            'articles' => $articles,
        ]);
    }
}
