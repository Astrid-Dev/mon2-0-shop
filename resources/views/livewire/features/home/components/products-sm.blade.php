<div>
    <section class="tp-product-sm-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <div class="tp-product-sm-list mb-50">
                        <div class="tp-section-title-wrapper mb-40">
                            <h3 class="tp-section-title tp-section-title-sm">{{ __('home.products_sm.on_discount') }}
                                <svg width="64" height="20" viewBox="0 0 64 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M62 13.1107C1.91792 -5.41202 -3.10865 1.22305 5.00242 18.3636" stroke="currentColor" stroke-width="3" stroke-miterlimit="3.8637" stroke-linecap="round"/>
                                </svg>
                            </h3>
                        </div>

                        <div class="tp-product-sm-wrapper mr-20">
                            @foreach($discountProducts as $product)
                                <livewire:shared.components.product-item
                                    :product="$product"
                                    :type="'sm'"
                                    :key="'discount-product-'.$product->id.rand()"
                                />
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="tp-product-sm-list mb-50">
                        <div class="tp-section-title-wrapper mb-40">
                            <h3 class="tp-section-title tp-section-title-sm">{{ __('home.products_sm.pre_order') }}
                                <svg width="64" height="20" viewBox="0 0 64 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M62 13.1107C1.91792 -5.41202 -3.10865 1.22305 5.00242 18.3636" stroke="currentColor" stroke-width="3" stroke-miterlimit="3.8637" stroke-linecap="round"/>
                                </svg>
                            </h3>
                        </div>

                        <div class="tp-product-sm-wrapper mr-20">
                            @foreach($preOrderProducts as $product)
                                <livewire:shared.components.product-item
                                    :product="$product"
                                    :type="'sm'"
                                    :key="'product-sm-'.$product->id.rand()"
                                />
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="tp-product-sm-list mb-50">
                        <div class="tp-section-title-wrapper mb-40">
                            <h3 class="tp-section-title tp-section-title-sm">{{ __('home.products_sm.in_stock') }}
                                <svg width="64" height="20" viewBox="0 0 64 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M62 13.1107C1.91792 -5.41202 -3.10865 1.22305 5.00242 18.3636" stroke="currentColor" stroke-width="3" stroke-miterlimit="3.8637" stroke-linecap="round"/>
                                </svg>
                            </h3>
                        </div>

                        <div class="tp-product-sm-wrapper mr-20">
                            @foreach($inStockProducts as $product)
                                <livewire:shared.components.product-item
                                    :product="$product"
                                    :type="'sm'"
                                    :key="'in-stock-product-'.$product->id.rand()"
                                />
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
