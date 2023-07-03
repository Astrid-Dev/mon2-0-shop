<div>
    <!-- profile area start -->
    <section class="profile__area pt-120 pb-120">
        <div class="container">
            <div class="profile__inner p-relative">
                <div class="profile__shape">
                    <img class="profile__shape-1" src="{{asset("assets/img/login/laptop.png")}}" alt="" >
                    <img class="profile__shape-2" src="{{asset("assets/img/login/man.png")}}" alt="" >
                    <img class="profile__shape-3" src="{{asset("assets/img/login/shape-1.png")}}" alt="" >
                    <img class="profile__shape-4" src="{{asset("assets/img/login/shape-2.png")}}" alt="" >
                    <img class="profile__shape-5" src="{{asset("assets/img/login/shape-3.png")}}" alt="" >
                    <img class="profile__shape-6" src="{{asset("assets/img/login/shape-4.png")}}" alt="" >
                </div>
                <div class="row">
                    <div class="col-xxl-4 col-lg-4">
                        <livewire:features.dashboard.components.dashboard-menu :currentMenu="'nav-password-tab'"/>
                    </div>
                    <div class="col-xxl-8 col-lg-8">
                        <div class="profile__tab-content">
                            <div class="tab-content" id="profile-tabContent">
                                <div class="tab-pane fade show active" id="nav-password" role="tabpanel" aria-labelledby="nav-password-tab">
                                    <em>{{ __('dashboard.change_password.hint') }}</em>
                                    <div class="profile__password mt-25">
                                        <form wire:submit.prevent="changePassword">
                                            <div class="row">
                                                <div class="col-xxl-12">
                                                    <div class="tp-profile-input-box">
                                                        <div class="tp-contact-input">
                                                            <input name="current_password" id="current_password"
                                                                   wire:model.defer="state.current_password"
                                                                   type="password" autocomplete="current-password">
                                                        </div>
                                                        <div class="tp-profile-input-title">
                                                            <label for="current_password">
                                                                {{ __('dashboard.change_password.current_password.label') }}
                                                            </label>
                                                        </div>
                                                        @error('current_password')
                                                            <span class="text-danger small">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xxl-6 col-md-6">
                                                    <div class="tp-profile-input-box">
                                                        <div class="tp-contact-input">
                                                            <input name="password" id="password"
                                                                   wire:model.defer="state.password"
                                                                   type="password" autocomplete="new-password">
                                                        </div>
                                                        <div class="tp-profile-input-title">
                                                            <label for="password">
                                                                {{ __('dashboard.change_password.new_password.label') }}
                                                            </label>
                                                        </div>
                                                        @error('password')
                                                            <span class="text-danger small">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xxl-6 col-md-6">
                                                    <div class="tp-profile-input-box">
                                                        <div class="tp-contact-input">
                                                            <input name="password_confirmation"
                                                                   wire:model.defer="state.password_confirmation"
                                                                   id="password_confirmation" type="password"
                                                                   autocomplete="new-password">
                                                        </div>
                                                        <div class="tp-profile-input-title">
                                                            <label for="password_confirmation">
                                                                {{ __('dashboard.change_password.confirm_new_password.label') }}
                                                            </label>
                                                        </div>
                                                        @error('password_confirmation')
                                                            <span class="text-danger small">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xxl-6 col-md-6">
                                                    <div class="profile__btn">
                                                        <button type="submit" class="tp-btn">
                                                            {{ __('dashboard.change_password.submit') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- profile area end -->
</div>
