<div>
    <div class="profile__info">
        <?php $enumStatus = \App\Enums\ProviderStatus::fromValue($provider->status); ?>
        @if($enumStatus->value === \App\Enums\ProviderStatus::PENDING)
            <div class="provider-status-ribbon pending"><span>{{$enumStatus->description}}</span></div>
        @elseif($enumStatus->value === \App\Enums\ProviderStatus::APPROVED)
            <div class="provider-status-ribbon approved"><span>{{$enumStatus->description}}</span></div>
        @elseif($enumStatus->value === \App\Enums\ProviderStatus::UNAPPROVED)
            <div class="provider-status-ribbon unapproved"><span>{{$enumStatus->description}}</span></div>
        @endif
        <h3 class="profile__info-title">{{ __('dashboard.information.provider.title') }}</h3>
        <div class="profile__info-content">
            <form action="#">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="profile__input-box">
                            <div class="profile__input">
                                <input type="text" placeholder="{{ __('dashboard.information.provider.name.placeholder') }}"
                                wire:model="name" maxlength="100">
                                @error('name')
                                    <div>
                                        <span class="text-danger small">{{ $message }}</span>
                                    </div>
                                @enderror
                                <span>
                                  <svg width="17" height="19" viewBox="0 0 17 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M9 9C11.2091 9 13 7.20914 13 5C13 2.79086 11.2091 1 9 1C6.79086 1 5 2.79086 5 5C5 7.20914 6.79086 9 9 9Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                     <path d="M15.5 17.6C15.5 14.504 12.3626 12 8.5 12C4.63737 12 1.5 14.504 1.5 17.6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                  </svg>
                               </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-4 col-md-4">
                        <div class="profile__input-box">
                            <div class="profile__input">
                                <input type="tel" placeholder="{{ __('dashboard.information.provider.phone.small_placeholder') }} 1 (2376XXXXXXXX)"
                                       wire:model="phone1">
                                @error('phone1')
                                    <div>
                                        <span class="text-danger small">{{ $message }}</span>
                                    </div>
                                @enderror
                                <span>
                                  <svg width="15" height="18" viewBox="0 0 15 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M13.9148 5V13C13.9148 16.2 13.1076 17 9.87892 17H5.03587C1.80717 17 1 16.2 1 13V5C1 1.8 1.80717 1 5.03587 1H9.87892C13.1076 1 13.9148 1.8 13.9148 5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                     <path opacity="0.4" d="M9.08026 3.80054H5.85156" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                     <path opacity="0.4" d="M7.45425 14.6795C8.14522 14.6795 8.70537 14.1243 8.70537 13.4395C8.70537 12.7546 8.14522 12.1995 7.45425 12.1995C6.76327 12.1995 6.20312 12.7546 6.20312 13.4395C6.20312 14.1243 6.76327 14.6795 7.45425 14.6795Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                  </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-md-4">
                        <div class="profile__input-box">
                            <div class="profile__input">
                                <input type="tel" placeholder="{{ __('dashboard.information.provider.phone.small_placeholder') }} 2 (2376XXXXXXXX)"
                                       wire:model="phone2">
                                @error('phone2')
                                    <div>
                                        <span class="text-danger small">{{ $message }}</span>
                                    </div>
                                @enderror
                                <span>
                                  <svg width="15" height="18" viewBox="0 0 15 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M13.9148 5V13C13.9148 16.2 13.1076 17 9.87892 17H5.03587C1.80717 17 1 16.2 1 13V5C1 1.8 1.80717 1 5.03587 1H9.87892C13.1076 1 13.9148 1.8 13.9148 5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                     <path opacity="0.4" d="M9.08026 3.80054H5.85156" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                     <path opacity="0.4" d="M7.45425 14.6795C8.14522 14.6795 8.70537 14.1243 8.70537 13.4395C8.70537 12.7546 8.14522 12.1995 7.45425 12.1995C6.76327 12.1995 6.20312 12.7546 6.20312 13.4395C6.20312 14.1243 6.76327 14.6795 7.45425 14.6795Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                  </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-md-4">
                        <div class="profile__input-box">
                            <div class="profile__input">
                                <input type="tel" placeholder="{{ __('dashboard.information.provider.whatsapp.placeholder') }}" wire:model="whatsapp">
                                @error('whatsapp')
                                    <div>
                                        <span class="text-danger small">{{ $message }}</span>
                                    </div>
                                @enderror
                                <span class="d-flex">
                                  <i style="font-size: 22px;" class="fa-brands fa-whatsapp-square"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-md-6">
                        <div class="profile__input-box">
                            <div class="profile__input">
                                <input type="text" placeholder="{{ __('dashboard.information.provider.city.placeholder') }}"
                                       wire:model="city">
                                @error('city')
                                    <div>
                                        <span class="text-danger small">{{ $message }}</span>
                                    </div>
                                @enderror
                                <span>
                                  <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M7.99377 10.1461C9.39262 10.1461 10.5266 9.0283 10.5266 7.64946C10.5266 6.27061 9.39262 5.15283 7.99377 5.15283C6.59493 5.15283 5.46094 6.27061 5.46094 7.64946C5.46094 9.0283 6.59493 10.1461 7.99377 10.1461Z" stroke="currentColor" stroke-width="1.5"/>
                                     <path d="M1.19707 6.1933C2.79633 -0.736432 13.2118 -0.72843 14.803 6.2013C15.7365 10.2663 13.1712 13.7072 10.9225 15.8357C9.29079 17.3881 6.70924 17.3881 5.06939 15.8357C2.8288 13.7072 0.263493 10.2583 1.19707 6.1933Z" stroke="currentColor" stroke-width="1.5"/>
                                  </svg>
                               </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-md-6">
                        <div class="profile__input-box">
                            <div class="profile__input">
                                <input type="text" placeholder="{{ __('dashboard.information.provider.address.placeholder') }}"
                                       wire:model="address">
                                @error('address')
                                    <div>
                                        <span class="text-danger small">{{ $message }}</span>
                                    </div>
                                @enderror
                                <span>
                                  <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M7.99377 10.1461C9.39262 10.1461 10.5266 9.0283 10.5266 7.64946C10.5266 6.27061 9.39262 5.15283 7.99377 5.15283C6.59493 5.15283 5.46094 6.27061 5.46094 7.64946C5.46094 9.0283 6.59493 10.1461 7.99377 10.1461Z" stroke="currentColor" stroke-width="1.5"/>
                                     <path d="M1.19707 6.1933C2.79633 -0.736432 13.2118 -0.72843 14.803 6.2013C15.7365 10.2663 13.1712 13.7072 10.9225 15.8357C9.29079 17.3881 6.70924 17.3881 5.06939 15.8357C2.8288 13.7072 0.263493 10.2583 1.19707 6.1933Z" stroke="currentColor" stroke-width="1.5"/>
                                  </svg>
                               </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-12">
                        <div class="profile__input-box">
                            <div class="profile__input">
                                <textarea  placeholder="{{ __('dashboard.information.provider.description.placeholder') }}"
                                           wire:model="description">
                                </textarea>
                                @error('description')
                                    <div>
                                        <span class="text-danger small">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-12">
                        <div class="profile__btn">
                            <button type="submit" class="tp-btn">{{ __('dashboard.information.provider.submit') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
