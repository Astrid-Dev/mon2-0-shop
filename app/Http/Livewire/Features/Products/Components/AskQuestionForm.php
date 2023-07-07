<?php

namespace App\Http\Livewire\Features\Products\Components;

use App\Models\OrderRequest;
use App\Models\ProductQuestion;
use App\Traits\HasToast;
use Livewire\Component;

class AskQuestionForm extends Component
{

    use HasToast;

    public $isOpen = false;

    public $question = null;

    public $product_id = null;

    protected $rules = [
        'question' => ['required', 'string', 'between:20,500'],
    ];


    protected $listeners = ['onDisplayQuestionForm'];

    public function onDisplayQuestionForm()
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

        $question = ProductQuestion::query()
            ->create([
                'product_id' => $this->product_id,
                'user_id' => auth()->id(),
                'question' => $this->question,
            ]);

        $this->showSuccessToast(__('ask_question_form.on_processing_success'));
        $this->resetErrorBag();
        $this->resetExcept(['product_id']);
    }
    public function render()
    {
        return view('livewire.features.products.components.ask-question-form');
    }
}
