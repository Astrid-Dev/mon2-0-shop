<?php

namespace App\Http\Livewire\Features\Provider\Pages;

use App\Enums\ProviderStatus;
use App\Helpers\Functions;
use App\Models\Provider;
use App\Traits\HasToast;
use Livewire\Component;
use Livewire\WithFileUploads;

class BecomeProvider extends Component
{
    use HasToast, WithFileUploads;

    public $name;
    public $phone1;
    public $phone2 = null;
    public $whatsapp;
    public $city;
    public $address;
    public $description;
    public $logo;
    public $logoIsClean = false;

    protected $rules = [
        'name' => ['required', 'max:100'],
        'phone1' => ['required', 'regex:/^2376\d{8}$/'],
        'phone2' => ['sometimes', 'nullable', 'regex:/^2376\d{8}$/'],
        'whatsapp' => ['required', 'regex:/^2376\d{8}$/'],
        'city' => ['required', 'string', 'max:100'],
        'address' => ['required', 'string', 'max:150'],
        'description' => ['required', 'string', 'between:20,255'],
        'logo' => ['sometimes', 'image', 'max:1024']
    ];

    public function submit()
    {
        $data = $this->validate();

        $providerCode = Functions::generateUniqueKey('M20S-SLR-');
        $filename = $providerCode.'.'.$this->logo->getClientOriginalExtension();
        $this->logo->storeAs('public/providers', $filename);
        $path = 'providers/'.$filename;
        Provider::query()->create(array_merge(
            array_filter($data, fn ($key) => !in_array($key, ['logo']), ARRAY_FILTER_USE_KEY),
            [
                'logo' => $path,
                'code' => $providerCode,
                'user_id' => auth()->id(),
                'status' => ProviderStatus::PENDING
            ]
        ));
        $this->showSuccessToast('Please enter a valid address or address combination');
        redirect()->to(\LaravelLocalization::localizeUrl('/home'));
    }

    public function updated($propertyName)
    {
        $this->logoIsClean = $propertyName === 'logo' ? false : $this->logoIsClean;
        $temp = $this->validateOnly($propertyName);
        if ($propertyName === 'phone1' && (!$this->whatsapp || $this->whatsapp === '')) {
            $this->whatsapp = $temp['phone1'];
        }
        $this->logoIsClean = $propertyName === 'logo' ? true : $this->logoIsClean;
    }

    public function render()
    {
        return view('livewire.features.provider.pages.become-provider')
            ->extends('livewire.layouts.app')
            ->layoutData(['title' => 'become_a_seller.title']);
    }
}
