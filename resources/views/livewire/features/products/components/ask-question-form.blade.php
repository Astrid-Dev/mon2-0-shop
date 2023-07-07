<div>
    <div class="modal fade tp-product-modal" id="askQuestionModal" tabindex="-1"
         aria-labelledby="askQuestionModal" aria-hidden="true"
         wire:ignore.self
    >
        <div class="modal-dialog modal-dialog-centered" style="width: fit-content">
            <div class="modal-content">
                <div class="tp-product-modal-content d-lg-flex align-items-start">
                    <button type="button" class="tp-product-modal-close-btn" data-bs-toggle="modal"
                            wire:click="closeModal"
                            data-bs-target="#askQuestionModal">
                        <i class="fa-regular fa-xmark"></i>
                    </button>

                    <div class="tp-product-details-action-wrapper w-100">
                        <div class="tp-product-details-review-input-wrapper  mt-15">
                            <div class="tp-product-details-review-input-box">
                                <div class="tp-product-details-review-input">
                                        <textarea id="description" name="review" required
                                                  minlength="20" maxlength="500"
                                                  wire:model.defer="question"
                                                  placeholder="{{ __('ask_question_form.question.placeholder') }}"></textarea>
                                </div>
                                @error('question')
                                <div>
                                    <span class="text-danger small">{{ $message }}</span>
                                </div>
                                @enderror
                                <div class="tp-product-details-review-input-title">
                                    <label for="review">{{ __('ask_question_form.question.label') }}</label>
                                </div>
                            </div>
                        </div>
                        <button type="button"
                                wire:click="submit"
                                wire:loading.remove wire:target="submit"
                                class="tp-product-details-buy-now-btn w-100">
                            {{ __('ask_question_form.submit') }}
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
