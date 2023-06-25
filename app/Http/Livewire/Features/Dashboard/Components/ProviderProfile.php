<?php

namespace App\Http\Livewire\Features\Dashboard\Components;

use Livewire\Component;

class ProviderProfile extends Component
{
    public $provider;

    public function mount()
    {
        $this->provider = auth()->user()
            ->provider()
            ->withAvg('reviews as reviews_avg', 'rating')
            ->first();
    }
    public function render()
    {
        return view('livewire.features.dashboard.components.provider-profile');
    }
}
