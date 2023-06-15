<?php

namespace App\Http\Livewire\Shared\Components;

use App\Models\Product;
use Livewire\Component;

class ProductQuickView extends Component
{
    private $product = null;
    public $isOpen = false;

    protected $listeners = ['onQuickViewProduct'];

    public function onQuickViewProduct(Product $product)
    {
        $this->product = $product;
        $this->openModal();
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
        return view('livewire.shared.components.product-quick-view', [
            'product' => $this->product
        ]);
    }
}
