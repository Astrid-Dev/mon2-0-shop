<div>

    <livewire:shared.components.breadcrumbs :data="$breadcrumbsData" :type="2" />

    <section class="tp-product-details-area">
        <div class="tp-product-details-top pb-115">
            <div class="container">
                <div class="row">
                    <div class="col-xl-7 col-lg-6" wire:ignore>
                        <div class="tp-product-details-thumb-wrapper tp-tab d-sm-flex">
                            <nav>
                                <div class="nav nav-tabs flex-sm-column " id="productDetailsNavThumb" role="tablist">
                                    @forelse($product->images as $i => $image)
                                        <button class="nav-link {{ $loop->first ? 'active' : ''}}" id="nav-{{$i}}-tab"
                                                data-bs-toggle="tab"
                                                data-bs-target="#nav-{{$i}}"
                                                type="button" role="tab"
                                                aria-controls="nav-{{$i}}" aria-selected="true">
                                            <img src="{{asset($image->url)}}" alt="{{ $image->name }}">
                                        </button>
                                    @empty
                                        <button class="nav-link active" id="nav-1-tab"
                                                data-bs-toggle="tab"
                                                data-bs-target="#nav-1"
                                                type="button" role="tab"
                                                aria-controls="nav-1" aria-selected="true">
                                            <img src="{{asset($product->main_image_path)}}" alt="{{ $product->name }}">
                                        </button>
                                    @endforelse
                                </div>
                            </nav>
                            <div class="tab-content m-img" id="productDetailsNavContent">
                                @forelse($product->images as $i => $image)
                                    <div class="tab-pane fade show {{ $loop->first ? 'active': ''}}" id="nav-{{$i}}"
                                         role="tabpanel" aria-labelledby="nav-{{$i}}-tab" tabindex="0">
                                        <div class="tp-product-details-nav-main-thumb">
                                            <img src="{{asset($image->url)}}" alt="{{ $image->name }}">
                                        </div>
                                    </div>
                                @empty
                                    <div class="tab-pane fade show active" id="nav-1"
                                         role="tabpanel" aria-labelledby="nav-1-tab" tabindex="0">
                                        <div class="tp-product-details-nav-main-thumb">
                                            <img style="width: 580px; height: 670px; object-fit: cover;" src={{$product->main_image_path}} alt="{{ $product->name }}">
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div> <!-- col end -->
                    <div class="col-xl-5 col-lg-6">
                        <div class="tp-product-details-wrapper">
                            <div class="tp-product-details-category">
                                <span>{{$product?->category?->label}}</span>
                            </div>
                            <h3 class="tp-product-details-title">{{$product?->name}}</h3>

                            <!-- inventory details -->
                            <div class="tp-product-details-inventory d-flex align-items-center mb-10">
                                <div class="tp-product-details-stock mb-10">
                                    @switch($product->stock_type)
                                        @case(\App\Enums\StockType::IN_STOCK)
                                            <span class="text-primary">
                                                {{\App\Enums\StockType::fromValue($product->stock_type)->description}}
                                            </span>
                                            @break
                                        @case(\App\Enums\StockType::PRE_ORDER)
                                            <span class="text-success">
                                                {{\App\Enums\StockType::fromValue($product->stock_type)->description}}
                                            </span>
                                            @break
                                        @case(\App\Enums\StockType::OUT_OF_STOCK)
                                            <span class="text-danger">
                                                {{\App\Enums\StockType::fromValue($product->stock_type)->description}}
                                            </span>
                                            @break
                                    @endswitch
                                </div>
                                <div class="tp-product-details-rating-wrapper d-flex align-items-center mb-10">
                                    <livewire:shared.components.product-rating
                                        :key="'global-rating2-'.rand()"
                                        :rating="$product->reviews_avg"
                                        :ratersCount="$product->reviews_count"/>
                                </div>
                            </div>
                            <p class="max-lines-2">{{substr($product->description, 0, 100)}}... <span>{{ __('product_details.see_more') }}</span></p>
                            <ul style="padding-left: 1rem" class="mb-25">
                                @foreach(array_slice($product->details, 0, 3) as $details)
                                    @if($details !== '')
                                        <li><span>{{$details}}</span></li>
                                    @endif
                                @endforeach
                            </ul>

                            <!-- price -->
                            <div class="tp-product-details-price-wrapper mb-20">
                                @if($product->is_in_promotion)
                                    <span class="tp-product-details-price old-price">{{$product->formatted_price->old}} XAF</span>
                                @endif
                                <span class="tp-product-details-price new-price">{{$product->formatted_price->new}} XAF</span>
                            </div>

                            <!-- variations -->
                            <div class="tp-product-details-variation">
                                <!-- single item -->
                                @if(sizeof($product?->colors ?? []) > 0)
                                    <div class="tp-product-details-variation-item">
                                        <h4 class="tp-product-details-variation-title">{{ __('product_details.additional_information.colors') }} :</h4>
                                        <div class="tp-product-details-variation-list">
                                            @foreach($product?->colors as $color)
                                                <button type="button" class="color tp-color-variation-btn" >
                                                    <span data-bg-color="{{$color->value}}"></span>
                                                    <span class="tp-color-variation-tootltip">
                                                        {{(!in_array($color->name, [null, ''])) ? $color->name : __('product_details.additional_information.no_color_name')}}
                                                    </span>
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <!-- single item -->
                                @if(sizeof($product?->sizes ?? []) > 0)
                                    <div class="tp-product-details-variation-item">
                                        <h4 class="tp-product-details-variation-title">{{ __('product_details.additional_information.sizes') }} :</h4>
                                        <div class="tp-product-details-variation-list">
                                            @foreach($product?->sizes as $size)
                                                <button type="button" class=" tp-size-variation-btn" >
                                                    <span>{{$size->value}}</span>
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <!-- single item -->
                                @if(sizeof($product?->siblings ?? []) > 0)
                                    <div class="tp-product-details-variation-item">
                                        <h4 class="tp-product-details-variation-title">{{ __('product_details.additional_information.sibling') }} :</h4>
                                        <div class="tp-product-details-variation-list">
                                            @foreach($product?->siblings as $target)
                                                <button
                                                    type="button" class=" tp-size-variation-btn"
                                                    title="{{\App\Enums\SiblingType::fromValue($target->sibling)->description}}">
                                                    <span>
                                                        @switch($target->sibling)
                                                            @case(\App\Enums\SiblingType::WOMAN)
                                                                <i class="fa fa-person-dress"></i>
                                                                @break
                                                            @case(\App\Enums\SiblingType::MAN)
                                                                <i class="fa fa-person"></i>
                                                                @break
                                                            @case(\App\Enums\SiblingType::KID)
                                                                <i class="fa fa-child"></i>
                                                                @break
                                                        @endswitch
                                                    </span>
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>

                            @if($product->is_in_promotion)
                                <div wire:ignore class="tp-product-details-countdown d-flex align-items-center justify-content-between flex-wrap mt-25 mb-25">
                                    <h4 class="tp-product-details-countdown-title"><i class="fa-solid fa-fire-flame-curved"></i> {{ __('product_details.flash_sale') }}: </h4>
                                    <div class="tp-product-details-countdown-time" data-countdown="" data-date="{{$product->promotion->end_date}}">
                                        <ul>
                                            <li><span data-days="">474</span>{{ __('helpers.counter.days_short') }}</li>
                                            <li><span data-hours="">9</span>H</li>
                                            <li><span data-minutes="">27</span>M</li>
                                            <li><span data-seconds="">20</span>S</li>
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            <!-- actions -->
                            <div class="tp-product-details-action-wrapper">
                                <div class="tp-product-details-action-item-wrapper">
                                    <div style="margin-left: 0" class="tp-product-details-add-to-cart mb-15 d-flex">
                                        @php
                                            $providerHasPhone2 = !empty($provider->phone2);
                                            $colLength = $providerHasPhone2 ? 4 : 6;
                                        @endphp
                                        <a
                                            href="tel:{{ $provider->phone1 }}"
                                            @if($providerHasPhone2)
                                                style="padding: 6px;"
                                            @endif
                                            class="col-{{$colLength}} tp-product-details-add-to-cart-btn border-info text-info">
                                            <i class="fa-solid fa-phone"></i>
                                            {{ $provider->phone1 }}
                                        </a>
                                        @if($providerHasPhone2)
                                            <a style="padding: 6px"
                                               href="tel:{{ $provider->phone2 }}"
                                               class="col-{{$colLength}} tp-product-details-add-to-cart-btn border-info text-info">
                                                <i class="fa-solid fa-phone"></i>
                                                {{ $provider->phone2 }}
                                            </a>
                                        @endif
                                        <a
                                            href="{{ App\Helpers\Functions::getWhatsappLinkToContactProvider($provider->whatsapp, $product->name, $product->details_page_link) }}"
                                            target="_blank"
                                            @if($providerHasPhone2)
                                                style="padding: 6px;"
                                            @endif
                                            class="col-{{$colLength}} tp-product-details-add-to-cart-btn border-success text-success">
                                            <i class="fa-brands fa-whatsapp"></i>
                                            {{ $provider->whatsapp }}
                                        </a>
                                    </div>
                                    <button class="tp-product-details-buy-now-btn w-100" data-bs-toggle="modal"
                                            data-bs-target="#orderRequestModal">
                                        {{ __('product_details.order') }}
                                    </button>
                                </div>
                            </div>
                            <div class="tp-product-details-action-sm">
                                <button wire:click="handleBookmark()"
                                        type="button"
                                        class="tp-product-details-action-sm-btn {{$userHasBookmarked ? 'text-primary' : ''}}">
                                    @if($userHasBookmarked)
                                        <i class="fa-solid fa-heart"></i>
                                        {{ __('helpers.bookmarks.remove') }}
                                    @else
                                        <i class="fa-regular fa-heart"></i>
                                        {{ __('helpers.bookmarks.add') }}
                                    @endif
                                </button>
                                <button type="button" class="tp-product-details-action-sm-btn" data-bs-toggle="modal"
                                        data-bs-target="#askQuestionModal">
                                    <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.575 12.6927C8.775 12.6927 8.94375 12.6249 9.08125 12.4895C9.21875 12.354 9.2875 12.1878 9.2875 11.9907C9.2875 11.7937 9.21875 11.6275 9.08125 11.492C8.94375 11.3565 8.775 11.2888 8.575 11.2888C8.375 11.2888 8.20625 11.3565 8.06875 11.492C7.93125 11.6275 7.8625 11.7937 7.8625 11.9907C7.8625 12.1878 7.93125 12.354 8.06875 12.4895C8.20625 12.6249 8.375 12.6927 8.575 12.6927ZM8.55625 5.0638C8.98125 5.0638 9.325 5.17771 9.5875 5.40553C9.85 5.63335 9.98125 5.92582 9.98125 6.28294C9.98125 6.52924 9.90625 6.77245 9.75625 7.01258C9.60625 7.25272 9.3625 7.5144 9.025 7.79763C8.7 8.08087 8.44063 8.3795 8.24688 8.69352C8.05313 9.00754 7.95625 9.29385 7.95625 9.55246C7.95625 9.68792 8.00938 9.79567 8.11563 9.87572C8.22188 9.95576 8.34375 9.99578 8.48125 9.99578C8.63125 9.99578 8.75625 9.94653 8.85625 9.84801C8.95625 9.74949 9.01875 9.62635 9.04375 9.47857C9.08125 9.23228 9.16562 9.0137 9.29688 8.82282C9.42813 8.63195 9.63125 8.42568 9.90625 8.20402C10.2812 7.89615 10.5531 7.58829 10.7219 7.28042C10.8906 6.97256 10.975 6.62775 10.975 6.246C10.975 5.59333 10.7594 5.06996 10.3281 4.67589C9.89688 4.28183 9.325 4.0848 8.6125 4.0848C8.1375 4.0848 7.7 4.17716 7.3 4.36187C6.9 4.54659 6.56875 4.81751 6.30625 5.17463C6.20625 5.31009 6.16563 5.44863 6.18438 5.59025C6.20313 5.73187 6.2625 5.83962 6.3625 5.91351C6.5 6.01202 6.64688 6.04281 6.80313 6.00587C6.95937 5.96892 7.0875 5.88272 7.1875 5.74726C7.35 5.5256 7.54688 5.35627 7.77813 5.23929C8.00938 5.1223 8.26875 5.0638 8.55625 5.0638ZM8.5 15.7775C7.45 15.7775 6.46875 15.5897 5.55625 15.2141C4.64375 14.8385 3.85 14.3182 3.175 13.6532C2.5 12.9882 1.96875 12.2062 1.58125 11.3073C1.19375 10.4083 1 9.43547 1 8.38873C1 7.35431 1.19375 6.38762 1.58125 5.48866C1.96875 4.58969 2.5 3.80772 3.175 3.14273C3.85 2.47775 4.64375 1.95438 5.55625 1.57263C6.46875 1.19088 7.45 1 8.5 1C9.5375 1 10.5125 1.19088 11.425 1.57263C12.3375 1.95438 13.1313 2.47775 13.8063 3.14273C14.4813 3.80772 15.0156 4.58969 15.4094 5.48866C15.8031 6.38762 16 7.35431 16 8.38873C16 9.43547 15.8031 10.4083 15.4094 11.3073C15.0156 12.2062 14.4813 12.9882 13.8063 13.6532C13.1313 14.3182 12.3375 14.8385 11.425 15.2141C10.5125 15.5897 9.5375 15.7775 8.5 15.7775ZM8.5 14.6692C10.2625 14.6692 11.7656 14.0534 13.0094 12.822C14.2531 11.5905 14.875 10.1128 14.875 8.38873C14.875 6.6647 14.2531 5.18695 13.0094 3.95549C11.7656 2.72404 10.2625 2.10831 8.5 2.10831C6.7125 2.10831 5.20312 2.72404 3.97188 3.95549C2.74063 5.18695 2.125 6.6647 2.125 8.38873C2.125 10.1128 2.74063 11.5905 3.97188 12.822C5.20312 14.0534 6.7125 14.6692 8.5 14.6692Z" fill="currentColor" stroke="currentColor" stroke-width="0.3"/>
                                    </svg>
                                    {{ __('helpers.questions.ask') }}
                                </button>
                                <button wire:click="handleSnapshot()"
                                        type="button"
                                        class="tp-product-details-action-sm-btn {{$userHasSnapshot ? 'text-primary' : ''}}">
                                    @if($userHasSnapshot)
                                        <i class="fa-solid fa-chart-mixed"></i>
                                        {{ __('helpers.snapshot.unsubscribe') }}
                                    @else
                                        <i class="fa-regular fa-chart-mixed"></i>
                                        {{ __('helpers.snapshot.subscribe') }}
                                    @endif
                                </button>
                            </div>
                            <div class="tp-product-details-query">
                                <div class="tp-product-details-query-item d-flex align-items-center">
                                    <span>{{ __('product_details.code') }}:  </span>
                                    <p>{{ $product->code }}</p>
                                </div>
                                <div class="tp-product-details-query-item d-flex align-items-center">
                                    <span>{{ __('product_details.category') }}:  </span>
                                    <p>
                                        <a href="{{ LaravelLocalization::localizeUrl('/products').('?categories='.$product->category_id) }}">
                                            {{$product->category->label}}
                                        </a>
                                    </p>
                                </div>
                                @if(!empty($product->brand))
                                    <div class="tp-product-details-query-item d-flex align-items-center">
                                        <span>{{ __('product_details.brand') }}:  </span>
                                        <p>
                                            <a href="{{ LaravelLocalization::localizeUrl('/products').('?brands='.$product->brand_id) }}">
                                                {{$product->brand->name}}
                                            </a>
                                        </p>
                                    </div>
                                @endif
                                <div class="tp-product-details-query-item d-flex align-items-center">
                                    <span>{{ __('product_details.tags') }}: </span>
                                    <p>
                                        {{(sizeof($product->tags) > 0 ? '#' : '').implode(' #', $product?->tags)}}
                                    </p>
                                </div>
                                <div class="tp-product-details-query-item d-flex align-items-center">
                                    <span>{{ __('product_details.published_by') }}:  </span>
                                    <a class="provider-name-on-product-details"
                                       wire:click="$emit('onDisplayProviderOverview')"
                                       data-bs-toggle="modal"
                                       data-bs-target="#providerOverviewModal">
                                        <img style="width: 2rem; height: 2rem; border-radius: 50%" src="{{ $provider->logo_path }}" alt="{{ $provider->name }}"/>
                                        <span>
                                            {{ $provider->name }}
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <div class="tp-product-details-social">
                                <span>{{ __('helpers.share') }}: </span>
                                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                                <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                                <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tp-product-details-bottom pb-115">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="tp-product-details-tab-nav tp-tab">
                            <nav>
                                <div class="nav nav-tabs justify-content-center p-relative tp-product-tab" id="navPresentationTab" role="tablist">
                                    <button class="nav-link" id="nav-description-tab" data-bs-toggle="tab" data-bs-target="#nav-description" type="button" role="tab" aria-controls="nav-description" aria-selected="true">{{ __('product_details.description.title') }}</button>
                                    <button class="nav-link active" id="nav-addInfo-tab" data-bs-toggle="tab" data-bs-target="#nav-addInfo" type="button" role="tab" aria-controls="nav-addInfo" aria-selected="false">{{ __('product_details.additional_information.title') }}</button>
                                    <button class="nav-link" id="nav-review-tab" data-bs-toggle="tab" data-bs-target="#nav-review" type="button" role="tab" aria-controls="nav-review" aria-selected="false">{{ __('product_details.reviews.title') }} ({{$product->reviews_count}})</button>

                                    <span id="productTabMarker" class="tp-product-details-tab-line"></span>
                                </div>
                            </nav>
                            <div class="tab-content" id="navPresentationTabContent">
                                <div class="tab-pane fade" id="nav-description" role="tabpanel" aria-labelledby="nav-description-tab" tabindex="0">
                                    <div class="tp-product-details-desc-wrapper pt-60">
                                        <div class="row justify-content-center">
                                            <div class="col-xl-10">
                                                <div class="tp-product-details-desc-item">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="tp-product-details-desc-content pt-25">
                                                                <span>{{$product?->name}}</span>
                                                                <h3 class="tp-product-details-desc-title">{{ __('product_details.description.about') }}</h3>
                                                                <p>{{$product->description}}</p>
                                                            </div>
                                                            <div class="tp-product-details-desc-content">
                                                                <h3 class="tp-product-details-desc-title">{{ __('product_details.description.details') }}</h3>
                                                                <p>
                                                                <ul style="padding-left: 1rem">
                                                                    @foreach($product->details as $details)
                                                                        @if($details !== '')
                                                                            <li><span>{{$details}}</span></li>
                                                                        @endif
                                                                    @endforeach
                                                                </ul>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="tp-product-details-desc-thumb">
                                                                <img src={{asset("assets/img/product/details/desc/product-details-desc-1.jpg")}} alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade show active" id="nav-addInfo" role="tabpanel" aria-labelledby="nav-addInfo-tab" tabindex="0">

                                    <div class="tp-product-details-additional-info ">
                                        <div class="row justify-content-center">
                                            <div class="col-xl-10 table table-bordered table-hover">
                                                <table>
                                                    <tbody>
                                                    <tr>
                                                        <th>{{ __('product_details.additional_information.rubric') }}</th>
                                                        <th>{{ __('product_details.additional_information.value') }}</th>
                                                        <th>{{ __('product_details.additional_information.quantity') }}</th>
                                                    </tr>
                                                    @if(sizeof($product->colors) > 0)
                                                        @foreach($product->colors as $i => $color)
                                                            <tr>
                                                                @if($i === 0)
                                                                    <td class="first" rowspan="{{sizeof($product->colors)}}">{{ __('product_details.additional_information.colors') }}</td>
                                                                @endif
                                                                <td class="second">
                                                                    <div class="product-details-color-illustration" style="background-color: {{$color->value}};"></div>
                                                                    @if($color->name)
                                                                        <span>{{$color->name}}</span>
                                                                    @else
                                                                        <span class="fst-italic small">{{ __('product_details.additional_information.no_color_name') }}</span>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">{{$color->stock ?? '-'}}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    @if(sizeof($product->sizes) > 0)
                                                        @foreach($product->sizes as $i => $size)
                                                            <tr>
                                                                @if($i === 0)
                                                                    <td class="first" rowspan="{{sizeof($product->sizes)}}">{{ __('product_details.additional_information.sizes') }}</td>
                                                                @endif
                                                                <td class="second">
                                                                    <span>{{$size->value}}</span>
                                                                </td>
                                                                <td class="text-center">{{$size->stock ?? '-'}}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    @if(sizeof($product->dimensions) > 0)
                                                        @foreach($product->dimensions as $i => $dimension)
                                                            <tr>
                                                                @if($i === 0)
                                                                    <td class="first" rowspan="{{sizeof($product->dimensions)}}">{{ __('product_details.additional_information.dimensions') }}</td>
                                                                @endif
                                                                <td class="second">
                                                                    <span><span class="fst-italic">{{\App\Enums\DimensionType::fromValue($dimension->type)->description}}</span> ({{$dimension->value.' '.$dimension->unit}})</span>
                                                                </td>
                                                                <td class="text-center">{{$dimension->stock ?? '-'}}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    @if(sizeof($product->siblings) > 0)
                                                        @foreach($product->siblings as $i => $target)
                                                            <tr>
                                                                @if($i === 0)
                                                                    <td class="first" rowspan="{{sizeof($product->siblings)}}">{{ __('product_details.additional_information.sibling') }}</td>
                                                                @endif
                                                                <td class="second">
                                                                    <span>{{\App\Enums\SiblingType::fromValue($target->sibling)->description}}</span>
                                                                </td>
                                                                <td class="text-center">{{$target->stock ?? '-'}}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div wire:ignore.self class="tab-pane fade" id="nav-review" role="tabpanel" aria-labelledby="nav-review-tab" tabindex="0">
                                    <div class="tp-product-details-review-wrapper pt-60">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="tp-product-details-review-statics">
                                                    <!-- number -->
                                                    <div class="tp-product-details-review-number d-inline-block mb-50">
                                                        <h3 class="tp-product-details-review-number-title">{{ __('product_details.reviews.subtitle') }}</h3>
                                                        <div class="tp-product-details-review-summery d-flex align-items-center">
                                                            <div class="tp-product-details-review-summery-value">
                                                                <span>{{number_format($reviewsAverage ?? 0, 2)}}</span>
                                                            </div>
                                                            <livewire:shared.components.product-rating
                                                                :key="'global-rating'.rand()"
                                                                :rating="$reviewsAverage"
                                                                :ratersCount="$reviewsCount"/>
                                                        </div>
                                                        <div class="tp-product-details-review-rating-list">
                                                            @foreach($productRatings as $rating => $count)
                                                                    <?php $percentage = number_format((($count * 100) / ($reviewsCount > 0 ? $reviewsCount : 1)), 1) ?>
                                                                    <!-- single item -->
                                                                <div class="tp-product-details-review-rating-item d-flex align-items-center">
                                                                    <span>{{str_replace('r-', '', $rating)}} <i class="fa-light fa-star"></i></span>
                                                                    <div class="tp-product-details-review-rating-bar">
                                                                        <span class="tp-product-details-review-rating-bar-inner" style="width: {{$percentage}}%"></span>
                                                                    </div>
                                                                    <div class="tp-product-details-review-rating-percent">
                                                                        <span>{{$percentage}}%</span>
                                                                    </div>
                                                                </div> <!-- end single item -->
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                    <!-- reviews -->
                                                    <div class="tp-product-details-review-form pr-90">
                                                        <h3 class="tp-product-details-review-form-title mb-20">{{ __('product_details.new_review.title') }}</h3>
                                                        <form wire:submit.prevent="submitReview">
                                                            <div style="margin-bottom: 0" class="tp-product-details-review-form-rating d-flex align-items-center">
                                                                <label class="mr-10">{{ __('product_details.new_review.rating.label') }} :</label>
                                                                <div class="starability-heartbeat d-flex align-items-center" wire:ignore>
                                                                    <input type="radio" id="no-rate" class="input-no-rate" name="rating" value="5" checked aria-label="No rating." />

                                                                    <input wire:change="setRating(1)" type="radio" id="rate1" name="rating" value="1" />
                                                                    <label for="rate1">1 star.</label>

                                                                    <input wire:change="setRating(2)" type="radio" id="rate2" name="rating" value="2" />
                                                                    <label for="rate2">2 stars.</label>

                                                                    <input wire:change="setRating(3)" type="radio" id="rate3" name="rating" value="3" />
                                                                    <label for="rate3">3 stars.</label>

                                                                    <input wire:change="setRating(4)" type="radio" id="rate4" name="rating" value="4" />
                                                                    <label for="rate4">4 stars.</label>

                                                                    <input wire:change="setRating(5)" type="radio" id="rate5" name="rating" value="5" />
                                                                    <label for="rate5">5 stars.</label>

                                                                    <span class="starability-focus-ring"></span>
                                                                </div>
                                                            </div>
                                                            @error('newReview.rating')
                                                            <div>
                                                                <span class="text-danger small">{{ $message }}</span>
                                                            </div>
                                                            @enderror
                                                            <div style="margin-top: 28px" class="tp-product-details-review-input-wrapper">
                                                                <div class="tp-product-details-review-input-box">
                                                                    <div class="tp-product-details-review-input">
                                                                        <textarea id="review" name="review" required
                                                                                  minlength="20" maxlength="255"
                                                                                  wire:model.defer="newReview.comment"
                                                                                  placeholder="{{ __('product_details.new_review.review.placeholder') }}"></textarea>
                                                                    </div>
                                                                    @error('newReview.comment')
                                                                    <div>
                                                                        <span class="text-danger small">{{ $message }}</span>
                                                                    </div>
                                                                    @enderror
                                                                    <div class="tp-product-details-review-input-title">
                                                                        <label for="review">{{ __('product_details.new_review.review.label') }}</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tp-product-details-review-btn-wrapper">
                                                                <button type="submit"
                                                                        wire:loading.remove wire:target="submitReview"
                                                                        class="tp-product-details-review-btn">
                                                                    {{ __('product_details.new_review.submit') }}
                                                                </button>
                                                                <button disabled="disabled" type="button"
                                                                        wire:loading wire:target="submitReview"
                                                                        class="tp-product-details-review-btn">
                                                                    <i class="fa fa-spin fa-spinner"></i>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->
                                            <div class="col-lg-6">
                                                <div class="tp-product-details-review-list">
                                                    <h3 class="tp-product-details-review-title">{{ __('product_details.reviews_list.title') }}</h3>

                                                    @foreach($reviews as $reviewItem)
                                                        <div class="tp-product-details-review-avater d-flex align-items-start">
                                                            <div class="tp-product-details-review-avater-thumb">
                                                                <a href="#">
                                                                    <img src={{asset("assets/img/users/user-3.jpg")}} alt="">
                                                                </a>
                                                            </div>
                                                            <div class="tp-product-details-review-avater-content">
{{--                                                                <livewire:shared.components.product-rating--}}
{{--                                                                    :reviewDisplayType="'none'"--}}
{{--                                                                    wire:key="{{rand().rand()}}"--}}
{{--                                                                    :rating="$reviewItem->rating"/>--}}

                                                                @include('livewire.shared.components.product-rating', [
                                                                    'reviewDisplayType' => 'none',
                                                                    'rating' => $reviewItem->rating,
                                                                ])
                                                                <h3 class="tp-product-details-review-avater-title">{{$reviewItem->user->username}}</h3>
                                                                <span class="tp-product-details-review-avater-meta">{{ $reviewItem->created_at->format('d M, Y') }}</span>

                                                                <div class="tp-product-details-review-avater-comment">
                                                                    <p>{{ $reviewItem->comment }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="tp-shop-pagination mt-20">
                                                    <div class="tp-pagination">
                                                        <nav>
                                                            {{$reviews->links()}}
                                                        </nav>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="tp-related-product pt-95 pb-120">
        <div class="container">
            <div class="row">
                <div class="tp-section-title-wrapper-6 text-center mb-40">
                    <h3 class="tp-section-title-6">{{ __('product_details.related_products.title') }}</h3>
                </div>
            </div>
            <div class="row" wire:ignore>
                <div class="tp-product-related-slider">
                    <div class="tp-product-related-slider-active swiper-container  mb-10">
                        <div class="swiper-wrapper">
                            @foreach($relatedProducts as $relatedProduct)
                                <div class="swiper-slide">
                                    <div class="tp-product-item-3 tp-product-style-primary mb-50">
                                        <div class="tp-product-thumb-3 mb-15 fix p-relative z-index-1">
                                            <a href="{{$relatedProduct->details_page_link}}">
                                                <img src="{{asset($relatedProduct->main_image_path)}}"
                                                     alt="{{ $relatedProduct->name }}">
                                            </a>

                                            @if($relatedProduct->is_in_promotion)
                                                <!-- product badge -->
                                                <div class="tp-product-badge">
                                                    <span class="product-offer">-{{$relatedProduct->promotion->discount_percentage}}%</span>
                                                </div>
                                            @endif

                                            <!-- product action -->
                                            <livewire:shared.components.product-actions :key="'product-action-'.$relatedProduct->id.rand()" :product="$relatedProduct" type="3" />
                                        </div>
                                        <div class="tp-product-content-3">
                                            <div class="tp-product-tag-3">
                                                <span class="single-line-ellipsis">{{$relatedProduct->category->label}}</span>
                                            </div>
                                            <h3 class="tp-product-title-3">
                                                <a class="max-lines-2" href="{{$relatedProduct->details_page_link}}">{{$product->name}}</a>
                                            </h3>
                                            <div class="tp-product-price-wrapper-3">
                                                <span class="tp-product-price-3 new-price fw-bold">{{$relatedProduct->formatted_price->new}} XAF</span>
                                                @if($relatedProduct->is_in_promotion)
                                                    <span class="tp-product-price-3 old-price">{{$relatedProduct->formatted_price->old}} XAF</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tp-related-swiper-scrollbar tp-swiper-scrollbar"></div>
                </div>
            </div>
        </div>
    </section>

    <livewire:shared.components.product-quick-view />

    <livewire:features.products.components.order-request-form :product_id="$product->id" />
    <livewire:features.products.components.ask-question-form :product_id="$product->id" />
    <livewire:features.products.components.provider-overview :provider="$provider" />

</div>
