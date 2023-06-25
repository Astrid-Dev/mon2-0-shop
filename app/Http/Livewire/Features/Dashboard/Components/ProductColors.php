<?php

namespace App\Http\Livewire\Features\Dashboard\Components;

use App\Enums\Color;
use Livewire\Component;

class ProductColors extends Component
{
    public $colors = [];

    public function mount()
    {
        foreach (Color::getValues() as $color) {
            $this->colors[$color] = [
                'checked' => false,
                'stock' => null,
            ];
        }
    }

    public function updatedColors()
    {
        $this->emit('onUpdateColors', $this->colors);
    }

    public function render()
    {
        return view('livewire.features.dashboard.components.product-colors');
    }
}
