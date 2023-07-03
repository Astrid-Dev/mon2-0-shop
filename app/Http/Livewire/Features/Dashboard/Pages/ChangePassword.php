<?php

namespace App\Http\Livewire\Features\Dashboard\Pages;

use App\Traits\HasToast;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;
use Livewire\Component;
use PHPUnit\Exception;

class ChangePassword extends Component
{
    use HasToast;

    public $state = [
        'current_password' => '',
        'password' => '',
        'password_confirmation' => '',
    ];

    public function changePassword(UpdatesUserPasswords $updater)
    {
        $this->resetErrorBag();
        \Debugbar::log('-');
        $updater->update(Auth::user(), $this->state);
        \Debugbar::log('Change Password');

        if (request()->hasSession()) {
            request()->session()->put([
                'password_hash_'.Auth::getDefaultDriver() => Auth::user()->getAuthPassword(),
            ]);
        }

        $this->state = [
            'current_password' => '',
            'password' => '',
            'password_confirmation' => '',
        ];

        $this->showSuccessToast(__('dashboard.change_password.on_processing_success'));
    }

    public function getUserProperty()
    {
        return Auth::user();
    }

    public function render()
    {
        return view('livewire.features.dashboard.pages.change-password')
            ->extends('livewire.layouts.app')
            ->layoutData(['title' => 'dashboard.change_password.title']);
    }
}
