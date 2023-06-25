<?php

namespace App\Http\Livewire\Features\Dashboard\Pages;

use Livewire\Component;

class Profile extends Component
{
    public function render()
    {
        return view('livewire.features.dashboard.pages.profile')
            ->extends('livewire.layouts.app')
            ->layoutData(['title' => 'dashboard.profile.title']);
    }
}
