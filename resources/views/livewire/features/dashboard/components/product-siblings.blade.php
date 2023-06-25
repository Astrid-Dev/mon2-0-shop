<div>
{{--    <div>--}}
{{--        <h6 class="text-secondary">{{ __('dashboard.add_product.product_siblings.title') }}</h6>--}}
{{--    </div>--}}
{{--    <hr/>--}}
    @foreach(\App\Enums\SiblingType::getInstances() as $siblingEnum)
        <div class="row">
            <div class="col-xxl-6 col-md-6">
                <div class="profile__input-box">
                    <div class="profile__input">
                        <input type="text" readonly disabled value="{{ $siblingEnum->description }}"/>
                        @if($siblingIcons[$siblingEnum->value])
                            <span class="d-flex">
                              <i style="font-size: 22px;" class="{{$siblingIcons[$siblingEnum->value]}}"></i>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-3">
                <div class="profile__input-box">
                    <div class="profile__input">
                        <input type="number" wire:model="siblings.{{$siblingEnum->value}}.stock" placeholder="{{ __('helpers.quantity') }}"/>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-3">
                <div class="profile__input-box">
                    <div class="profile__input">
                        <input wire:model="siblings.{{$siblingEnum->value}}.checked" type="checkbox"/>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
