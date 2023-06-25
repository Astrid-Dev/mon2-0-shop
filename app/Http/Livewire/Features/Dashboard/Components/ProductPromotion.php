<?php

namespace App\Http\Livewire\Features\Dashboard\Components;

use App\Helpers\ProductFormValidator;
use Livewire\Component;

class ProductPromotion extends Component
{
    public $promotion = null;

    public function rules()
    {
        return ProductFormValidator::getPromotionRules();
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
