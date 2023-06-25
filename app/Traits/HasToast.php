<?php
namespace App\Traits;

trait HasToast
{
    public function showSuccessToast($message)
    {
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => $message
        ]);
    }

    public function showErrorToast($message)
    {
        $this->dispatchBrowserEvent('alert', [
            'type' => 'error',
            'message' => $message
        ]);
    }

    public function showInfoToast($message)
    {
        $this->dispatchBrowserEvent('alert', [
            'type' => 'info',
            'message' => $message
        ]);
    }
}

