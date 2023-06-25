<?php

namespace App\Http\Livewire\Features\Dashboard\Pages;

use App\Enums\Color;
use App\Enums\ImageType;
use App\Enums\ProviderStatus;
use App\Helpers\Functions;
use App\Helpers\ProductFormValidator;
use App\Models\Product;
use App\Traits\HasToast;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class AddProduct extends Component
{
    use HasToast, WithFileUploads;

    public $provider;
    public $canCreateProduct = false;

    public $isProcessing = false;

    public $name;
    public $price;
    public $brandId = null;
    public $categoryId = null;
    public $tags = [];
    public $details = [];
    public $description;
    public $stockType = null;

    public $colors = [];

    public $dimensions = [];

    public $images = [];
    public $mainImageIndex = 0;

    public $promotion = null;

    public $siblings = [];

    public $sizes = [];

    protected $listeners = [
        'onUpdateBasicInformation',
        'onUpdateColors',
        'onUpdateDimensions',
        'onUpdateImages',
        'onUpdatePromotion',
        'onUpdateSiblings',
        'onUpdateSizes',
    ];

    public function rules()
    {
        return ProductFormValidator::getRules();
    }

    public function mount()
    {
        $this->provider = auth()->user()->provider()->first();
        if ($this->provider) {
            $this->canCreateProduct = ProviderStatus::fromValue($this->provider->status)->value === ProviderStatus::APPROVED;
        }
    }

    public function submit()
    {
        try {
            $this->validate();
            $this->isProcessing = true;
            $this->render();

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

            $checkedColors = array_filter($this->colors, fn ($item) => $item['checked']);
            $colorsToSave = array_map(
                fn ($color, $item) => [
                    'value' => $color,
                    'stock' => ProductFormValidator::getStockToStore($item['stock']),
                ],
                array_keys($checkedColors), $checkedColors);

            if (sizeof($colorsToSave) > 0) {
                $product->colors()->createMany($colorsToSave);
            }

            if (sizeof($this->dimensions) > 0) {
                $dimensionsToSave = array_map(
                    fn ($dimension) => array_merge(
                        $dimension,
                        ['stock' => ProductFormValidator::getStockToStore($dimension['stock'])]
                    ),
                    $this->dimensions
                );
                $product->dimensions()->createMany($dimensionsToSave);
            }

            \Debugbar::log($this->images);
            $this->mainImageIndex = (!empty($this->images) && $this->images[$this->mainImageIndex]) ? $this->mainImageIndex : 0;

            $imagesToSave = [];

            foreach ($this->images as $i => $image) {
                if ($image) {
                    $filename = $product->code.'-'.Functions::generateUniqueKey().'.'.$image->getClientOriginalExtension();
                    $image->storeAs('public/products', $filename);
                    $path = 'products/'.$filename;
                    $imagesToSave[] = [
                        'image_type' => ImageType::ILLUSTRATION,
                        'name' => $image->getClientOriginalName(),
                        'path' => $path,
                        'extras' => [
                            "is_main" => $i === $this->mainImageIndex
                        ]
                    ];
                }
            }

            if (!empty($imagesToSave)) {
                $product->images()->createMany($imagesToSave);
            }

            if ($this->promotion) {
                $product->promotion()->create($this->promotion);
            }

            $checkedSiblings = array_filter($this->siblings, fn($item) => $item['checked']);
            $siblingsToSave = array_map(
                fn($sibling, $item) => [
                    'sibling' => $sibling,
                    'stock' => ProductFormValidator::getStockToStore($item['stock'])
                ],
                array_keys($checkedSiblings), $checkedSiblings
            );
            $product->siblings()->createMany($siblingsToSave);

            $sizesToSave = array_map(
                fn($size, $item) => [
                    'value' => $size,
                    'stock' => ProductFormValidator::getStockToStore($item['stock'])
                ],
                array_keys($this->sizes), $this->sizes,
            );
            $product->sizes()->createMany($sizesToSave);

            $this->isProcessing = false;
            $this->render();
            $this->showSuccessToast('Product was successfully created');

        } catch (\Exception $e) {
            \Debugbar::log($e);
            $this->showErrorToast($e->getMessage());
        }
    }

    public function onUpdateBasicInformation($field, $value)
    {
        if ($this->hasProperty($field)) {
            $this->fill([$field => $value]);
            \Debugbar::log($this->getPropertyValue($field));
            \Debugbar::log($this->details);
        }
    }

    public function onUpdateColors($colors)
    {
        $this->colors = $colors;
    }

    public function onUpdateDimensions($dimensions)
    {
        $this->dimensions = $dimensions;
    }

    /**
     * @param TemporaryUploadedFile[] $images
     * @param $mainImageIndex
     * @return void
     */
    public function onUpdateImages(array $images, $mainImageIndex): void
    {
        $this->images = $images;

        foreach ($images as $image) {
//            \Debugbar::log($image->());
        }
        $this->mainImageIndex = $mainImageIndex;
        \Debugbar::log($this->images);
    }

    public function onUpdatePromotion($promotion)
    {
        $this->promotion = $promotion;
    }

    public function onUpdateSiblings($siblings)
    {
        $this->siblings = $siblings;
    }

    public function onUpdateSizes($sizes)
    {
        $this->sizes = $sizes;
        \Debugbar::log($this->sizes);
    }

    public function render()
    {
        return view('livewire.features.dashboard.pages.add-product')
            ->extends('livewire.layouts.app')
            ->layoutData(['title' => 'dashboard.add_product.title']);
    }
}
