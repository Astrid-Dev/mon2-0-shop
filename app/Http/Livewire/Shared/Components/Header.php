<?php

namespace App\Http\Livewire\Shared\Components;

use App\Models\Category;
use App\Models\Provider;
use Livewire\Component;

class Header extends Component
{
    public $categories = [];
    public $type;
    public $linkedProvider = null;

    public function mount()
    {
        $this->linkedProvider = Provider::query()
            ->where('user_id', auth()->id())
            ->first();

        if($this->type === 1) {
            $this->categories = Category::with('descendants')
                ->whereNull('parent_id')
                ->get();
        }
    }

    public function render()
    {
        return view('livewire.shared.components.header');
    }
}
