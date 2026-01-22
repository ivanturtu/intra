<?php

namespace App\Livewire\Admin\OurStory;

use App\Models\OurStory;
use Livewire\Component;

class Form extends Component
{
    public $intro = '';
    public $description = '';
    public $highlight = '';

    protected function rules()
    {
        return [
            'intro' => 'nullable|string',
            'description' => 'nullable|string',
            'highlight' => 'nullable|string',
        ];
    }

    public function mount()
    {
        $ourStory = OurStory::getOurStory();
        $this->intro = $ourStory->intro ?? '';
        $this->description = $ourStory->description ?? '';
        $this->highlight = $ourStory->highlight ?? '';
    }

    public function save()
    {
        $this->validate();

        $ourStory = OurStory::getOurStory();
        $ourStory->update([
            'intro' => $this->intro,
            'description' => $this->description,
            'highlight' => $this->highlight,
        ]);

        session()->flash('message', 'Our Story updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.our-story.form');
    }
}
