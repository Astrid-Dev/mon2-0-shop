<?php

namespace App\Http\Livewire\Shared\Components;

use Livewire\Component;

class ProductRating extends Component
{
    public $rating;
    public $ratersCount;
    public $reviewDisplayType = 'full';

    public function render()
    {
        return view('livewire.shared.components.product-rating');
    }
}
