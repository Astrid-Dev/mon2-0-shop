<?php

namespace App\Http\Livewire\Features\Dashboard\Components;

use App\Helpers\ProductFormValidator;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductImages extends Component
{
    use WithFileUploads;

    public $images = [];
    public $mainImageIndex = 0;
    public $cleanStatus = [];

    public function rules()
    {
        return ProductFormValidator::getImagesRules();
    }

    public function addImage()
    {
        if (sizeof($this->images) < 5) {
            $this->images[] = null;
            $this->cleanStatus[] = false;
            $this->emitImages();
        }
    }

    public function removeImage($index)
    {
        $this->images = array_filter($this->images, fn ($i) => $i !== $index, ARRAY_FILTER_USE_KEY);
        $this->cleanStatus = array_filter($this->cleanStatus, fn ($i) => $i !== $index, ARRAY_FILTER_USE_KEY);
        if ($this->mainImageIndex === $index) {
            $this->mainImageIndex = 0;
        }
        $this->emitImages();
    }

    public function updated($propertyName)
    {
        $isForImages = str_starts_with($propertyName, 'images.');
        $index = $isForImages ? intval(explode('.', $propertyName)[1]) : null;
        if ($isForImages) {
            $this->cleanStatus[$index] = false;
        }

//        $this->emitImages();

        $this->validateOnly($propertyName);

        if ($isForImages) {
            $this->cleanStatus[$index] = true;
        }

    }

    public function updatedImages()
    {
        $this->emitImages();
        \Debugbar::log($this->images);
        \Debugbar::log('--------');
    }

    public function updatedMainImageIndex()
    {
        $this->emitImages();
    }

    public function emitImages()
    {
        $this->emitUp('onUpdateImages', $this->images, $this->mainImageIndex);
    }

    public function render()
    {
        return view('livewire.features.dashboard.components.product-images');
    }
}
