<?php
namespace App\Traits;

trait HasAlert
{
    public function askConfirmation(
        $message,
        $listener, // [('onConfirm' | '...') => ['callback' => string, 'data' => array]]
        $buttons // ['confirm' => string, 'deny' => string]
    )
    {
        $this->dispatchBrowserEvent('fireConfirmationAlert', [
            'title' => __('helpers.confirmation_request'),
            'message' => $message,
            'confirmButtonText' => $buttons['confirm'],
            'denyButtonText' => $buttons['deny'],
            'events' => [
                'onConfirm' => [
                    'callback' => $listener['onConfirm']['callback'],
                    'data' => $listener['onConfirm']['data']
                ]
            ]
        ]);
    }
}

