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

    public Product|null $product = null;

    public $isProcessing = false;

    public $hasSavedBasicInformation = false;
    public $hasSavedColors = false;
    public $hasSavedDimensions = false;
    public $hasSavedImages = false;
    public $hasSavedPromotion = false;
    public $hasSavedSiblings = false;
    public $hasSavedSizes = false;

    protected $listeners = [
        'onSavingBasicInformationFinished',
        'onSavingColorsFinished',
        'onSavingDimensionsFinished',
        'onSavingImagesFinished',
        'onSavingPromotionFinished',
        'onSavingSiblingsFinished',
        'onSavingSizesFinished',
    ];

    public function mount()
    {
        $this->provider = auth()->user()->provider()->first();
        if ($this->provider) {
            $this->canCreateProduct = ProviderStatus::fromValue($this->provider->status)->value === ProviderStatus::APPROVED;
        }
    }

    public function submit()
    {
        $this->isProcessing = true;
        $this->render();
        $this->saveBasicInformation();
    }

    public function saveBasicInformation()
    {
        if (!$this->hasSavedBasicInformation) {
            $this->emitTo('features.dashboard.components.product-basic-information', 'saveBasicInformation');
        } else {
            $this->saveColors();
        }
    }
    public function onSavingBasicInformationFinished($product, $hasSucceed =  true, $message = null)
    {
        \Debugbar::log('onSavingBasicInformationFinished');
        \Debugbar::log($product);
        \Debugbar::log($hasSucceed);
        \Debugbar::log($message);
        $this->hasSavedBasicInformation = $hasSucceed;
        if (!$hasSucceed || !$product) {
            $this->onProcessingError($message);
        } else {
            $this->product = new Product($product);
            $this->saveColors();
        }
    }

    public function saveColors()
    {
        if (!$this->hasSavedColors) {
            $this->emitTo('features.dashboard.components.product-colors', 'saveColors', $this->product);
        } else {
            $this->saveDimensions();
        }
    }
    public function onSavingColorsFinished($hasSucceed = true, $message = null)
    {
        $this->hasSavedColors = $hasSucceed;
        if (!$hasSucceed) {
            $this->onProcessingError($message);
        } else {
            $this->saveDimensions();
        }
    }

    public function saveDimensions()
    {
        if (!$this->hasSavedDimensions) {
            $this->emitTo('features.dashboard.components.product-dimensions', 'saveDimensions', $this->product);
        } else {
            $this->saveImages();
        }
    }
    public function onSavingDimensionsFinished($hasSucceed = true, $message = null)
    {
        $this->hasSavedDimensions = $hasSucceed;
        if (!$hasSucceed) {
            $this->onProcessingError($message);
        } else {
            $this->saveImages();
        }
    }

    public function saveImages()
    {
        if (!$this->hasSavedImages) {
            $this->emitTo('features.dashboard.components.product-images', 'saveImages', $this->product);
        } else {
            $this->savePromotion();
        }
    }
    public function onSavingImagesFinished($hasSucceed = true, $message = null)
    {
        $this->hasSavedImages = $hasSucceed;
        if (!$hasSucceed) {
            $this->onProcessingError($message);
        } else {
            $this->savePromotion();
        }
    }

    public function savePromotion()
    {
        if (!$this->hasSavedPromotion) {
            $this->emitTo('features.dashboard.components.product-promotion', 'savePromotion', $this->product);
        } else {
            $this->saveSiblings();
        }
    }
    public function onSavingPromotionFinished($hasSucceed = true, $message = null)
    {
        $this->hasSavedPromotion = $hasSucceed;
        if (!$hasSucceed) {
            $this->onProcessingError($message);
        } else {
            $this->saveSiblings();
        }
    }

    public function saveSiblings()
    {
        if (!$this->hasSavedSiblings) {
            $this->emitTo('features.dashboard.components.product-siblings', 'saveSiblings', $this->product);
        } else {
            $this->saveSizes();
        }
    }
    public function onSavingSiblingsFinished($hasSucceed = true, $message = null)
    {
        $this->hasSavedSiblings = $hasSucceed;
        if (!$hasSucceed) {
            $this->onProcessingError($message);
        } else {
            $this->saveSizes();
        }
    }

    public function saveSizes()
    {
        if (!$this->hasSavedSizes) {
            $this->emitTo('features.dashboard.components.product-sizes', 'saveSizes', $this->product);
        } else {
            $this->saveProduct();
        }
    }
    public function onSavingSizesFinished($hasSucceed = true, $message = null)
    {
        $this->hasSavedSizes = $hasSucceed;
        if (!$hasSucceed) {
            $this->onProcessingError($message);
        } else {
            $this->saveProduct();
        }
    }

    public function onProcessingSuccess()
    {
        $this->isProcessing = false;
        $this->render();
        $this->showSuccessToast(__('dashboard.add_product.on_processing_success'));
    }

    public function onProcessingError($message)
    {
        $this->showErrorToast($message);
        $this->isProcessing = false;
        $this->render();
    }

    public function render()
    {
        return view('livewire.features.dashboard.pages.add-product')
            ->extends('livewire.layouts.app')
            ->layoutData(['title' => 'dashboard.add_product.title']);
    }
}
