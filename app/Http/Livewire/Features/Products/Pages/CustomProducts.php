<?php

namespace App\Http\Livewire\Features\Products\Pages;

use App\Enums\JerseyType;
use App\Helpers\Functions;
use App\Models\CustomProductRequest;
use App\Traits\HasToast;
use Livewire\Component;
use Livewire\WithFileUploads;

class CustomProducts extends Component
{
    use WithFileUploads, HasToast;

    public $breadcrumbsData = [
        'page_title' => 'custom_products.title',
        'breadcrumbs' => [
            [
                'link' => '',
                'label' => 'categories.breadcrumbs.home'
            ],
            [
                'label' => 'custom_products.title'
            ]
        ]
    ];

    public $jersey_sample = null;
    public $jerseyIsClean = false;
    public $jersey_type = '';
    public $team = '';
    public $championship = '';
    public $season = '';
    public $jersey_details = '';
    public $description = '';
    public $include_flocking = true;
    public $quantity = 1;
    public $flocking_items = [];

    public $customer_name = null;
    public $customer_phone = null;

    public $teamLogoIsClean = false;
    public $team_logo = null;
    public $team_name = null;

    public function rules()
    {
        return [
            'quantity' => ['required', 'integer', 'min:1'],
            'flocking_items' => ['sometimes', 'array'],
            'flocking_items.*.name' => ['required', 'string'],
            'flocking_items.*.bib' => ['sometimes', 'integer'],
            'description' => ['required', 'string', 'between:20,500'],
            'include_flocking' => ['required','boolean'],
            'jersey_sample' => ['sometimes', 'nullable', 'image', 'max:3000'],
            'jersey_type' => ['required', 'string', 'in:'.implode(',', JerseyType::getValues())],
            'championship' => ['required_if:jersey_type,==,'.JerseyType::TEAM, 'string', 'max:255'],
            'season' => ['required_if:jersey_type,==,'.JerseyType::TEAM, 'string', 'max:255'],
            'team' => ['required_if:jersey_type,==,'.JerseyType::TEAM, 'string', 'max:255'],
            'jersey_details' => ['required_if:jersey_type,==,'.JerseyType::TEAM, 'string', 'max:255'],
            'customer_name' => ['required', 'string', 'max:60'],
            'customer_phone' => ['required', 'string', 'max:20'],
            'team_logo' => ['sometimes', 'nullable', 'image', 'max:3000'],
            'team_name' => ['sometimes', 'string', 'nullable'],
        ];
    }

    public function mount()
    {
        $this->jersey_type = JerseyType::TEAM;
        $this->addFlockingItem();
    }

    public function addFlockingItem()
    {
        $this->flocking_items[Functions::generateUniqueKey()] = [
            'name' => null,
            'bib' => null
        ];
    }

    public function removeFlockingItem($key)
    {
        $this->flocking_items = array_filter($this->flocking_items, function ($itemKey) use ($key) {
            return $itemKey !== $key;
        }, ARRAY_FILTER_USE_KEY);
        $this->quantity -= 1;
    }

    public function submit()
    {
        $this->validate();

        $jerseySamplePath = null;
        $teamLogoPath = null;
        if ($this->jerseyIsClean && $this->jersey_sample) {
            $filename = Functions::generateUniqueKey('M20S-CP-').'.'.$this->jersey_sample->getClientOriginalExtension();
            $this->jersey_sample->storeAs('public/jersey-samples', $filename);
            $jerseySamplePath = 'jersey-samples/'.$filename;
        }

        if ($this->include_flocking && $this->teamLogoIsClean && $this->team_logo) {
            $filename = Functions::generateUniqueKey('M20S-TL-').'.'.$this->team_logo->getClientOriginalExtension();
            $this->team_logo->storeAs('public/jersey-samples', $filename);
            $teamLogoPath = 'teams-logo/'.$filename;
        }

        $temp = CustomProductRequest::query()
            ->create([
                'user_id' => auth()->id(),
                'customer_name' => $this->customer_name,
                'customer_phone' => $this->customer_phone,
                'quantity' => intval($this->quantity),
                'description' => $this->description,
                'jersey_type' => $this->jersey_type,
                'jersey_sample' => $jerseySamplePath,
                'include_flocking' => $this->include_flocking,
                'data' => $this->jersey_type === JerseyType::TEAM ? [
                    'team' => $this->team,
                    'championship' => $this->championship,
                    'season' => $this->season,
                    'jersey_details' => $this->jersey_details,
                ] : [
                    'team_name' => $this->team_name,
                    'team_logo' => $teamLogoPath,
                ],
                'flocking_items' => $this->include_flocking ? $this->flocking_items : null,
            ]);

        $this->showSuccessToast(__('custom_products.on_processing_success'));
        redirect()->to(\LaravelLocalization::localizeUrl(route('products')));
    }

    public function updated($propertyName)
    {
        $this->jerseyIsClean = $propertyName === 'jersey_sample' ? false : $this->jerseyIsClean;
        $this->teamLogoIsClean = $propertyName === 'team_logo' ? false : $this->teamLogoIsClean;

        $this->validateOnly($propertyName);

        $this->jerseyIsClean = $propertyName === 'jersey_sample' ? true : $this->jerseyIsClean;
        $this->teamLogoIsClean = $propertyName === 'team_logo' ? true : $this->teamLogoIsClean;
    }

    public function updatedQuantity()
    {
        if (intval($this->quantity) === 0) {
            $this->flocking_items = [];
        } else {
            $intQuantity = intval($this->quantity);
            $itemsSize = sizeof($this->flocking_items);
            if ($intQuantity > $itemsSize) {
                for ($i = 0; $i < ($intQuantity - $itemsSize); $i++) {
                    $this->addFlockingItem();
                }
            } elseif ($intQuantity < $itemsSize) {
                $this->flocking_items = array_slice($this->flocking_items, 0, $intQuantity);
            }
        }
    }

    public function updatedIncludeFlocking()
    {
        if (boolval($this->include_flocking)) {
            $this->updatedQuantity();
        } else {
            $this->flocking_items = [];
        }
    }

    public function render()
    {
        return view('livewire.features.products.pages.custom-products')
            ->extends('livewire.layouts.app')
            ->layoutData(['title' => 'custom_products.title']);
    }
}
