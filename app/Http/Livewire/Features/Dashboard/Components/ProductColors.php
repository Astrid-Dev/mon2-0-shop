<?php

namespace App\Http\Livewire\Features\Dashboard\Components;

use App\Enums\Color;
use App\Enums\ImageType;
use App\Helpers\ProductFormValidator;
use App\Helpers\SavingError;
use App\Models\Product;
use Debugbar;
use Exception;
use Livewire\Component;

class ProductColors extends Component
{
    public $colors = [];

    protected $listeners = [
        'saveColors'
    ];

    public function mount()
    {
        foreach (Color::getValues() as $color) {
            $this->colors[$color] = [
                'checked' => false,
                'stock' => null,
            ];
        }
    }

    public function saveColors(Product $product)
    {
        try {
            if (!empty($product)) {
                $checkedColors = array_filter($this->colors, fn ($item) => $item['checked']);
                $colorsToSave = array_map(
                    fn ($color, $item) => [
                        'value' => $color,
                        'stock' => ProductFormValidator::getStockToStore($item['stock']),
                    ],
                    array_keys($checkedColors), $checkedColors
                );

                $product->colors()->createMany($colorsToSave);
                $this->emitUp('onSavingColorsFinished');
            } else {
                throw new SavingError(__('No product was found to save colors'));
            }
        } catch (Exception $e) {
            Debugbar::log($e);
            $this->emitUp('onSavingColorsFinished', [false, __('dashboard.add_product.colors.on_processing_error')]);
        }
    }

    public function updatedColors()
    {
        $this->emit('onUpdateColors', $this->colors);
    }

    public function render()
    {
        return view('livewire.features.dashboard.components.product-colors');
    }
}
