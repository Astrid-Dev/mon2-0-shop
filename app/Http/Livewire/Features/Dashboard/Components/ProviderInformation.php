<?php

namespace App\Http\Livewire\Features\Dashboard\Components;

use Livewire\Component;

class ProviderInformation extends Component
{
    public $provider;
    public $name;
    public $phone1;
    public $phone2;
    public $whatsapp;
    public $city;
    public $address;
    public $description;
    public $logo;
    public $logoIsClean = false;
    public $defaultLogo;

    protected $rules = [
        'name' => ['required', 'max:100'],
        'phone1' => ['required', 'regex:/^2376\d{8}$/'],
        'phone2' => ['sometimes', 'regex:/^2376\d{8}$/'],
        'whatsapp' => ['required', 'regex:/^2376\d{8}$/'],
        'city' => ['required', 'string', 'max:100'],
        'address' => ['required', 'string', 'max:150'],
        'description' => ['required', 'string', 'between:20,255'],
        'logo' => ['sometimes', 'image', 'max:3000']
    ];

    public function mount()
    {
        $this->provider = auth()->user()->provider()->first();
        $this->name = $this->provider->name;
        $this->description = $this->provider->description;
        $this->defaultLogo = public_path($this->provider->logo);
        $this->address = $this->provider->address;
        $this->city = $this->provider->city;
        $this->phone1 = $this->provider->phone1;
        $this->phone2 = $this->provider->phone2;
        $this->whatsapp = $this->provider->whatsapp;
    }
    public function render()
    {
        return view('livewire.features.dashboard.components.provider-information');
    }
}
