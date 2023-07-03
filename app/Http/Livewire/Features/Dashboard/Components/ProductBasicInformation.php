<?php

namespace App\Http\Livewire\Features\Dashboard\Components;

use App\Enums\StockType;
use App\Helpers\Functions;
use App\Helpers\ProductFormValidator;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Provider;
use Livewire\Component;

class ProductBasicInformation extends Component
{
    public Provider $provider;

    public $name;
    public $price;
    public $brandId = null;
    public $categoryId = null;
    public $tags;
    public $details;
    public $description;
    public $stockType = null;

    public $categories;
    public $brands;

    public $selectedCategory = null;
    public $selectedBrand = null;

    protected $listeners = [
        'saveBasicInformation'
    ];

    public function rules()
    {
        return ProductFormValidator::getBasicInformationRules();
    }

    public function mount(Provider $provider)
    {
        $this->provider = $provider;
        $this->tags[] = '';
        $this->details[] = '';

        $this->brands = Brand::query()
            ->orderBy('name')
            ->get();
        $this->categories = Category::query()
            ->with('descendants')
            ->whereNull('parent_id')
            ->get();
    }

    public function saveBasicInformation()
    {
        try {
            $this->validate();
            $product = $this->provider->products()
                ->create([
                    'code' => Functions::generateUniqueKey('M20S-PDT-'),
                    'name' => $this->name,
                    'price' => $this->price,
                    'category_id' => $this->categoryId,
                    'brand_id' => $this->brandId,
                    'details' => $this->details,
                    'description' => $this->description,
                    'stock_type' => $this->stockType,
                    'tags' => $this->tags
                ]);
            $this->emitUp('onSavingBasicInformationFinished', $product);
        } catch (\Exception $e) {
            \Debugbar::log($e);
            $this->emitUp('onSavingBasicInformationFinished', null, false, $e->getMessage());
        }
    }

    public function addTag()
    {
        if (sizeof($this->tags) < 5) {
            $this->tags[] = '';
        }
    }

    public function removeTag($index)
    {
        $this->tags = array_filter($this->tags, fn ($i) => $i !== $index, ARRAY_FILTER_USE_KEY);
    }

    public function addDetail()
    {
        if (sizeof($this->details) < 5) {
            $this->details[] = '';
        }
    }

    public function removeDetail($index)
    {
        $this->details = array_filter($this->details, fn ($i) => $i !== $index, ARRAY_FILTER_USE_KEY);
    }

    public function selectCategory($parentIndex, $childIndex =  null)
    {
        if ($childIndex) {
            $this->selectedCategory = $this->categories[$parentIndex]->descendants[$childIndex];
        } else {
            $this->selectedCategory = $this->categories[$parentIndex];
        }
        $this->categoryId = $this->selectedCategory->id;
    }

    public function selectBrand($brandIndex)
    {
        $this->selectedBrand = $this->brands[$brandIndex];
        $this->brandId = $this->selectedBrand->id;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.features.dashboard.components.product-basic-information');
    }
}
