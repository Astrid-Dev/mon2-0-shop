<?php

namespace App\Http\Livewire\Features\Dashboard\Components;

use App\Enums\SiblingType;
use Livewire\Component;

class ProductSiblings extends Component
{
    public $siblingIcons = [];
    public $siblings = [];

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

    public function updatedSiblings()
    {
        $this->emitUp('onUpdateSiblings', $this->siblings);
    }

    public function render()
    {
        return view('livewire.features.dashboard.components.product-siblings');
    }
}
