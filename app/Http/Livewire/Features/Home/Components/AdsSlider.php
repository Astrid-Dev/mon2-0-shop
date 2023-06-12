<?php

namespace App\Http\Livewire\Features\Home\Components;

use App\Models\Product;
use Livewire\Component;

class AdsSlider extends Component
{
    public $adProducts = [];

    public function mount()
    {
        $this->adProducts = Product::customQuery()
            ->whereHas('promotion')
            ->inRandomOrder()
            ->take(4)
            ->get();
    }

    public function render()
    {
        return view('livewire.features.home.components.ads-slider');
    }
}
