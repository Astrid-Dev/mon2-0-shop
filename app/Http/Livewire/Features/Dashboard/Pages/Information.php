<?php

namespace App\Http\Livewire\Features\Dashboard\Pages;

use Livewire\Component;

class Information extends Component
{
    public function render()
    {
        return view('livewire.features.dashboard.pages.information')
            ->extends('livewire.layouts.app')
            ->layoutData(['title' => 'dashboard.information.title']);
    }
}
