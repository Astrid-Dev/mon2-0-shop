<div>
{{--    <hr/>--}}
{{--    <div>--}}
{{--        <h6 class="text-secondary">{{ __('dashboard.add_product.basic_information.title') }}</h6>--}}
{{--    </div>--}}
{{--    <hr/>--}}
    <div class="row">
        <div class="col-xxl-12">
            <div class="profile__input-box">
                <div class="profile__input">
                    <input type="text" placeholder="{{ __('dashboard.add_product.basic_information.name.label') }}"
                           wire:model="name" maxlength="150">
                    @error('name')
                    <div>
                        <span class="text-danger small">{{ $message }}</span>
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-xxl-6 col-md-6">
            <div class="profile__input-box">
                <div class="profile__input">
                    <input type="number" min="1" max="1000000" placeholder="{{ __('dashboard.add_product.basic_information.price.label') }}"
                           wire:model="price">
                    @error('price')
                    <div>
                        <span class="text-danger small">{{ $message }}</span>
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-xxl-6 col-md-6">
            <div class="profile__input-box">
                <div class="profile__input">
                    <div class="nice-select" tabindex="0">
                        <span class="current">
                            {{ $stockType !== null ? \App\Enums\StockType::fromValue($stockType)->description : __('dashboard.add_product.basic_information.stock_type.placeholder')}}
                        </span>
                        <ul class="list">
                            <li data-value="{{null}}" class="option disabled">
                                {{ __('dashboard.add_product.basic_information.stock_type.placeholder') }}
                            </li>
                            @foreach(\App\Enums\StockType::getInstances() as $stockTypeEnum)
                                <li wire:click="$set('stockType', '{{$stockTypeEnum->value}}')"
                                    data-value="{{$stockTypeEnum->value}}" class="option">
                                    {{ $stockTypeEnum->description }}
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    @error('stockType')
                    <div>
                        <span class="text-danger small">{{ $message }}</span>
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-xxl-6 col-md-6">
            <div class="profile__input-box">
                <div class="profile__input">
                    <div class="nice-select" tabindex="0">
                        <span class="current">
                            {{ $selectedCategory !== null ? $selectedCategory->label : __('dashboard.add_product.basic_information.category.placeholder')}}
                        </span>
                        <ul class="list" style="height: 240px; overflow: auto">
                            <li data-value="{{null}}" class="option disabled">
                                {{ __('dashboard.add_product.basic_information.category.placeholder') }}
                            </li>
                            @foreach($categories as $parentIndex => $category)
                                <hr/>
                                @if (sizeof($category->descendants) > 0)
                                    @foreach($category->descendants as $childIndex => $descendant)
                                        @if ($loop->index === 0)
                                            <li class="fw-bold option disabled"
                                                data-value="{{$category->id}}" class="option">
                                                {{ $category->label }}
                                            </li>
                                        @else
                                            <li wire:click="selectCategory({{$parentIndex}}, {{$childIndex}})"
                                                data-value="{{$descendant->id}}" class="option">
                                                {{ $descendant->label }}
                                            </li>
                                        @endif
                                    @endforeach
                                @else
                                    <li wire:click="selectCategory({{$parentIndex}})"
                                        data-value="{{$category->id}}" class="fw-bold option">
                                        {{ $category->label }}
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    @error('categoryId')
                    <div>
                        <span class="text-danger small">{{ $message }}</span>
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-xxl-6 col-md-6">
            <div class="profile__input-box">
                <div class="profile__input">
                    <div class="nice-select" tabindex="0">
                        <span class="current">
                            {{ $selectedBrand !== null ? $selectedBrand->name : __('dashboard.add_product.basic_information.brand.placeholder')}}
                        </span>
                        <ul class="list" style="height: 200px; overflow: auto">
                            <li data-value="{{null}}" class="option disabled">
                                {{ __('dashboard.add_product.basic_information.brand.placeholder') }}
                            </li>
                            @foreach($brands as $brand)
                                <li wire:click="selectBrand({{$brand->id}})"
                                    data-value="{{$brand->id}}" class="option">
                                    {{ $brand->name }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @error('brandId')
                    <div>
                        <span class="text-danger small">{{ $message }}</span>
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-xxl-12">
            <div class="profile__input-box">
                <div class="profile__input">

                    <textarea wire:model="description" placeholder="{{ __('dashboard.add_product.basic_information.description.placeholder', ['min' => 20, 'max' => 500]) }}"></textarea>
                    @error('brandId')
                    <div>
                        <span class="text-danger small">{{ $message }}</span>
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-xxl-12">
            <div>
                <div class="row">
                    @foreach($details as $i => $detail)
                        <div class="col-md-6">
                            <div class="profile__input">
                                <input wire:model="details.{{$i}}" placeholder="{{ __('dashboard.add_product.basic_information.details.placeholder') }}">
                                @if($i > 0)
                                    <i title="{{ __('dashboard.add_product.basic_information.details.remove') }}"
                                       wire:click="removeDetail({{$i}})"
                                       class="fa fa-close remove-added-details-item text-danger"></i>
                                @endif
                                @error('details'.$i)
                                <div>
                                    <span class="text-danger small">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                    @endforeach

                    @if(sizeof($details) < 5)
                        <div class="col-md-6">
                            <div class="profile__btn profile__input">
                                <button wire:click="addDetail()" type="button" class="tp-btn green-dark-bg" title="{{ __('dashboard.add_product.basic_information.details.add') }}">
                                    <i class="fa fa-plus-circle"></i>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-xxl-12">
            <div>
                <div class="row">
                    @foreach($tags as $tagIndex => $tag)
                        <div class="col-md-4">
                            <div class="profile__input">
                                <input wire:model="tags.{{$tagIndex}}" placeholder="{{ __('dashboard.add_product.basic_information.tags.placeholder') }}">
                                @if($tagIndex > 0)
                                    <i title="{{ __('dashboard.add_product.basic_information.tags.remove') }}"
                                       wire:click="removeTag({{$tagIndex}})"
                                       class="fa fa-close remove-added-tag-item text-danger"></i>
                                @endif
                                @error('tags.'.$tagIndex)
                                <div>
                                    <span class="text-danger small">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                    @endforeach

                    @if(sizeof($tags) < 5)
                        <div class="col-md-4">
                            <div class="profile__btn profile__input">
                                <button wire:click="addTag()" type="button" class="tp-btn green-dark-bg" title="{{ __('dashboard.add_product.basic_information.tags.add') }}">
                                    <i class="fa fa-plus-circle"></i>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
{{--    <hr/>--}}
</div>
