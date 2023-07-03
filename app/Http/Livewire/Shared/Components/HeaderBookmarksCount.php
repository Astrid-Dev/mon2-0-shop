<?php

namespace App\Http\Livewire\Shared\Components;

use Livewire\Component;

class HeaderBookmarksCount extends Component
{
    public $bookmarksCount;
    public $type = 1;

    protected $listeners = [
        'onBookmarksCountChanged'
    ];

    public function mount()
    {
        $this->refreshCount();
    }

    public function refreshCount()
    {
        $this->bookmarksCount =  auth()->user() ? auth()->user()->bookmarks()->count() : 0;
    }

    public function onBookmarksCountChanged()
    {
        \Debugbar::log('Bookmarks count changed');
        $this->refreshCount();
    }

    public function render()
    {
        return view('livewire.shared.components.header-bookmarks-count');
    }
}
