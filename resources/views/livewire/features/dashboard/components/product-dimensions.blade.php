<div>
{{--    <div>--}}
{{--        <h6 class="text-secondary">{{ __('dashboard.add_product.dimensions.title') }}</h6>--}}
{{--    </div>--}}
{{--    <hr/>--}}
    <div class="">
        <div class="row">
            @foreach($dimensions as $i => $dimension)
                <div class="col-xxl-12">
                    <div class="profile__input-box">
                        <div class="profile__input">
                            <div class="d-flex">
                                <div class="nice-select" tabindex="0" style="border-right: none">
                                    <span class="current">
                                        {{ $dimension['type'] !== null ? \App\Enums\DimensionType::fromValue($dimension['type'])->description : __('dashboard.add_product.dimensions.type.placeholder')}}
                                    </span>
                                    <ul class="list" style="height: 100px; overflow: auto">
                                        <li data-value="{{null}}" class="option disabled">
                                            {{ __('dashboard.add_product.dimensions.type.placeholder') }}
                                        </li>
                                        @foreach(\App\Enums\DimensionType::getInstances() as $dimensionTypeEnum)
                                            <li wire:click="setDimensionType({{$i}}, '{{$dimensionTypeEnum->value}}')
                                                data-value="{{$dimensionTypeEnum->value}}" class="option">
                                                {{ $dimensionTypeEnum->description }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <input style="padding-left: 25px; border-right: none; border-left: none"
                                       wire:model="dimensions.{{$i}}.value"
                                       type="text"
                                       placeholder="{{ __('dashboard.add_product.dimensions.value.placeholder') }}"/>
                                <div class="nice-select" tabindex="0" style="border-right: none; border-left: none">
                                    <span class="current">
                                        {{ $dimension['unit'] !== null ? (\App\Enums\DimensionUnit::fromValue($dimension['unit'])->description. ' ('.\App\Enums\DimensionUnit::fromValue($dimension['unit'])->value.')') : __('dashboard.add_product.dimensions.unit.placeholder')}}
                                    </span>
                                    <ul class="list" style="height: 100px; overflow-y: auto; width: 135%">
                                        <li data-value="{{null}}" class="option disabled">
                                            {{ __('dashboard.add_product.dimensions.unit.placeholder') }}
                                        </li>
                                        @foreach(\App\Enums\DimensionUnit::getInstances() as $dimensionUnitEnum)
                                            <li wire:click="setDimensionUnit({{$i}}, '{{$dimensionUnitEnum->value}}')
                                                data-value="{{$dimensionUnitEnum->value}}" class="option">
                                            {{ $dimensionUnitEnum->description.' ('.$dimensionUnitEnum->value.')' }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <input style="border-left: none"
                                       wire:model="dimensions.{{$i}}.stock"
                                       type="number" placeholder="{{ __('helpers.quantity') }}"/>
                            </div>
                            <i title="{{ __('dashboard.add_product.dimensions.remove') }}"
                               wire:click="removeDimension({{$i}})"
                               class="fa fa-close remove-added-details-item text-danger"></i>

                            <div class="d-flex justify-content-between align-items-center">
                                @error('dimensions.'.$i.'.type')
                                <div>
                                    <span class="text-danger small">{{ $message }}</span>
                                </div>
                                @enderror
                                @error('dimensions.'.$i.'.value')
                                <div>
                                    <span class="text-danger small">{{ $message }}</span>
                                </div>
                                @enderror
                                @error('dimensions.'.$i.'.unit')
                                <div>
                                    <span class="text-danger small">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-md-6">
                <div class="profile__btn profile__input">
                    <button wire:click="addDimension()" type="button" class="tp-btn green-dark-bg">
                        <i class="fa fa-plus-circle"></i>
                        {{ __('dashboard.add_product.dimensions.add') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
