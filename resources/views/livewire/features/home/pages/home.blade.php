<div>
    <!-- slider area start -->
    <livewire:features.home.components.ads-slider wire:key="'ads-slider-'.rand()" />
    <!-- slider area end -->

    <!-- product category area start -->
    {{--    <livewire:features.home.components.products-categories />--}}
    <!-- product category area end -->

    <!-- feature area start -->
    <livewire:features.home.components.features wire:key="'features-'.rand()" />
    <!-- feature area end -->

    <!-- product area start -->
    <livewire:features.home.components.products wire:key="'products-'.rand()" />
    <!-- product area end -->

    <!-- banner area start -->
    <section class="tp-banner-area pb-70">
        <div class="container">
            <div class="row">
                @foreach($someAds1 as $i => $ad)
                    @if($i === 0)
                        <div wire:key="'some-ad-1-'.$ad->id.rand()" class="col-xl-8 col-lg-7">
                            <div class="tp-banner-item tp-banner-height p-relative mb-30 z-index-1 fix">
                                <div class="tp-banner-thumb include-bg transition-3" data-background={{asset("assets/img/product/banner/product-banner-1.jpg")}}></div>
                                <div class="tp-banner-content">
                                    <span>{{ __('home.some_ads.sale_off1') }}</span>
                                    <h3 class="tp-banner-title w-50">
                                        <a class="max-lines-2" href="{{$ad->details_page_link}}">{{$ad->name}}</a>
                                    </h3>
                                    <div class="tp-banner-btn">
                                        <a href="{{$ad->details_page_link}}" class="tp-link-btn">{{ __('home.some_ads.shop_now') }}
                                            <svg width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.9998 6.19656L1 6.19656" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M8.75674 0.975394L14 6.19613L8.75674 11.4177" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div wire:key="'some-ad-1-'.$ad->id.rand()" class="col-xl-4 col-lg-5">
                            <div class="tp-banner-item tp-banner-item-sm tp-banner-height p-relative mb-30 z-index-1 fix">
                                <div class="tp-banner-thumb include-bg transition-3" data-background={{asset("assets/img/product/banner/product-banner-2.jpg")}}></div>
                                <div class="tp-banner-content">
                                    <h3 class="tp-banner-title w-75">
                                        <a class="max-lines-2" href="{{$ad->details_page_link}}">{{$ad->name}}</a>
                                    </h3>
                                    <p>{{ __('home.some_ads.sale_off2') }}</p>
                                    <div class="tp-banner-btn">
                                        <a href="{{$ad->details_page_link}}" class="tp-link-btn">{{ __('home.some_ads.shop_now') }}
                                            <svg width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.9998 6.19656L1 6.19656" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M8.75674 0.975394L14 6.19613L8.75674 11.4177" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    <!-- banner area end -->

    <!-- product offer area start -->
    <livewire:features.home.components.products-offers wire:key="'product-offers-'.rand()" />
    <!-- product deal area end -->

    <livewire:features.home.components.products-categories wire:key="'product-categories-'.rand()" />

    <!-- product banner area start -->
    <div class="tp-product-banner-area pb-90">
        <div class="container">
            <div class="tp-product-banner-slider fix">
                <div class="tp-product-banner-slider-active swiper-container">
                    <div class="swiper-wrapper">
                        @foreach($someAds2 as $i => $ad)
                            <div wire:key="'some-ad-2-'.$ad->id.rand()" class="tp-product-banner-inner theme-bg p-relative z-index-1 fix swiper-slide">
                                <h4 class="tp-product-banner-bg-text">{{$ad->category->parent?->label ?? $ad->category->label}}</h4>
                                <div class="row align-items-center">
                                    <div class="col-xl-6 col-lg-6">
                                        <div class="tp-product-banner-content p-relative z-index-1">
                                            <span class="tp-product-banner-subtitle single-line-ellipsis">{{$ad->category->label}}</span>
                                            <h3 class="tp-product-banner-title max-lines-3">{{$ad->name}}</h3>
                                            <div class="tp-product-banner-price mb-40">
                                                <span class="old-price">{{$ad->formatted_price->old}} XAF</span>
                                                <p class="new-price">{{$ad->formatted_price->new}} XAF</p>
                                            </div>
                                            <div class="tp-product-banner-btn">
                                                <a href="{{$ad->details_page_link}}" class="tp-btn tp-btn-2">{{ __('home.some_ads.shop_now') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6">
                                        <div class="tp-product-banner-thumb-wrapper p-relative">
                                            <div class="tp-product-banner-thumb-shape">
                                                <span class="tp-product-banner-thumb-gradient"></span>
                                                <img class="tp-offer-shape" src={{asset("assets/img/banner/banner-slider-offer.png")}} alt="">
                                            </div>

                                            <div class="tp-product-banner-thumb text-end p-relative z-index-1">
                                                <img src={{asset("assets/img/banner/banner-slider-1.png")}} alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="tp-product-banner-slider-dot tp-swiper-dot"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- product banner area end -->

    <!-- product arrival area start -->
    <livewire:features.home.components.products-arrival wire:key="'products-arrival-'.rand()" />
    <!-- product arrival area end -->

    <!-- product sm area start -->
    <livewire:features.home.components.products-sm wire:key="'products-sm-'.rand()" />

    <!-- subscribe area start -->
    <livewire:shared.components.newsletter-subscription wire:key="'newsletter-'.rand()" />
    <!-- subscribe area end -->

    <livewire:shared.components.product-quick-view wire:key="'product-quick-view-'.rand()" />

</div>
