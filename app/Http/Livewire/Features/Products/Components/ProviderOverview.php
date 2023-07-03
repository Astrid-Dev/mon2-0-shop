<?php

namespace App\Http\Livewire\Features\Products\Components;

use App\Models\Provider;
use Livewire\Component;

class ProviderOverview extends Component
{
    public Provider $provider;
    public $hasLoadedProducts = false;
    public $products = [];

    public $isOpen = false;

    protected $listeners = ['onDisplayProviderOverview'];

    public function onDisplayProviderOverview()
    {
        \Debugbar::log($this->hasLoadedProducts);
        if (!$this->hasLoadedProducts) {
            $this->products = $this->provider
                ->products()
                ->withAvg('reviews as reviews_avg', 'rating')
                ->with(['category'])
                ->inRandomOrder()
                ->take(4)
                ->get();
            $this->hasLoadedProducts = true;
        }
        $this->openModal();
    }

    public function mount(Provider $provider)
    {
        $this->provider = $provider;
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function render()
    {
        $reviewsCount = $this->provider->reviews()->count();
        $reviewsAverage = $this->provider->reviews()->avg('rating');
        return view('livewire.features.products.components.provider-overview', [
            'reviewsCount' => $reviewsCount,
            'reviewsAverage' => $reviewsAverage
        ]);
    }
}
