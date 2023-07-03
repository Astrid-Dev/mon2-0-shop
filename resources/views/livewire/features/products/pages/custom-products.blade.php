<div>
    <livewire:shared.components.breadcrumbs :data="$breadcrumbsData" :type="3" />

    <!-- login area start -->
    <section class="tp-login-area pb-140 p-relative z-index-1 fix">
        <div class="tp-login-shape">
            <img class="tp-login-shape-1" src="{{asset("assets/img/login/login-shape-1.png")}}" alt="">
            <img class="tp-login-shape-2" src="{{asset("assets/img/login/login-shape-2.png")}}" alt="">
            <img class="tp-login-shape-3" src="{{asset("assets/img/login/login-shape-3.png")}}" alt="">
            <img class="tp-login-shape-4" src="{{asset("assets/img/login/login-shape-4.png")}}" alt="">
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-12 col-lg-12">
                    <div class="tp-login-wrapper" style="padding-top: 0">
                        <div class="tp-login-option">
                            <div class="row text-center">
                                <div class="col-md-6 col-sm-12" style="margin: auto; max-height: 360px; overflow: auto">

                                    <div>
                                        <div class="tp-login-mail text-center mb-10">
                                            <p>{{ __('custom_products.customer_details.title') }}</p>
                                        </div>
                                        <div class="row">
                                            <div class="tp-login-input-box col-md-6 col-sm-12">
                                                <div class="tp-login-input">
                                                    <input id="customer_name" type="text"
                                                           wire:model.defer="customer_name"
                                                           placeholder="{{ __('custom_products.customer_details.name.placeholder') }}">
                                                </div>
                                                @error('customer_name')
                                                <div>
                                                    <span class="text-danger small">{{ $message }}</span>
                                                </div>
                                                @enderror
                                                <div class="tp-login-input-title">
                                                    <label for="customer_name">{{ __('custom_products.customer_details.name.label') }}</label>
                                                </div>
                                            </div>
                                            <div class="tp-login-input-box col-md-6 col-sm-12">
                                                <div class="tp-login-input">
                                                    <input id="customer_phone" type="tel"
                                                           wire:model.defer="customer_phone"
                                                           placeholder="{{ __('custom_products.customer_details.phone.placeholder') }}">
                                                </div>
                                                @error('customer_phone')
                                                <div>
                                                    <span class="text-danger small">{{ $message }}</span>
                                                </div>
                                                @enderror
                                                <div class="tp-login-input-title">
                                                    <label for="customer_phone">{{ __('custom_products.customer_details.phone.label') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tp-login-mail text-center mb-10">
                                        <p>{{ __('custom_products.details_of_need.title') }}</p>
                                    </div>
                                    <div class="tp-login-input-box">
                                        <div class="tp-login-input">
                                            <div class="div-as-input">
                                                @php
                                                    $simpleJerseyEnum = new \App\Enums\JerseyType(\App\Enums\JerseyType::SIMPLE);
                                                    $teamJerseyEnum = new \App\Enums\JerseyType(\App\Enums\JerseyType::TEAM);
                                                @endphp
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12 d-flex justify-content-center align-items-center">
                                                        <input type="radio" id="team_jersey"
                                                               wire:model="jersey_type"
                                                               name="jersey_type" value="{{ $teamJerseyEnum->value }}">
                                                        <label class="ml-10" for="team_jersey">{{ $teamJerseyEnum->description }}</label>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 d-flex justify-content-center align-items-center">
                                                        <input type="radio" id="simple_jersey"
                                                               wire:model="jersey_type"
                                                               name="jersey_type" value="{{ $simpleJerseyEnum->value }}">
                                                        <label class="ml-10" for="simple_jersey">{{ $simpleJerseyEnum->description }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tp-login-input-title">
                                            <label>{{ __('custom_products.details_of_need.jersey_type.label') }}</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="tp-login-input-box col-md-6 col-sm-12">
                                            <div class="tp-login-input">
                                                <input id="quantity" type="number" min="1" required
                                                       wire:model.debouce.250ms="quantity">
                                            </div>
                                            @error('quantity')
                                                <div>
                                                    <span class="text-danger small">{{ $message }}</span>
                                                </div>
                                            @enderror
                                            <div class="tp-login-input-title">
                                                <label for="quantity">{{ __('custom_products.details_of_need.quantity.label') }}</label>
                                            </div>
                                        </div>
                                        <div class="tp-login-input-box col-md-6 col-sm-12">
                                            <div class="tp-login-input">
                                                <div class="div-as-input">
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-12 d-flex justify-content-center align-items-center">
                                                            <input type="radio" id="include_flocking_yes"
                                                                   wire:model="include_flocking"
                                                                   name="include_flocking" value="{{ true }}">
                                                            <label class="ml-10" for="include_flocking_yes">{{ __('helpers.choices.yes') }}</label>
                                                        </div>
                                                        <div class="col-md-6 col-sm-12 d-flex justify-content-center align-items-center">
                                                            <input type="radio" id="include_flocking_no"
                                                                   wire:model="include_flocking"
                                                                   name="include_flocking" value="{{ false }}">
                                                            <label class="ml-10" for="include_flocking_no">{{ __('helpers.choices.no') }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tp-login-input-title">
                                                <label>{{ __('custom_products.details_of_need.include_flocking.label') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    @if($jersey_type === \App\Enums\JerseyType::TEAM)
                                        <div class="row">
                                            <div class="tp-login-input-box col-md-6 col-sm-12">
                                                <div class="tp-login-input">
                                                    <input id="championship"
                                                           wire:model.defer="championship"
                                                           type="text" placeholder="{{ __('custom_products.details_of_need.championship.placeholder') }}">
                                                </div>
                                                @error('championship')
                                                    <div>
                                                        <span class="text-danger small">{{ $message }}</span>
                                                    </div>
                                                @enderror
                                                <div class="tp-login-input-title">
                                                    <label for="championship">{{ __('custom_products.details_of_need.championship.label') }}</label>
                                                </div>
                                            </div>
                                            <div class="tp-login-input-box col-md-6 col-sm-12">
                                                <div class="tp-login-input">
                                                    <input id="season"
                                                           wire:model.defer="season"
                                                           type="text" placeholder="{{ __('custom_products.details_of_need.season.placeholder') }}">
                                                </div>
                                                @error('season')
                                                    <div>
                                                        <span class="text-danger small">{{ $message }}</span>
                                                    </div>
                                                @enderror
                                                <div class="tp-login-input-title">
                                                    <label for="season">{{ __('custom_products.details_of_need.season.label') }}</label>
                                                </div>
                                            </div>
                                            <div class="tp-login-input-box col-md-6 col-sm-12">
                                                <div class="tp-login-input">
                                                    <input id="team"
                                                           wire:model.defer="team"
                                                           type="text" placeholder="{{ __('custom_products.details_of_need.team.placeholder') }}">
                                                </div>
                                                @error('team')
                                                    <div>
                                                        <span class="text-danger small">{{ $message }}</span>
                                                    </div>
                                                @enderror
                                                <div class="tp-login-input-title">
                                                    <label for="team">{{ __('custom_products.details_of_need.team.label') }}</label>
                                                </div>
                                            </div>
                                            <div class="tp-login-input-box col-md-6 col-sm-12">
                                                <div class="tp-login-input">
                                                    <input id="jersey_details"
                                                           wire:model.defer="jersey_details"
                                                           type="text" placeholder="{{ __('custom_products.details_of_need.jersey_details.placeholder') }}">
                                                </div>
                                                @error('jersey_details')
                                                    <div>
                                                        <span class="text-danger small">{{ $message }}</span>
                                                    </div>
                                                    @enderror
                                                <div class="tp-login-input-title">
                                                    <label for="jersey_details">{{ __('custom_products.details_of_need.jersey_details.label') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="row">
                                        <div class="tp-login-input-box col-md-6 col-sm-12">
                                            <div class="tp-login-input">
                                                <div>
                                                    <div style="height: 10rem; border: 1px solid #E0E2E3"
                                                         class="profile__main-inner d-flex justify-content-center align-items-center">
                                                        <div class="profile__main-thumb w-100 h-100">
                                                            @if(!$jerseyIsClean)
                                                                <div id="jersey-placeholder"
                                                                     class="bg-secondary d-flex justify-content-center align-items-center h-100">
                                                                    <i class="fa fa-camera fa-3x"></i>
                                                                </div>
                                                            @else
                                                                <img id="jersey-preview" style="width: 100%; height: 100%; object-fit: cover; border-radius: unset;" src="{{ $jersey_sample->temporaryUrl() }}" alt="">
                                                            @endif

                                                            <div class="profile__main-thumb-edit">
                                                                <input wire:model="jersey_sample"
                                                                       accept="image/*"
                                                                       id="profile-thumb-input" class="profile-img-popup" type="file">
                                                                <label for="profile-thumb-input"><i class="fa-light fa-camera"></i></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @error('jersey_sample') <span class="text-danger small">{{ $message }}</span> @enderror
                                            <div class="tp-login-input-title">
                                                <label for="profile-thumb-input">
                                                    {{ __('custom_products.jersey_sample.label') }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class=" col-md-6 col-sm-12">
                                            <div class="tp-product-details-review-input-box">
                                                <div class="tp-product-details-review-input">
                                                    <textarea id="description" name="review" required
                                                              minlength="20" maxlength="500"
                                                              wire:model.defer="description"
                                                              placeholder="{{ __('order_request_form.description_placeholder') }}"></textarea>
                                                </div>
                                                @error('description')
                                                    <div>
                                                        <span class="text-danger small">{{ $message }}</span>
                                                    </div>
                                                @enderror
                                                <div class="tp-product-details-review-input-title">
                                                    <label for="review">{{ __('order_request_form.description') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                @if($include_flocking)
                                    <div class="col-md-6 col-sm-12" style="max-height: 360px; overflow: auto">
                                        <div class="tp-login-mail text-center mb-10">
                                            <p>{{ __('custom_products.flocking_details.title') }}</p>
                                        </div>

                                        @if($jersey_type === \App\Enums\JerseyType::SIMPLE)
                                            <div class="row">
                                                <div class="tp-login-input-box col-md-6 col-sm-12">
                                                    <div class="tp-login-input">
                                                        <div>
                                                            <div style="height: 10rem; border: 1px solid #E0E2E3"
                                                                 class="profile__main-inner d-flex justify-content-center align-items-center">
                                                                <div class="profile__main-thumb w-100 h-100">
                                                                    @if(!$teamLogoIsClean)
                                                                        <div id="jersey-placeholder"
                                                                             class="bg-secondary d-flex justify-content-center align-items-center h-100">
                                                                            <i class="fa fa-camera fa-3x"></i>
                                                                        </div>
                                                                    @else
                                                                        <img id="jersey-preview" style="width: 100%; height: 100%; object-fit: cover; border-radius: unset;" src="{{ $team_logo->temporaryUrl() }}" alt="">
                                                                    @endif

                                                                    <div class="profile__main-thumb-edit">
                                                                        <input wire:model="team_logo"
                                                                               accept="image/*"
                                                                               id="team_logo" class="profile-img-popup" type="file">
                                                                        <label for="team_logo"><i class="fa-light fa-camera"></i></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @error('team_logo') <span class="text-danger small">{{ $message }}</span> @enderror
                                                    <div class="tp-login-input-title">
                                                        <label for="profile-thumb-input">
                                                            {{ __('custom_products.flocking_details.team_logo.label') }}
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="tp-login-input-box col-md-6 col-sm-12">
                                                    <div class="tp-login-input">
                                                        <input id="team_name" type="text"
                                                               placeholder="{{ __('custom_products.flocking_details.team_name.placeholder') }}">
                                                    </div>
                                                    <div class="tp-login-input-title">
                                                        <label for="team_name">{{ __('custom_products.flocking_details.team_name.label') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @foreach($flocking_items as $i => $flocking_item)
                                            <div class="profile__input-box">
                                                <div class="profile__input">
                                                    <div class="d-flex">
                                                        <input style="padding-left: 25px; border-right: none" class="w-75"
                                                               wire:model="flocking_items.{{$i}}.name"
                                                               type="text" placeholder="{{ __('order_request_form.name') }}" />
                                                        <input style="border-left: none; padding-left: 1rem;" class="w-25"
                                                               wire:model="flocking_items.{{$i}}.bib"
                                                               type="number" placeholder="{{ __('order_request_form.bib') }}" />
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        @error('flocking_items.'.$i.'.name')
                                                            <div>
                                                                <span class="text-danger small">{{ $message }}</span>
                                                            </div>
                                                        @enderror
                                                        @error('flocking_items.'.$i.'.bib')
                                                            <div>
                                                                <span class="text-danger small">{{ $message }}</span>
                                                            </div>
                                                        @enderror
                                                    </div>

                                                    @if($loop->index > 0)
                                                        <i title="{{ __('order_request_form.remove') }}" wire:click="removeFlockingItem({{$i}})"
                                                           class="fa fa-close remove-added-details-item text-danger"></i>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="tp-login-bottom mt-20">
                                <button type="button"
                                        wire:click="submit"
                                        wire:loading.remove wire:target="submit"
                                        class="tp-login-btn w-100">
                                    {{ __('custom_products.submit') }}
                                </button>
                                <button disabled="disabled" type="button"
                                        wire:loading wire:target="submit"
                                        class="tp-login-btn w-100">
                                    <i class="fa fa-spin fa-spinner"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- login area end -->
</div>
