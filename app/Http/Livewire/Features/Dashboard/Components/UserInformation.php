<?php

namespace App\Http\Livewire\Features\Dashboard\Components;

use Livewire\Component;

class UserInformation extends Component
{
    public $username;
    public $email;

    public function mount()
    {
        $this->username = auth()->user()->username;
        $this->email = auth()->user()->email;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $data = $this->validate();
        \Debugbar::log($data);
    }

    protected function rules()
    {
        return [
            'username' => ['required', 'between:3,20', 'unique:users,username,'.auth()->id()],
            'email' => ['required', 'email', 'max:100', 'unique:users,email,'.auth()->id()],
        ];
    }

    public function render()
    {
        return view('livewire.features.dashboard.components.user-information', [
            'canSubmit' => ($this->username !== auth()->user()->username || $this->email !== auth()->user()->email)
        ]);
    }
}
