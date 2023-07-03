<div>
    <livewire:shared.components.breadcrumbs :data="$breadcrumbsData" />

    <section class="tp-shop-area pb-120">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4">
                    <div class="tp-shop-sidebar mr-10">

                        <!-- search -->
                        <div class="tp-shop-widget mb-35">
                            <h3 class="tp-shop-widget-title no-border">{{ __('products.search') }}</h3>

                            <div class="tp-shop-widget-content">
                                <div class="tp-shop-widget-filter">
                                    <div class="tp-header-search-2 d-none d-sm-block">
                                        <input aria-label="" type="text"
                                               wire:model.debounce.400ms="search"
                                               placeholder="{{ __('products.search_placeholder') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- filter -->
                        <div class="tp-shop-widget mb-35">
                            <h3 class="tp-shop-widget-title no-border">{{ __('products.price_filter') }}</h3>

                            <div class="tp-shop-widget-content">
                                <div class="tp-shop-widget-filter" x-data>
                                    <div id="slider-range" class="mb-10"></div>
                                    <div class="tp-shop-widget-filter-info d-flex align-items-center justify-content-between">
                                        <span class="input-range">
                                            <script>function temp(val) {console.log(val)}</script>
                                            <input x-ref="amount" @input="$wire.handlePrice(0, 0)" type="text" id="amount">
                                        </span>
                                        <button @click="$wire.handlePrice($refs.amount.min, $refs.amount.max)" class="tp-shop-widget-filter-btn" type="button">{{ __('products.filter') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- status -->
                        <div class="tp-shop-widget mb-50">
                            <h3 class="tp-shop-widget-title">{{ __('products.product_status') }}</h3>

                            <div class="tp-shop-widget-content">
                                <div class="tp-shop-widget-checkbox">
                                    <ul class="filter-items filter-checkbox">
                                        @foreach(\App\Enums\StockType::getValues() as $statusValue)
                                            <?php $statusEnum = \App\Enums\StockType::fromValue($statusValue) ?>

                                            <li class="filter-item checkbox"
                                                x-data="{isActive: @js(in_array($statusValue, explode(',', $status)))}"
                                            >
                                                <input wire:change="handleStatus('{{ $statusEnum->value }}')"
                                                       id="{{$statusValue}}" type="checkbox"
                                                       :checked="isActive"
                                                       @change="isActive = !isActive"
                                                >
                                                <label for="{{$statusValue}}">{{$statusEnum->description}}</label>
                                            </li>
                                        @endforeach
                                        <li class="filter-item checkbox"
                                            x-data="{isActive: @js($asset === 'discount')}"
                                        >
                                            <input wire:change="handleDiscount()"
                                                   id="discount" type="checkbox"
                                                   :checked="isActive"
                                                   @change="isActive = !isActive"
                                            >
                                            <label for="discount">{{ __('products.discount') }}</label>
                                        </li>
                                    </ul><!-- .filter-items -->
                                </div>
                            </div>
                        </div>
                        <!-- sibling -->
                        <div class="tp-shop-widget mb-50">
                            <h3 class="tp-shop-widget-title">{{ __('products.sibling') }}</h3>

                            <div class="tp-shop-widget-content">
                                <div class="tp-shop-widget-checkbox">
                                    <ul class="filter-items filter-checkbox">
                                        @foreach(\App\Enums\SiblingType::getValues() as $siblingValue)
                                            <?php $siblingEnum = \App\Enums\SiblingType::fromValue($siblingValue) ?>

                                            <li class="filter-item checkbox"
                                                x-data="{isActive: @js(in_array($siblingValue, explode(',', $siblings)))}"
                                            >
                                                <input wire:change="handleSiblings('{{ $siblingEnum->value }}')"
                                                       :checked="isActive"
                                                       @change="isActive = !isActive"
                                                       id="{{$siblingValue}}" type="checkbox">
                                                <label for="{{$siblingValue}}">{{$siblingEnum->description}}</label>
                                            </li>
                                        @endforeach
                                    </ul><!-- .filter-items -->
                                </div>
                            </div>
                        </div>
                        <!-- categories -->
                        <div class="tp-shop-widget mb-50">
                            <h3 class="tp-shop-widget-title">{{ __('products.categories') }}</h3>

                            <div class="tp-shop-widget-content">
                                <div class="tp-shop-widget-categories">
                                    <ul>
                                        @foreach($childrenCategories as $category)
                                            <li x-data="{isActive: @js($this->isConcernedByCategoryFilter($category->id, $category->parent_id))}"
                                                :class="isActive ? 'active' : ''"
{{--                                                class="{{$this->isConcernedByCategoryFilter($category->id, $category->parent_id) ? 'active' : ''}}"--}}
                                                >
                                                <a wire:click="handleCategories({{$category->id}}, {{$category->parent_id}})"
                                                   @click="isActive = !isActive"
                                                >
                                                    {{$category->label}}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- color -->
                        <div class="tp-shop-widget mb-50">
                            <h3 class="tp-shop-widget-title">{{ __('products.filter_by_color') }}</h3>

                            <div class="tp-shop-widget-content">
                                <div class="tp-shop-widget-checkbox-circle-list tp-shop-widget-categories">
                                    <ul>
                                        @foreach(\App\Enums\Color::getValues() as $colorValue)
                                            <?php $colorEnum = \App\Enums\Color::fromValue($colorValue) ?>
{{--                                            <li x-data="{isActive: @js(in_array($colorValue, explode(',', $colors)))}"--}}
{{--                                                :class="isActive ? 'active' : ''"--}}
{{--                                                wire:key="'color-'.rand()">--}}
{{--                                                <a wire:click="handleColors('{{$category->id}}', '{{$category->parent_id}}')"--}}
{{--                                                   @click="isActive = !isActive"--}}
{{--                                                >--}}
{{--                                                    {{$colorEnum->description}}--}}
{{--                                                </a>--}}
{{--                                            </li>--}}

                                            <li
                                                x-data="{isActive: @js(in_array($colorValue, explode(',', $colors)))}"
                                                :class="isActive ? 'active' : ''"
                                            >
                                                <div class="tp-shop-widget-checkbox-circle">
                                                    <input :checked="isActive"
                                                           wire:input.prevent="handleColors('{{$colorValue}}')"
                                                           @input="isActive = !isActive"
                                                           type="checkbox" id="{{$colorEnum->key.'-color'}}">
                                                    <label for="{{$colorEnum->key.'-color'}}">{{$colorEnum->description}}</label>
                                                    <span style="background-color: {{$colorValue}}" class="tp-shop-widget-checkbox-circle-self"></span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- product rating -->
                        <div class="tp-shop-widget mb-50">
                            <h3 class="tp-shop-widget-title">{{ __('products.top_rated_products') }}</h3>

                            <div class="tp-shop-widget-content">
                                <div class="tp-shop-widget-product">
                                    @foreach($topRatedProducts as $product)
                                        <div class="tp-shop-widget-product-item d-flex align-items-center">
                                            <div class="tp-shop-widget-product-thumb">
                                                <a href="{{$product->details_page_link}}">
                                                    <img src={{asset("assets/img/product/shop/sm/shop-sm-1.jpg")}} alt="">
                                                </a>
                                            </div>
                                            <div class="tp-shop-widget-product-content">
                                                <livewire:shared.components.product-rating
                                                    :key="'top-product-rating-'.$product->id.rand()"
                                                    :reviewDisplayType="'short'"
                                                    :rating="$product->reviews_avg"
                                                    :ratersCount="$product->reviews_count"/>
                                                <h4 class="tp-shop-widget-product-title">
                                                    <a href="{{$product->details_page_link}}" class="max-lines-2">{{$product->name}}</a>
                                                </h4>
                                                <div class="tp-shop-widget-product-price-wrapper">
                                                    <span class="tp-shop-widget-product-price">{{$product->formatted_price->new}} XAF</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- brand -->
                        <div class="tp-shop-widget mb-50">
                            <h3 class="tp-shop-widget-title">{{ __('products.popular_brands') }}</h3>

                            <div class="tp-shop-widget-content">
                                <div class="tp-shop-widget-brand-list tp-shop-widget-categories d-flex align-items-center justify-content-between flex-wrap">
                                    @foreach($popularBrands as $brand)
                                        <div
                                             wire:click="handleBrands({{$brand->id}})"
                                             x-data="{isActive: @js(in_array($brand->id, explode(',', $brands)))}"
                                             @click="isActive = !isActive"
                                             :class="isActive ? 'tp-shop-widget-brand-item active' : 'tp-shop-widget-brand-item'"
                                             title="{{$brand->name}}"
                                        >
                                            <a class="cursor-pointer">
                                                <img src={{asset("assets/img/product/shop/brand/logo_01.png")}} alt="">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="tp-shop-main-wrapper">

                        <div class="tp-shop-top mb-45">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="tp-shop-top-left d-flex align-items-center h-100">
                                        <div class="tp-shop-top-result">
                                            <p>{{ __('products.results', ['from' => $from, 'to' => $to, 'total' => $total]) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="tp-shop-top-right d-sm-flex align-items-center justify-content-xl-end">
                                        <div class="tp-shop-top-select">
                                            <div class="nice-select" tabindex="0">
                                                <span class="current">
                                                    {{ __('products.sorts.'.str_replace('-desc', '', str_replace('-asc', '', $sorting))) }}
                                                    @if(str_ends_with($sorting, '-asc'))
                                                        (asc &#8593;)
                                                    @elseif(str_ends_with($sorting, '-desc'))
                                                        (desc &#8595;)
                                                    @endif
                                                </span>
                                                <ul class="list">
                                                    @foreach($sortingValues as $sortingValue)
                                                        <li wire:click="$set('sorting', '{{$sortingValue}}')"
                                                            data-value="{{$sortingValue}}" class="option">
                                                            {{ __('products.sorts.'.str_replace('-desc', '', str_replace('-asc', '', $sortingValue))) }}
                                                            @if(str_ends_with($sortingValue, '-asc'))
                                                                (asc &#8593;)
                                                            @elseif(str_ends_with($sortingValue, '-desc'))
                                                                (desc &#8595;)
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tp-shop-items-wrapper tp-shop-item-primary">
                            <div class="tab-content" id="productTabContent">
                                <div class="tab-pane fade show active" id="grid-tab-pane" role="tabpanel" aria-labelledby="grid-tab" tabindex="0">
                                    <div class="row infinite-container">
                                        @foreach($products as $product)
                                            <div class="col-xl-4 col-md-6 col-sm-6 infinite-item">
                                                <livewire:shared.components.product-item
                                                    :product="$product"
                                                    :type="'listing'"
                                                    :key="'product-item-'.$product->id.rand()"
                                                />
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tp-shop-pagination mt-20">
                            <div class="tp-pagination">
                                <nav>
                                    {{$products->links()}}
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- subscribe area start -->
    <livewire:shared.components.newsletter-subscription />
    <!-- subscribe area end -->

    <livewire:shared.components.product-quick-view />

</div>
