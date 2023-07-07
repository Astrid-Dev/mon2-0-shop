<div>
    <div class="modal fade tp-product-modal" id="providerOverviewModal" tabindex="-1"
         aria-labelledby="providerOverviewModal" aria-hidden="true"
         wire:ignore.self
    >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="tp-product-modal-content d-lg-flex align-items-start">
                    <button type="button" class="tp-product-modal-close-btn" data-bs-toggle="modal"
                            wire:click="closeModal"
                            data-bs-target="#providerOverviewModal">
                        <i class="fa-regular fa-xmark"></i>
                    </button>

                    <div class="tp-product-details-action-wrapper">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 d-flex flex-column justify-content-center align-items-center"
                                style="gap: 1rem">
                                <img style="width: 10rem; height: 10rem; border-radius: 50%"
                                     src="{{ $provider->logo_path }}" alt="{{ $provider->name }}"/>
                                <h4 style="margin: 0" class="text-center">{{ $provider->name }}</h4>
                                <livewire:shared.components.product-rating
                                    :rating="$reviewsAverage"
                                    :ratersCount="$reviewsCount"/>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="row">
                                    <div class="tp-login-input-box col-md-6 col-sm-12">
                                        <div class="tp-login-input">
                                            <a href="tel:{{ $provider->phone1 }}" class="provider-overview-details-item">
                                                {{ $provider->phone1 }}
                                            </a>
                                        </div>
                                        <div class="tp-login-input-title">
                                            <label class="provider-overview-details-label">{{ __('provider_overview.phone') }} 1</label>
                                        </div>
                                    </div>
                                    <div class="tp-login-input-box col-md-6 col-sm-12">
                                        <div class="tp-login-input">
                                            @if(!empty($provider->phone2))
                                                <a href="tel:{{ $provider->phone2 }}" class="provider-overview-details-item">
                                                    {{ $provider->phone2 }}
                                                </a>
                                            @else
                                                <div class="provider-overview-details-item">
                                                    ---------------
                                                </div>
                                            @endif
                                        </div>
                                        <div class="tp-login-input-title">
                                            <label class="provider-overview-details-label">{{ __('provider_overview.phone') }} 2</label>
                                        </div>
                                    </div>
                                    <div class="tp-login-input-box col-md-6 col-sm-12">
                                        <div class="tp-login-input">
                                            <a class="provider-overview-details-item"
                                               target="_blank" href="{{ \App\Helpers\Functions::getNewWhatsappChatLink($provider->whatsapp) }}">
                                                {{ $provider->whatsapp }}
                                            </a>
                                        </div>
                                        <div class="tp-login-input-title">
                                            <label class="provider-overview-details-label">{{ __('provider_overview.whatsapp') }}</label>
                                        </div>
                                    </div>
                                    <div class="tp-login-input-box col-md-6 col-sm-12">
                                        <div class="tp-login-input">
                                            <div class="provider-overview-details-item">
                                                {{ $provider->city }}
                                            </div>
                                        </div>
                                        <div class="tp-login-input-title">
                                            <label class="provider-overview-details-label">{{ __('provider_overview.city') }}</label>
                                        </div>
                                    </div>
                                    <div class="tp-login-input-box col-md-12 col-sm-12">
                                        <div class="tp-login-input">
                                            <div class="provider-overview-details-item">
                                                {{ $provider->address }}
                                            </div>
                                        </div>
                                        <div class="tp-login-input-title">
                                            <label class="provider-overview-details-label">{{ __('provider_overview.address') }}</label>
                                        </div>
                                    </div>
                                    <div class="tp-login-input-box col-md-12 col-sm-12">
                                        <div class="tp-login-input">
                                            <div class="provider-overview-details-item">
                                                {{ $provider->description }}
                                            </div>
                                        </div>
                                        <div class="tp-login-input-title">
                                            <label class="provider-overview-details-label">{{ __('provider_overview.address') }} 2</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <h3 class="some-products-title">{{ __('provider_overview.products') }}</h3>
                                @if($provider->products_count > 0)
                                    <a href="{{ route('products', ['provider_id' => $provider->id]) }}" class="btn btn-link">{{ __('provider_overview.view_more') }}</a>
                                @endif
                            </div>

                            @if ($hasLoadedProducts)
                                <div class="row">
                                    @foreach($products as $product)
                                        <div class="col-xl-3 col-lg-3 col-sm-6">
                                            @include('livewire.shared.components.product-item', [
                                                'product' => $product,
                                                'type' => 'sm'
                                            ])
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center">
                                    <i class="fa fa-spin fa-spinner fa-3x"></i>
                                </div>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
