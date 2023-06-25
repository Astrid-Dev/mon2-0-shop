<div>
    <div class="">
        <div class="row">
            @foreach($images as $i => $image)
                <div class="col-xxl-4 col-md-4">
                    <div class="profile__input-box">
                        <div class="profile__input">
                            <div wire:click="$set('mainImageIndex', {{$i}})"
                                 class="product-form__image-container bg-secondary cursor-pointer {{ $mainImageIndex === $i ? 'main' : '' }}">

                                @if(!$cleanStatus[$i])
                                    <i class="fa fa-camera fa-2x"></i>
                                @else
                                    <img class="w-100 h-100" src="{{ $image->temporaryUrl() }}" alt="">
                                @endif
                                <div class="profile__main-thumb-edit">
                                    <input accept="image/*"
                                           wire:model="images.{{$i}}"
                                           id="product-image-{{$i}}" class="profile-img-popup" type="file">
                                    <label for="product-image-{{$i}}"><i class="fa-light fa-camera"></i></label>
                                </div>
                            </div>
                            <i title="{{ __('dashboard.add_product.images.remove') }}"
                               wire:click="removeImage({{$i}})"
                               class="fa fa-close remove-added-details-item text-danger"></i>

                            @error('images.'.$i)
                            <div>
                                <span class="text-danger small">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
            @endforeach

            @if (sizeof($images) < 5)
                <div class="col-md-6">
                    <div class="profile__btn profile__input">
                        <button wire:click="addImage()" type="button" class="tp-btn green-dark-bg">
                            <i class="fa fa-plus-circle"></i>
                            {{ __('dashboard.add_product.images.add') }}
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
