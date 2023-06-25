<?php

namespace App\Http\Livewire\Features\Dashboard\Components;

use App\Enums\StockType;
use App\Helpers\ProductFormValidator;
use App\Models\Brand;
use App\Models\Category;
use Livewire\Component;

class ProductBasicInformation extends Component
{
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

    public function rules()
    {
        return ProductFormValidator::getBasicInformationRules();
    }

    public function mount()
    {
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

    public function addTag()
    {
        if (sizeof($this->tags) < 5) {
            $this->tags[] = '';
            $this->emitTags();
        }
    }

    public function removeTag($index)
    {
        $this->tags = array_filter($this->tags, fn ($i) => $i !== $index, ARRAY_FILTER_USE_KEY);
        $this->emitTags();
    }

    public function addDetail()
    {
        if (sizeof($this->details) < 5) {
            $this->details[] = '';
            $this->emitDetails();
        }
    }

    public function removeDetail($index)
    {
        $this->details = array_filter($this->details, fn ($i) => $i !== $index, ARRAY_FILTER_USE_KEY);
        $this->emitDetails();
    }

    public function selectCategory($parentIndex, $childIndex =  null)
    {
        if ($childIndex) {
            $this->selectedCategory = $this->categories[$parentIndex]->descendants[$childIndex];
        } else {
            $this->selectedCategory = $this->categories[$parentIndex];
        }
        $this->categoryId = $this->selectedCategory->id;
        $this->emitUp('onUpdateBasicInformation', 'categoryId', $this->categoryId);
    }

    public function selectBrand($brandIndex)
    {
        $this->selectedBrand = $this->brands[$brandIndex];
        $this->brandId = $this->selectedBrand->id;
        $this->emitUp('onUpdateBasicInformation', 'brandId', $this->brandId);
    }

    public function updated($propertyName)
    {
        $this->emitUp('onUpdateBasicInformation', $propertyName, $this->getPropertyValue($propertyName));
        $this->validateOnly($propertyName);
    }

    public function emitDetails()
    {
        $this->emitUp('onUpdateBasicInformation', 'details', $this->details);
    }

    public function emitTags()
    {
        $this->emitUp('onUpdateBasicInformation', 'tags', $this->tags);
    }

//    public function updatedTags()
//    {
//        $temp = $this->validateOnly('tags');
//        \Debugbar::log($temp);
//        \Debugbar::log($this->tags);
//    }

    public function render()
    {
        return view('livewire.features.dashboard.components.product-basic-information');
    }
}
