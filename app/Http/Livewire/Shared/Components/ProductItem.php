<?php

namespace App\Http\Livewire\Shared\Components;

use Livewire\Component;

class ProductItem extends Component
{

    public $product;
    public $type = 'default'; // 'default', 'offer', 'deal'
    public $customClass = '';

    public function render()
    {
        return view('livewire.shared.components.product-item');
    }
}
