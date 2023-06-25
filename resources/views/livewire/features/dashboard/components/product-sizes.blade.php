<div>
{{--    <div>--}}
{{--        <h6 class="text-secondary">{{ __('dashboard.add_product.sizes.title') }}</h6>--}}
{{--    </div>--}}
{{--    <hr/>--}}
    <div class="product-form__items-list">
        <div class="row">
            @foreach($sizes as $i => $size)
                <div class="col-xxl-6 col-md-6">
                    <div class="profile__input-box">
                        <div class="profile__input">
                            <div class="d-flex">
                                <input style="padding-left: 25px; border-right: none" class="w-50"
                                       wire:model="sizes.{{$i}}.value"
                                       type="text" placeholder="{{ __('dashboard.add_product.sizes.value.placeholder') }}" />
                                <input style="border-left: none" class="w-50"
                                       wire:model="sizes.{{$i}}.stock"
                                       type="number" placeholder="{{ __('helpers.quantity') }}" />
                            </div>
                            <i title="{{ __('dashboard.add_product.sizes.remove') }}"
                               wire:click="removeSize({{$i}})"
                               class="fa fa-close remove-added-details-item text-danger"></i>

                            @error('sizes.'.$i)
                            <div>
                                <span class="text-danger small">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-md-6">
                <div class="profile__btn profile__input">
                    <button wire:click="addSize()" type="button" class="tp-btn green-dark-bg">
                        <i class="fa fa-plus-circle"></i>
                        {{ __('dashboard.add_product.sizes.add') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
