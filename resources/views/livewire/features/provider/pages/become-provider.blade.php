<div>
    <section class="tp-login-area pb-140 p-relative z-index-1 fix">
        <div class="tp-login-shape">
            <img class="tp-login-shape-1" src="{{asset("assets/img/login/login-shape-1.png")}}" alt="">
            <img class="tp-login-shape-2" src="{{asset("assets/img/login/login-shape-2.png")}}" alt="">
            <img class="tp-login-shape-3" src="{{asset("assets/img/login/login-shape-3.png")}}" alt="">
            <img class="tp-login-shape-4" src="{{asset("assets/img/login/login-shape-4.png")}}" alt="">
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">
                    <div class="tp-login-wrapper">
                        <div class="tp-login-top text-center mb-30">
                            <h3 class="tp-login-title">{{ __('become_a_seller.title') }}</h3>
                            <p><span>{{ __('become_a_seller.hint', ['appName' => env('APP_NAME')]) }}</span></p>
                        </div>
                        <form class="tp-login-option" wire:submit.prevent="submit">
                            <div class="tp-login-input-wrapper">
                                <div class="tp-login-input-box">
                                    <div class="tp-login-input-title">
                                        <label for="profile-thumb-input">{{ __('become_a_seller.logo.label') }}</label>
                                    </div>
                                    <div class="profile__main-inner d-flex justify-content-center align-items-center">
                                        <div class="profile__main-thumb">
                                            @if(!$logoIsClean)
                                                <div id="logo-placeholder" style="width: 10rem; height: 10rem; border-radius: 50%"
                                                     class="bg-secondary d-flex justify-content-center align-items-center text-center">
                                                    <span class="fs-5">{{ __('become_a_seller.logo.placeholder') }}</span>
                                                </div>
                                            @else
                                                <img id="logo-preview" style="width: 10rem; height: 10rem;" src="{{ $logo->temporaryUrl() }}" alt="">
                                            @endif

                                            <div class="profile__main-thumb-edit">
                                                <input wire:model.defer="logo"
                                                       accept="image/*"
                                                       id="profile-thumb-input" class="profile-img-popup" type="file">
                                                <label style="right: 1.5rem" for="profile-thumb-input"><i class="fa-light fa-camera"></i></label>
                                            </div>
                                        </div>
                                    </div>
                                    @error('logo') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                <div class="tp-login-input-box">
                                    <div class="tp-login-input">
                                        <input id="name" maxlength="100" wire:model="name"
                                               type="text" required
                                               placeholder="{{ __('become_a_seller.name.placeholder') }}">
                                    </div>
                                    @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                                    <div class="tp-login-input-title">
                                        <label for="name">{{ __('become_a_seller.name.label') }}</label>
                                    </div>
                                </div>
                                <div class="tp-login-input-box">
                                    <div class="tp-login-input">
                                        <input id="phone1" wire:model="phone1"
                                               type="tel" required
                                               placeholder="{{ __('become_a_seller.phone.placeholder') }} (2376XXXXXXXX)">
                                    </div>
                                    @error('phone1') <span class="text-danger small">{{ $message }}</span> @enderror
                                    <div class="tp-login-input-title">
                                        <label for="phone1">{{ __('become_a_seller.phone.label') }} 1</label>
                                    </div>
                                </div>
                                <div class="tp-login-input-box">
                                    <div class="tp-login-input">
                                        <input id="phone2" wire:model="phone2"
                                               type="tel"
                                               placeholder="{{ __('become_a_seller.phone.placeholder') }} (2376XXXXXXXX)">
                                    </div>
                                    @error('phone2') <span class="text-danger small">{{ $message }}</span> @enderror
                                    <div class="tp-login-input-title">
                                        <label for="phone2">{{ __('become_a_seller.phone.label') }} 2</label>
                                    </div>
                                </div>
                                <div class="tp-login-input-box">
                                    <div class="tp-login-input">
                                        <input id="whatsapp" wire:model="whatsapp"
                                               type="tel" required
                                               placeholder="{{ __('become_a_seller.whatsapp.placeholder') }}">
                                    </div>
                                    @error('whatsapp') <span class="text-danger small">{{ $message }}</span> @enderror
                                    <div class="tp-login-input-title">
                                        <label for="whatsapp">{{ __('become_a_seller.whatsapp.label') }}</label>
                                    </div>
                                </div>
                                <div class="tp-login-input-box">
                                    <div class="tp-login-input">
                                        <input id="city" wire:model="city"
                                               type="text" maxlength="100" required
                                               placeholder="{{ __('become_a_seller.city.placeholder') }}">
                                    </div>
                                    @error('city') <span class="text-danger small">{{ $message }}</span> @enderror
                                    <div class="tp-login-input-title">
                                        <label for="city">{{ __('become_a_seller.city.label') }}</label>
                                    </div>
                                </div>
                                <div class="tp-login-input-box">
                                    <div class="tp-login-input">
                                        <input id="address" wire:model="address"
                                               type="text" maxlength="150" required
                                               placeholder="{{ __('become_a_seller.address.placeholder') }}">
                                    </div>
                                    @error('address') <span class="text-danger small">{{ $message }}</span> @enderror
                                    <div class="tp-login-input-title">
                                        <label for="address">{{ __('become_a_seller.address.label') }}</label>
                                    </div>
                                </div>
                                <div class="tp-login-input-box">
                                    <div class="tp-login-input">
                                        <textarea rows="5" wire:model="description"
                                                  id="description" minlength="20" maxlength="255" required
                                                  placeholder="{{ __('become_a_seller.description.placeholder') }}"></textarea>
                                    </div>
                                    @error('description') <span class="text-danger small">{{ $message }}</span> @enderror
                                    <div class="tp-login-input-title">
                                        <label for="description">{{ __('become_a_seller.description.label') }}</label>
                                    </div>
                                </div>

                            </div>
                            <div class="tp-login-bottom">
                                <button type="submit"
                                        wire:loading.remove wire:target="submit"
                                        class="tp-login-btn w-100">{{ __('become_a_seller.submit') }}</button>
                                <button disabled="disabled" type="button"
                                        wire:loading wire:target="submit"
                                        class="tp-login-btn w-100"><i class="fa fa-spin fa-spinner"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
