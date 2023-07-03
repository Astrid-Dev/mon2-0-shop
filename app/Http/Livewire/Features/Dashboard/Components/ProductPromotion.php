<?php

namespace App\Http\Livewire\Features\Dashboard\Components;

use App\Helpers\ProductFormValidator;
use App\Helpers\SavingError;
use App\Models\Product;
use Livewire\Component;

class ProductPromotion extends Component
{
    public $promotion = null;

    protected $listeners = [
        'savePromotion'
    ];

    public function rules()
    {
        return ProductFormValidator::getPromotionRules();
    }

    public function savePromotion(Product $product)
    {
        try {
            $this->validate();
            if (!empty($product)) {
                if (!empty($this->promotion)) {
                    $product->promotion()->create($this->promotion);
                }
                $this->emitUp('onSavingPromotionFinished');
            } else {
                throw new SavingError(__('No product was found to save promotion'));
            }
        } catch (\Exception $e) {
            \Debugbar::log($e);
            $this->emitUp('onSavingPromotionFinished', false, __('dashboard.add_product.promotion.on_processing_error'));
        }
    }

    public function addPromotion()
    {
        $this->promotion = [
            'start_date' => null,
            'end_date' => null,
            'discount_percentage' => null,
        ];
        $this->emitPromotion();
    }

    public function removePromotion()
    {
        $this->promotion = null;
        $this->emitPromotion();
    }

    public function updated($propertyName)
    {
        $this->emitPromotion();
        $this->validateOnly($propertyName);
    }

    public function updatedPromotion()
    {
        $this->emitPromotion();
    }

    public function emitPromotion()
    {
        $this->emitUp('onUpdatePromotion', $this->promotion);
    }

    public function render()
    {
        return view('livewire.features.dashboard.components.product-promotion');
    }
}
