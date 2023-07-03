<div>
    <livewire:shared.components.breadcrumbs :data="$breadcrumbsData" />

    <section class="tp-banner-area pb-30">
        <div class="container">
            <div class="row">
                @foreach($someAds as $i => $ad)
                    @if($i === 0)
                        <div class="col-xl-8 col-lg-7">
                            <div class="tp-banner-item tp-banner-height p-relative mb-30 z-index-1 fix">
                                <div class="tp-banner-thumb include-bg transition-3" style="background: url({{asset(asset("assets/img/product/banner/product-banner-1.jpg"))}})"></div>
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
                        <div class="col-xl-4 col-lg-5">
                            <div class="tp-banner-item tp-banner-item-sm tp-banner-height p-relative mb-30 z-index-1 fix">
                                <div class="tp-banner-thumb include-bg transition-3" style="background: url({{asset("assets/img/product/banner/product-banner-2.jpg")}})"></div>
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

    <!-- category area start -->
    <section class="tp-category-area pb-120">
        <div class="container">
            <div class="row">
                @foreach($categories as $category)
                    <div class="col-lg-4 col-sm-6">
                        <div class="tp-category-main-box mb-25 p-relative fix" data-bg-color="#F3F5F7">
                            <div class="tp-category-main-thumb include-bg transition-3" style="background: url({{asset("assets/img/category/main/category-main-1.jpg")}})"></div>
                            <div class="tp-category-main-content">
                                <h3 class="tp-category-main-title">
                                    <a href="{{ LaravelLocalization::localizeUrl('/products').('?categories='.$category->id) }}">{{$category->label}}</a>
                                </h3>
                                <span class="tp-category-main-item">{{ trans_choice('categories.products_count', $category->products_count, ['count' => $category->products_count]) }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="tp-category-main-result text-center mb-35 mt-35">
                        <p>
                            {{ __('categories.showing_result', [
                            'retrieved' => sizeof($categories),
                            'total' => $totalCategories ?? 0])}}
                        </p>
                        <div class="tp-category-main-result-bar">
                            <span style="width: {{$loadedCategoriesPercentage}}%"></span>
                        </div>
                    </div>
                    @if($loadedCategoriesPercentage < 100)
                        <div class="tp-category-main-more text-center">
                            <button wire:loading.remove wire:click="retrieveCategoriesNextPage" class="tp-load-more-btn" >
                                {{ __('categories.load_more') }}
                                <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.0003 1.698V5.2986H9.39966" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11.4933 8.29916C11.1032 9.40329 10.3649 10.3507 9.38948 10.9987C8.41408 11.6467 7.2545 11.9601 6.08548 11.8917C4.91647 11.8233 3.80134 11.3768 2.90816 10.6195C2.01497 9.86225 1.3921 8.83518 1.13343 7.69309C0.874748 6.551 0.99427 5.35578 1.47398 4.28753C1.95369 3.21928 2.7676 2.33588 3.79306 1.77045C4.81852 1.20502 5.99998 0.988199 7.15939 1.15265C8.3188 1.31711 9.39335 1.85393 10.2211 2.68222L12.9996 5.29866" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                            <div wire:loading wire:target="retrieveCategoriesNextPage">
                                <i class="fa fa-spinner fa-spin fa-2x tp-search-area"></i>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- category area end -->

    <!-- subscribe area start -->
    <livewire:shared.components.newsletter-subscription />
    <!-- subscribe area end -->

    <livewire:shared.components.product-quick-view />

</div>
