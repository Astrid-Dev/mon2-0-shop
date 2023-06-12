<?php

namespace App\Http\Livewire\Features\Home\Pages;

use App\Http\Livewire\Layouts\App;
use App\Models\Product;
use Livewire\Component;

class Home extends Component
{
    public $someAds1;
    public $someAds2;

    public function mount()
    {
        $this->someAds1 = Product::customQuery()
            ->with('category')
            ->whereHas('promotion')
            ->inRandomOrder()
            ->take(2)
            ->get();

        $this->someAds2 = Product::customQuery()
            ->with('category')
            ->whereHas('promotion')
            ->inRandomOrder()
            ->take(3)
            ->get();
    }

    public function render()
    {
        return view('livewire.features.home.pages.home')
                ->extends('livewire.layouts.app')
                ->layoutData([
                    'title' => 'home.title',
                    'headerType' => 1
                ]);
    }
}
