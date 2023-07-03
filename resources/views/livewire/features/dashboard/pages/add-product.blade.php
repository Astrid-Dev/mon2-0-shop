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
                        <livewire:features.dashboard.components.dashboard-menu :currentMenu="'nav-add-product-tab'"/>
                    </div>
                    <div class="col-xxl-8 col-lg-8">
                        <div class="profile__tab-content">
                            <div class="tab-content" id="profile-tabContent">
                                <div class="tab-pane fade show active" id="nav-add-product" role="tabpanel"
                                     aria-labelledby="nav-add-product-tab">
                                    <form wire:submit.prevent="submit">
                                        <div class="profile__info mt-40">
                                            <h3 class="profile__info-title">{{ __('dashboard.add_product.title') }}</h3>
                                            <div class="profile__info-content">
                                                <div class="accordion accordion-flush" id="product-form" wire:ignore>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="basic-information-heading">
                                                            <button class="accordion-button collapsed" type="button"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#basic-information-content"
                                                                    aria-expanded="false"
                                                                    aria-controls="basic-information-content">
                                                                {{ __('dashboard.add_product.basic_information.title') }}
                                                                <span class="text-danger">&nbsp;*</span>
                                                            </button>
                                                        </h2>
                                                        <div id="basic-information-content"
                                                             class="accordion-collapse collapse"
                                                             aria-labelledby="basic-information-heading"
                                                             data-bs-parent="#product-form">
                                                            <div class="accordion-body">
                                                                <livewire:features.dashboard.components.product-basic-information
                                                                    :provider="$provider"
                                                                />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="promotion-heading">
                                                            <button class="accordion-button collapsed"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#promotion-content"
                                                                    aria-expanded="false"
                                                                    aria-controls="promotion-content">
                                                                {{ __('dashboard.add_product.promotion.title') }}
                                                            </button>
                                                        </h2>
                                                        <div id="promotion-content" class="accordion-collapse collapse"
                                                             aria-labelledby="images-heading"
                                                             data-bs-parent="#promotion-form">
                                                            <div class="accordion-body">
                                                                <livewire:features.dashboard.components.product-promotion
                                                                    :product="$product"
                                                                />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="sibling-heading">
                                                            <button class="accordion-button collapsed" type="button"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#sibling-content"
                                                                    aria-expanded="false"
                                                                    aria-controls="sibling-content">
                                                                {{ __('dashboard.add_product.product_siblings.title') }}
                                                            </button>
                                                        </h2>
                                                        <div id="sibling-content" class="accordion-collapse collapse"
                                                             aria-labelledby="sibling-heading"
                                                             data-bs-parent="#product-form">
                                                            <div class="accordion-body">
                                                                <livewire:features.dashboard.components.product-siblings
                                                                    :product="$product"
                                                                />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="colors-heading">
                                                            <button class="accordion-button collapsed"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#colors-content"
                                                                    aria-expanded="false"
                                                                    aria-controls="colors-content">
                                                                {{ __('dashboard.add_product.colors.title') }}
                                                            </button>
                                                        </h2>
                                                        <div id="colors-content" class="accordion-collapse collapse"
                                                             aria-labelledby="colors-heading"
                                                             data-bs-parent="#product-form">
                                                            <div class="accordion-body">
                                                                <livewire:features.dashboard.components.product-colors
                                                                    :product="$product"
                                                                />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="sizes-heading">
                                                            <button class="accordion-button collapsed"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#sizes-content"
                                                                    aria-expanded="false"
                                                                    aria-controls="sizes-content">
                                                                {{ __('dashboard.add_product.sizes.title') }}
                                                            </button>
                                                        </h2>
                                                        <div id="sizes-content" class="accordion-collapse collapse"
                                                             aria-labelledby="sizes-heading"
                                                             data-bs-parent="#product-form">
                                                            <div class="accordion-body">
                                                                <livewire:features.dashboard.components.product-sizes
                                                                    :product="$product"
                                                                />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="dimensions-heading">
                                                            <button class="accordion-button collapsed"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#dimensions-content"
                                                                    aria-expanded="false"
                                                                    aria-controls="dimensions-content">
                                                                {{ __('dashboard.add_product.dimensions.title') }}
                                                            </button>
                                                        </h2>
                                                        <div id="dimensions-content" class="accordion-collapse collapse"
                                                             aria-labelledby="dimensions-heading"
                                                             data-bs-parent="#product-form">
                                                            <div class="accordion-body">
                                                                <livewire:features.dashboard.components.product-dimensions
                                                                    :product="$product"
                                                                />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="images-heading">
                                                            <button class="accordion-button collapsed"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#images-content"
                                                                    aria-expanded="false"
                                                                    aria-controls="images-content">
                                                                {{ __('dashboard.add_product.images.title') }}
                                                            </button>
                                                        </h2>
                                                        <div id="images-content" class="accordion-collapse collapse"
                                                             aria-labelledby="images-heading"
                                                             data-bs-parent="#product-form">
                                                            <div class="accordion-body">
                                                                <livewire:features.dashboard.components.product-images
                                                                    :product="$product"
                                                                />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-xxl-12">
                                                        <div class="profile__btn">
                                                            <button type="submit"
                                                                    wire:loading.remove wire:target="submit"
                                                                    class="tp-btn w-100">{{ __('dashboard.add_product.submit') }}</button>
                                                            <button disabled="disabled" type="button"
                                                                    wire:loading wire:target="submit"
                                                                    class="tp-btn w-100"><i class="fa fa-spin fa-spinner"></i></button>
                                                        </div>
                                                    </div>
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
    </section>
    <!-- profile area end -->
</div>
