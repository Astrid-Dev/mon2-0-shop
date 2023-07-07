<div>
    <section class="tp-product-gadget-area pt-80 pb-75">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-5">
                    <div class="tp-product-gadget-sidebar mb-40">
                        <div class="tp-product-gadget-categories p-relative fix mb-10">
                            <div class="tp-product-gadget-thumb">
                                <img src={{asset("assets/img/product/gadget/gadget-girl.png")}} alt="">
                            </div>
                            <h3 class="tp-product-gadget-categories-title">{{$randomCategory->label}}</h3>

                            <div class="tp-product-gadget-categories-list">
                                <ul>
                                    @foreach($randomCategory->descendants as $subCategory)
                                        <li><a href="{{ LaravelLocalization::localizeUrl('/products').('?categories='.$subCategory->id) }}">{{$subCategory->label}}</a></li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="tp-product-gadget-btn">
                                <a href="{{ LaravelLocalization::localizeUrl('/products').('?categories='.$randomCategory->id) }}" class="tp-link-btn">{{ __('home.product_categories.more_products') }}
                                    <svg width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.9998 6.19656L1 6.19656" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M8.75674 0.975394L14 6.19613L8.75674 11.4177" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="tp-product-gadget-banner">
                            <div class="tp-product-gadget-banner-slider-active swiper-container">
                                <div class="swiper-wrapper">
                                    @foreach($someAds as $product)
                                        <div class="tp-product-gadget-banner-item swiper-slide include-bg" data-background={{asset("assets/img/product/gadget/gadget-banner-1.jpg")}}>
                                            <div class="tp-product-gadget-banner-content">
                                                <span class="tp-product-gadget-banner-price">{{ __('home.product_categories.only') }} {{$product->formatted_price->new}} XAF</span>
                                                <h3 class="tp-product-gadget-banner-title">
                                                    <a class="max-lines-2" href="{{$product->details_page_link}}">{{$product->name}}</a>
                                                </h3>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="tp-product-gadget-banner-slider-dot tp-swiper-dot"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-7">
                    <div class="tp-product-gadget-wrapper">
                        <div class="row">
                            @foreach($randomCategory->products as $product)
                                <div class="col-xl-4 col-sm-6">
                                    @include('livewire.shared.components.product-item', [
                                    'product' => $product,
                                    'type' => 'default'
                                ])
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
