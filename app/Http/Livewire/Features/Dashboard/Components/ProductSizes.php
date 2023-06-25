<?php

namespace App\Http\Livewire\Features\Dashboard\Components;

use App\Helpers\ProductFormValidator;
use Livewire\Component;

class ProductSizes extends Component
{

    public $sizes = [];

    public function rules()
    {
        return ProductFormValidator::getSizesRules();
    }

    public function addSize()
    {
        $this->sizes[] = ['value' => null, 'stock' => null];
        $this->emitSizes();
    }

    public function removeSize($index)
    {
        $this->sizes = array_filter($this->sizes, fn ($i) => $i !== $index, ARRAY_FILTER_USE_KEY);
        $this->emitSizes();
    }

    public function updated($propertyName)
    {
        $this->emitSizes();
        $this->validateOnly($propertyName);
    }

    public function emitSizes()
    {
        $this->emitUp('onUpdateSizes', $this->sizes);
    }

    public function render()
    {
        return view('livewire.features.dashboard.components.product-sizes');
    }
}
