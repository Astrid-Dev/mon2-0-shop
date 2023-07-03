<?php

namespace App\Http\Livewire\Features\Dashboard\Components;

use App\Enums\DimensionType;
use App\Helpers\ProductFormValidator;
use App\Helpers\SavingError;
use App\Models\Product;
use Livewire\Component;

class ProductDimensions extends Component
{
    public $dimensions = [];

    protected $listeners = [
        'saveDimensions'
    ];

    public function rules()
    {
        return ProductFormValidator::getDimensionsRules();
    }

    public function saveDimensions(Product $product)
    {
        try {
            $this->validate();
            if (!empty($product)) {
                $dimensionsToSave = array_map(
                    fn($dimension) => array_merge(
                        $dimension,
                        ['stock' => ProductFormValidator::getStockToStore($dimension['stock'])]
                    ),
                    $this->dimensions
                );
                $product->dimensions()->createMany($dimensionsToSave);
                $this->emitUp('onSavingDimensionsFinished');
            } else {
                throw new SavingError(__('No product was found to save dimensions'));
            }
        } catch (\Exception $e) {
            \Debugbar::log($e);
            $this->emitUp('onSavingDimensionsFinished', false, __('dashboard.add_product.dimensions.on_processing_error'));
        }
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
