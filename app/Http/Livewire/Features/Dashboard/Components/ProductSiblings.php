<?php

namespace App\Http\Livewire\Features\Dashboard\Components;

use App\Enums\ImageType;
use App\Enums\SiblingType;
use App\Helpers\ProductFormValidator;
use App\Helpers\SavingError;
use App\Models\Product;
use Livewire\Component;

class ProductSiblings extends Component
{
    public $siblingIcons = [];
    public $siblings = [];

    protected $listeners = [
        'saveSiblings'
    ];

    public function mount()
    {
        $this->siblingIcons[SiblingType::KID] = 'fa fa-child';
        $this->siblingIcons[SiblingType::WOMAN] = 'fa fa-person-dress';
        $this->siblingIcons[SiblingType::MAN] = 'fa fa-person';

        foreach (SiblingType::getValues() as $sibling) {
            $this->siblings[$sibling] = [
                'checked' => false,
                'stock' => null,
            ];
        }
    }

    public function saveSiblings(Product $product)
    {
        try {
            if (!empty($product)) {
                $checkedSiblings = array_filter($this->siblings, fn($item) => $item['checked']);
                $siblingsToSave = array_map(
                    fn($sibling, $item) => [
                        'sibling' => $sibling,
                        'stock' => ProductFormValidator::getStockToStore($item['stock'])
                    ],
                    array_keys($checkedSiblings), $checkedSiblings
                );
                $product->siblings()->createMany($siblingsToSave);

                $this->emitUp('onSavingSiblingsSuccess');
            } else {
                throw new SavingError(__('No product was found to save siblings'));
            }
        } catch (\Exception $e) {
            \Debugbar::log($e);
            $this->emitUp('onSavingSiblingsFinished', false, __('dashboard.add_product.product_siblings.on_processing_error'));
        }
    }

    public function updatedSiblings()
    {
        $this->emitUp('onUpdateSiblings', $this->siblings);
    }

    public function render()
    {
        return view('livewire.features.dashboard.components.product-siblings');
    }
}
