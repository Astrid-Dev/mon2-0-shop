<?php

namespace App\Http\Livewire\Features\Dashboard\Components;

use App\Enums\DimensionType;
use App\Helpers\ProductFormValidator;
use Livewire\Component;

class ProductDimensions extends Component
{
    public $dimensions = [];

    public function rules()
    {
        return ProductFormValidator::getDimensionsRules();
    }

    public function addDimension()
    {
        $this->dimensions[] = ['type' => null, 'value' => null, 'unit' => null, 'stock' => null];
        $this->emitDimensions();
    }

    public function removeDimension($index)
    {
        $this->dimensions = array_filter($this->dimensions, fn ($i) => $i !== $index, ARRAY_FILTER_USE_KEY);
        $this->emitDimensions();
    }

    public function setDimensionType($index, $type)
    {
        if ($this->dimensions[$index]) {
            $this->dimensions[$index]['type'] = $type;
            $this->emitDimensions();
        }
    }

    public function setDimensionUnit($index, $unit)
    {
        if ($this->dimensions[$index]) {
            $this->dimensions[$index]['unit'] = $unit;
            $this->emitDimensions();
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedDimensions()
    {
        $this->emitDimensions();
    }

    public function emitDimensions()
    {
        $this->emitUp('onUpdateDimensions', $this->dimensions);
    }

    public function render()
    {
        return view('livewire.features.dashboard.components.product-dimensions');
    }
}
