<?php

namespace App\Http\Livewire\Features\Dashboard\Components;

use App\Enums\ImageType;
use App\Helpers\ProductFormValidator;
use App\Helpers\SavingError;
use App\Models\Product;
use Debugbar;
use Exception;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class ProductImages extends Component
{
    use WithFileUploads;

    public $images = [];
    public $mainImageIndex = 0;
    public $cleanStatus = [];

    protected $listeners = [
        'onSaveImages'
    ];

    public function rules()
    {
        return ProductFormValidator::getImagesRules();
    }

    public function onSaveImages(Product $product)
    {
        try {
            $this->validate();
            Debugbar::log($this->images);
            $this->mainImageIndex = (!empty($this->images) && $this->images[$this->mainImageIndex]) ? $this->mainImageIndex : 0;

            $imagesToSave = [];

            if (!empty($product)) {
                foreach ($this->images as $i => $image) {
                    if ($image) {
                        $filename = $product->code . '-' . Functions::generateUniqueKey() . '.' . $image->getClientOriginalExtension();
                        $image->storeAs('public/products', $filename);
                        $path = 'products/' . $filename;
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

                $product->images()->createMany($imagesToSave);

                $this->emitUp('onSavingImagesSuccess');
            } else {
                throw new SavingError(__('No product was found to save images'));
            }
        } catch (Exception $e) {
            Debugbar::log($e);
            $this->emitUp('onSavingImagesFinished', false, __('dashboard.add_product.images.on_processing_error'));
        }
    }

    public function addImage()
    {
        if (sizeof($this->images) < 5) {
            $this->images[] = null;
            $this->cleanStatus[] = false;
        }
    }

    public function removeImage($index)
    {
        $this->images = array_filter($this->images, fn ($i) => $i !== $index, ARRAY_FILTER_USE_KEY);
        $this->cleanStatus = array_filter($this->cleanStatus, fn ($i) => $i !== $index, ARRAY_FILTER_USE_KEY);
        if ($this->mainImageIndex === $index) {
            $this->mainImageIndex = 0;
        }
    }

    public function updated($propertyName)
    {
        $isForImages = str_starts_with($propertyName, 'images.');
        $index = $isForImages ? intval(explode('.', $propertyName)[1]) : null;
        if ($isForImages) {
            $this->cleanStatus[$index] = false;
        }

        $this->validateOnly($propertyName);

        if ($isForImages) {
            $this->cleanStatus[$index] = true;
        }

    }

    public function render()
    {
        return view('livewire.features.dashboard.components.product-images');
    }
}
