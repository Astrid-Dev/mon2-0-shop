<div>
    <div class="">
        <div class="row">
            @if($promotion)
                <div class="col-xxl-12">
                    <div class="profile__input-box">
                        <div class="profile__input">
                            <div class="d-flex">
                                <input style="border-right: none"
                                       wire:model="promotion.start_date"
                                       type="{{$promotion['start_date'] ? 'datetime-local' : 'text'}}"
                                       onfocus="(this.type = 'datetime-local')"
                                       placeholder="{{ __('dashboard.add_product.promotion.start_date.placeholder') }}"/>
                                <input style="padding-left: 25px; border-right: none; border-left: none"
                                       wire:model="promotion.end_date"
                                       type="{{$promotion['end_date'] ? 'datetime-local' : 'text'}}"
                                       onfocus="(this.type = 'datetime-local')"
                                       placeholder="{{ __('dashboard.add_product.promotion.end_date.placeholder') }}"/>
                                <input style="border-left: none"
                                       wire:model="promotion.discount_percentage"
                                       min="0" max="100"
                                       type="number"5
                                       placeholder="{{ __('dashboard.add_product.promotion.discount_percentage.placeholder') }}"/>
                            </div>
                            <i title="{{ __('dashboard.add_product.promotion.remove') }}"
                               wire:click="removePromotion()"
                               class="fa fa-close remove-added-details-item text-danger"></i>

                            <div class="d-flex justify-content-between align-items-center">
                                @error('promotion.start_date')
                                    <div>
                                        <span class="text-danger small">{{ $message }}</span>
                                    </div>
                                @enderror
                                @error('promotion.end_date')
                                    <div>
                                        <span class="text-danger small">{{ $message }}</span>
                                    </div>
                                @enderror
                                @error('promotion.discount_percentage')
                                    <div>
                                        <span class="text-danger small">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-md-6">
                    <div class="profile__btn profile__input">
                        <button wire:click="addPromotion()" type="button" class="tp-btn green-dark-bg">
                            <i class="fa fa-plus-circle"></i>
                            {{ __('dashboard.add_product.promotion.add') }}
                        </button>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
