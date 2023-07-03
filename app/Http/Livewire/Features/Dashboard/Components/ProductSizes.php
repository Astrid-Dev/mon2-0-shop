<?php

namespace App\Http\Livewire\Features\Dashboard\Components;

use App\Helpers\ProductFormValidator;
use App\Helpers\SavingError;
use App\Models\Product;
use Livewire\Component;

class ProductSizes extends Component
{

    public $sizes = [];

    protected $listeners = [
        'saveSizes'
    ];

    public function rules()
    {
        return ProductFormValidator::getSizesRules();
    }

    public function saveSizes(Product $product)
    {
        try {
            $this->validate();
            if (!empty($product)) {
                $sizesToSave = array_map(
                    fn($size, $item) => [
                        'value' => $size,
                        'stock' => ProductFormValidator::getStockToStore($item['stock'])
                    ],
                    array_keys($this->sizes), $this->sizes,
                );
                $product->sizes()->createMany($sizesToSave);
                $this->emitUp('onSavingSizesFinished');
            } else {
                throw new SavingError(__('No product was found to save sizes'));
            }
        } catch (\Exception $e) {
            $this->emitUp('onSavingSizesFinished', false, __('dashboard.add_product.sizes.on_processing_error'));
        }
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
