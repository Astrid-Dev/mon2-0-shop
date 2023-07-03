<?php

namespace App\Http\Livewire\Features\Products\Components;

use App\Helpers\Functions;
use App\Models\OrderRequest;
use App\Traits\HasToast;
use Livewire\Component;

class OrderRequestForm extends Component
{
    use HasToast;

    public $isOpen = false;

    public $quantity = 1;
    public $description = null;

    public $product_id = null;

    public $customer_name = null;
    public $customer_phone = null;

    protected $rules = [
        'quantity' => ['required', 'integer', 'min:1'],
        'description' => ['required', 'string', 'between:20,500'],
        'customer_name' => ['required', 'string', 'max:60'],
        'customer_phone' => ['required', 'string', 'max:20'],
        'product_id' => ['required', 'integer', 'exists:products,id']
    ];


    protected $listeners = ['onDisplayRequestOrderForm'];

    public function onDisplayRequestOrderForm()
    {
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

    public function submit()
    {
        $this->validate();

        $orderRequest = OrderRequest::query()
            ->create([
                'product_id' => $this->product_id,
                'user_id' => auth()->id(),
                'customer_name' => $this->customer_name,
                'customer_phone' => $this->customer_phone,
                'quantity' => $this->quantity,
                'description' => $this->description,
            ]);

        $this->showSuccessToast(__('order_request_form.on_processing_success'));
        $this->resetErrorBag();
        $this->resetExcept(['quantity', 'product_id']);
    }

    public function render()
    {
        return view('livewire.features.products.components.order-request-form');
    }
}
