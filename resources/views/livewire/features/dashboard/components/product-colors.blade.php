<div>
{{--    <div>--}}
{{--        <h6 class="text-secondary">{{ __('dashboard.add_product.colors.title') }}</h6>--}}
{{--    </div>--}}
{{--    <hr/>--}}
    <div class="product-form__items-list">
        @foreach(\App\Enums\Color::getInstances() as $colorEnum)
            <div class="row">
                <div class="col-xxl-6 col-md-6">
                    <div class="profile__input-box">
                        <div class="profile__input">
                            <input type="text" readonly disabled value="{{ $colorEnum->description }}"/>
                            <span class="d-flex">
                              <span class="product-form__color-illustration" style="background-color: {{$colorEnum->value}}"></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-md-3">
                    <div class="profile__input-box">
                        <div class="profile__input">
                            <input type="number" wire:model="colors.{{$colorEnum->value}}.stock"
                                   placeholder="{{ __('helpers.quantity') }}"/>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-md-3">
                    <div class="profile__input-box">
                        <div class="profile__input">
                            <input wire:model="colors.{{$colorEnum->value}}.checked" type="checkbox"/>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
