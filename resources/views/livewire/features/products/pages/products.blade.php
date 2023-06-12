<div>
    <livewire:shared.components.breadcrumbs :data="$breadcrumbsData" />

    <section class="tp-shop-area pb-120">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4">
                    <div class="tp-shop-sidebar mr-10">
                        <!-- filter -->
                        <div class="tp-shop-widget mb-35">
                            <h3 class="tp-shop-widget-title no-border">Price Filter</h3>

                            <div class="tp-shop-widget-content">
                                <div class="tp-shop-widget-filter">
                                    <div id="slider-range" class="mb-10"></div>
                                    <div class="tp-shop-widget-filter-info d-flex align-items-center justify-content-between">
                                    <span class="input-range">
                                       <input type="text" id="amount" readonly>
                                    </span>
                                        <button class="tp-shop-widget-filter-btn" type="button">Filter</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- status -->
                        <div class="tp-shop-widget mb-50">
                            <h3 class="tp-shop-widget-title">Product Status</h3>

                            <div class="tp-shop-widget-content">
                                <div class="tp-shop-widget-checkbox">
                                    <ul class="filter-items filter-checkbox">
                                        <li class="filter-item checkbox">
                                            <input id="on_sale" type="checkbox">
                                            <label for="on_sale">On sale</label>
                                        </li>
                                        <li class="filter-item checkbox">
                                            <input id="in_stock" type="checkbox">
                                            <label for="in_stock">In Stock</label>
                                        </li>
                                    </ul><!-- .filter-items -->
                                </div>
                            </div>
                        </div>
                        <!-- categories -->
                        <div class="tp-shop-widget mb-50">
                            <h3 class="tp-shop-widget-title">Categories</h3>

                            <div class="tp-shop-widget-content">
                                <div class="tp-shop-widget-categories">
                                    <ul>
                                        @foreach($categories as $category)
                                            <li wire:key="'category-'.(rand() * $category->id)"><a href="#">{{$category->label}} <span>{{$category->products_count}}</span></a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- color -->
                        <div class="tp-shop-widget mb-50">
                            <h3 class="tp-shop-widget-title">Filter by Color</h3>

                            <div class="tp-shop-widget-content">
                                <div class="tp-shop-widget-checkbox-circle-list">
                                    <ul>
                                        <li>
                                            <div class="tp-shop-widget-checkbox-circle">
                                                <input type="checkbox" id="red">
                                                <label for="red">Red</label>
                                                <span data-bg-color="#FF401F" class="tp-shop-widget-checkbox-circle-self"></span>
                                            </div>
                                            <span class="tp-shop-widget-checkbox-circle-number">8</span>
                                        </li>
                                        <li>
                                            <div class="tp-shop-widget-checkbox-circle">
                                                <input type="checkbox" id="dark_blue">
                                                <label for="dark_blue">Dark Blue</label>
                                                <span data-bg-color="#4666FF" class="tp-shop-widget-checkbox-circle-self"></span>
                                            </div>
                                            <span class="tp-shop-widget-checkbox-circle-number">14</span>
                                        </li>
                                        <li>
                                            <div class="tp-shop-widget-checkbox-circle">
                                                <input type="checkbox" id="oragnge">
                                                <label for="oragnge">Orange</label>
                                                <span data-bg-color="#FF9E2C" class="tp-shop-widget-checkbox-circle-self"></span>
                                            </div>
                                            <span class="tp-shop-widget-checkbox-circle-number">18</span>
                                        </li>
                                        <li>
                                            <div class="tp-shop-widget-checkbox-circle">
                                                <input type="checkbox" id="purple">
                                                <label for="purple">Purple</label>
                                                <span data-bg-color="#B615FD" class="tp-shop-widget-checkbox-circle-self"></span>
                                            </div>
                                            <span class="tp-shop-widget-checkbox-circle-number">23</span>
                                        </li>
                                        <li>
                                            <div class="tp-shop-widget-checkbox-circle">
                                                <input type="checkbox" id="yellow">
                                                <label for="yellow">Yellow</label>
                                                <span data-bg-color="#FFD747" class="tp-shop-widget-checkbox-circle-self"></span>
                                            </div>
                                            <span class="tp-shop-widget-checkbox-circle-number">17</span>
                                        </li>
                                        <li>
                                            <div class="tp-shop-widget-checkbox-circle">
                                                <input type="checkbox" id="green">
                                                <label for="green">Green</label>
                                                <span data-bg-color="#41CF0F" class="tp-shop-widget-checkbox-circle-self"></span>
                                            </div>
                                            <span class="tp-shop-widget-checkbox-circle-number">15</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- product rating -->
                        <div class="tp-shop-widget mb-50">
                            <h3 class="tp-shop-widget-title">Top Rated Products</h3>

                            <div class="tp-shop-widget-content">
                                <div class="tp-shop-widget-product">
                                    @foreach($topRatedProducts as $product)
                                        <div class="tp-shop-widget-product-item d-flex align-items-center">
                                            <div class="tp-shop-widget-product-thumb">
                                                <a href="product-details.html">
                                                    <img src={{asset("assets/img/product/shop/sm/shop-sm-1.jpg")}} alt="">
                                                </a>
                                            </div>
                                            <div class="tp-shop-widget-product-content">
                                                <livewire:shared.components.product-rating
                                                    :reviewDisplayType="'short'"
                                                    :rating="$product->reviews_avg"
                                                    :ratersCount="$product->reviews_count"/>
                                                <h4 class="tp-shop-widget-product-title">
                                                    <a href="product-details.html" class="max-lines-2">{{$product->name}}</a>
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
                            <h3 class="tp-shop-widget-title">Popular Brands</h3>

                            <div class="tp-shop-widget-content ">
                                <div class="tp-shop-widget-brand-list d-flex align-items-center justify-content-between flex-wrap">
                                    @foreach($popularBrands as $brand)
                                        <div wire:key="'brand-'.(rand() * $brand->id)" class="tp-shop-widget-brand-item">
                                            <a href="#">
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
                                            <p>Showing 1–14 of 26 results</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="tp-shop-top-right d-sm-flex align-items-center justify-content-xl-end">
                                        <div class="tp-shop-top-select">
                                            <select>
                                                <option >Default Sorting</option>
                                                <option >Low to Hight</option>
                                                <option >High to Low</option>
                                                <option >New Added</option>
                                                <option >On Sale</option>
                                            </select>
                                        </div>
                                        <div class="tp-shop-top-filter">
                                            <button type="button" class="tp-filter-btn">
                                          <span>
                                             <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14.9998 3.45001H10.7998" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M3.8 3.45001H1" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M6.5999 5.9C7.953 5.9 9.0499 4.8031 9.0499 3.45C9.0499 2.0969 7.953 1 6.5999 1C5.2468 1 4.1499 2.0969 4.1499 3.45C4.1499 4.8031 5.2468 5.9 6.5999 5.9Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M15.0002 11.15H12.2002" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M5.2 11.15H1" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M9.4002 13.6C10.7533 13.6 11.8502 12.5031 11.8502 11.15C11.8502 9.79691 10.7533 8.70001 9.4002 8.70001C8.0471 8.70001 6.9502 9.79691 6.9502 11.15C6.9502 12.5031 8.0471 13.6 9.4002 13.6Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                             </svg>
                                          </span>
                                                Filter
                                            </button>
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
                                            <div wire:key="'product-item-'.(rand()*$product->id)" class="col-xl-4 col-md-6 col-sm-6 infinite-item">
                                                <div class="tp-product-item-2 mb-40">
                                                    <div class="tp-product-thumb-2 p-relative z-index-1 fix w-img">
                                                        <a href="product-details.html">
                                                            <img src={{asset("assets/img/product/2/prodcut-1.jpg")}} alt="">
                                                        </a>
                                                        <!-- product action -->
                                                        <livewire:shared.components.product-actions :product="$product" :type="2" />
                                                    </div>
                                                    <div class="tp-product-content-2 pt-15">
                                                        <div class="tp-product-tag-2">
                                                            <a href="#">{{$product->category->label}}</a>
                                                        </div>
                                                        <h3 class="tp-product-title-2">
                                                            <a href="product-details.html" class="max-lines-2">{{$product->name}}</a>
                                                        </h3>
                                                        <livewire:shared.components.product-rating
                                                            :reviewDisplayType="'none'"
                                                            :rating="$product->reviews_avg"
                                                            :ratersCount="$product->reviews_count"/>
                                                        <div class="tp-product-price-wrapper-2">
                                                            <span class="tp-product-price-2 new-price">{{$product->formatted_price->new}} XAF</span>
                                                            @if($product->is_in_promotion)
                                                                <span class="tp-product-price-2 old-price">{{$product->formatted_price->old}} XAF</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{$products->links()}}
                        <div class="infinite-pagination d-none">
                            <a href="shop.html" class="infinite-next-link">Next</a>
                        </div>
                        <div class="tp-shop-pagination mt-20">
                            <div class="tp-pagination">
                                <nav>
                                    <ul>
                                        <li>
                                            <a href="shop.html" class="tp-pagination-prev prev page-numbers">
                                                <svg width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1.00017 6.77879L14 6.77879" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M6.24316 11.9999L0.999899 6.77922L6.24316 1.55762" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="shop.html">1</a>
                                        </li>
                                        <li>
                                            <span class="current">2</span>
                                        </li>
                                        <li>
                                            <a href="shop.html">3</a>
                                        </li>
                                        <li>
                                            <a href="shop.html" class="next page-numbers">
                                                <svg width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M13.9998 6.77883L1 6.77883" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M8.75684 1.55767L14.0001 6.7784L8.75684 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </a>
                                        </li>
                                    </ul>
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
