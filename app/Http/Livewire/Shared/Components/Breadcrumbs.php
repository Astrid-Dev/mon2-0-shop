<?php

namespace App\Http\Livewire\Shared\Components;

use Livewire\Component;

class Breadcrumbs extends Component
{
    private $breadcrumbsData = [];
    private $type = 1;

    public function mount($data, $type = 1)
    {
        $this->breadcrumbsData = $data;
        $this->type = $type;
    }

    public function render()
    {
        return view('livewire.shared.components.breadcrumbs', [
            'breadcrumbsData' => $this->breadcrumbsData,
            'type' => $this->type
        ]);
    }
}
