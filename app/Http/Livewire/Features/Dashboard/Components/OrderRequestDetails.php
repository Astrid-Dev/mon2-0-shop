<?php

namespace App\Http\Livewire\Features\Dashboard\Components;

use App\Models\OrderRequest;
use Livewire\Component;

class OrderRequestDetails extends Component
{

    public $isOpen = false;
    public OrderRequest $orderRequest;

    protected $listeners = ['onDisplayOrderDetails'];

    public function onDisplayOrderDetails($orderRequest)
    {
        $this->orderRequest = $orderRequest;
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.features.dashboard.components.order-request-details');
    }
}
