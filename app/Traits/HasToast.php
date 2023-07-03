<?php
namespace App\Traits;

trait HasToast
{
    public function showSuccessToast($message)
    {
        $this->dispatchBrowserEvent('fireToast', [
            'type' => 'success',
            'message' => $message
        ]);
    }

    public function showErrorToast($message)
    {
        $this->dispatchBrowserEvent('fireToast', [
            'type' => 'error',
            'message' => $message
        ]);
    }

    public function showInfoToast($message)
    {
        $this->dispatchBrowserEvent('fireToast', [
            'type' => 'info',
            'message' => $message
        ]);
    }

    public function showWarningToast($message)
    {
        $this->dispatchBrowserEvent('fireToast', [
            'type' => 'warning',
            'message' => $message
        ]);
    }
}

