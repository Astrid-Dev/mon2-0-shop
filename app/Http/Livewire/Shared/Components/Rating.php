<?php

namespace App\Http\Livewire\Shared\Components;

use Livewire\Component;

class Rating extends Component
{

    public $rating;
    public $ratersCount;

    public function render()
    {
        return view('livewire.shared.components.rating');
    }

}
