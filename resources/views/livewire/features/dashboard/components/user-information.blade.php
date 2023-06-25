<div>
    <div class="profile__info mt-40">
        <h3 class="profile__info-title">{{ __('dashboard.information.user.title') }}</h3>
        <div class="profile__info-content">
            <form wire:submit.prevent="submit">
                <div class="row">
                    <div class="col-xxl-6 col-md-6">
                        <div class="profile__input-box">
                            <div class="profile__input">
                                <input type="text" placeholder="{{ __('dashboard.information.user.username.placeholder') }}"
                                       wire:model="username" minlength="3" maxlength="20">
                                @error('username')
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

                    <div class="col-xxl-6 col-md-6">
                        <div class="profile__input-box">
                            <div class="profile__input">
                                <input type="email" placeholder="{{ __('dashboard.information.user.email.placeholder') }}"
                                       wire:model="email" maxlength="100" required>
                                @error('email')
                                    <div>
                                        <span class="text-danger small">{{ $message }}</span>
                                    </div>
                                @enderror
                                <span>
                                  <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M13 14.6H5C2.6 14.6 1 13.4 1 10.6V5C1 2.2 2.6 1 5 1H13C15.4 1 17 2.2 17 5V10.6C17 13.4 15.4 14.6 13 14.6Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                     <path d="M13 5.3999L10.496 7.3999C9.672 8.0559 8.32 8.0559 7.496 7.3999L5 5.3999" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                  </svg>
                               </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-12">
                        <div class="profile__btn" x-data>
                            <button type="submit" class="tp-btn"
                                    :disabled="@js($canSubmit)"
                                    wire:loading.remove wire:target="submit">{{ __('dashboard.information.user.submit') }}</button>
                            <button disabled="disabled" type="button"
                                    wire:loading wire:target="submit"
                                    class="tp-btn"><i class="fa fa-spin fa-spinner"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
