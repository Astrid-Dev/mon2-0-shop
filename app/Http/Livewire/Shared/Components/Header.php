<?php

namespace App\Http\Livewire\Shared\Components;

use App\Models\Category;
use Livewire\Component;

class Header extends Component
{
    public $categories = [];
    public $type;

    public function render()
    {
        $this->categories = Category::with('descendants')
            ->whereNull('parent_id')
            ->get();
        return view('livewire.shared.components.header');
    }
}
