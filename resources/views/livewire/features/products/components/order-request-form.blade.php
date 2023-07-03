<div>
    <div class="modal fade tp-product-modal" id="orderRequestModal" tabindex="-1"
         aria-labelledby="orderRequestModal" aria-hidden="true"
         wire:ignore.self
    >
        <div class="modal-dialog modal-dialog-centered" style="width: fit-content">
            <div class="modal-content">
                <div class="tp-product-modal-content d-lg-flex align-items-start">
                    <button type="button" class="tp-product-modal-close-btn" data-bs-toggle="modal"
                            wire:click="closeModal"
                            data-bs-target="#orderRequestModal">
                        <i class="fa-regular fa-xmark"></i>
                    </button>

                    <div class="tp-product-details-action-wrapper">
                        <div class="tp-login-input-box">
                            <div class="tp-login-input">
                                <input id="quantity" type="number" min="1"
                                       wire:model.defer="quantity"
                                       placeholder="{{ __('order_request_form.quantity_placeholder') }}">
                            </div>
                            @error('quantity')
                            <div>
                                <span class="text-danger small">{{ $message }}</span>
                            </div>
                            @enderror
                            <div class="tp-login-input-title">
                                <label for="quantity">{{ __('order_request_form.quantity') }}</label>
                            </div>
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

                        <div class="tp-product-details-review-input-wrapper  mt-15">
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
                        <button type="button"
                                wire:click="submit"
                                wire:loading.remove wire:target="submit"
                                class="tp-product-details-buy-now-btn w-100">
                            {{ __('order_request_form.submit') }}
                        </button>
                        <button disabled="disabled" type="button"
                                wire:loading wire:target="submit"
                                class="tp-product-details-buy-now-btn w-100">
                            <i class="fa fa-spin fa-spinner"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
