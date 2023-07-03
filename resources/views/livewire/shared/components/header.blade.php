<div>

    @switch($type)
        @case(1)
            <header>
                <div class="tp-header-area p-relative z-index-11">
                    <!-- header top start  -->
                    <div class="tp-header-top black-bg p-relative z-index-1 d-none d-md-block">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="tp-header-welcome d-flex align-items-center">
                                       <span>
                                           <svg width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                               <path fill-rule="evenodd" clip-rule="evenodd" d="M1.359 2.73916C1.59079 2.35465 2.86862 0.958795 3.7792 1.00093C4.05162 1.02426 4.29244 1.1883 4.4881 1.37943H4.48885C4.93737 1.81888 6.22423 3.47735 6.29648 3.8265C6.47483 4.68282 5.45362 5.17645 5.76593 6.03954C6.56213 7.98771 7.93402 9.35948 9.88313 10.1549C10.7455 10.4679 11.2392 9.44752 12.0956 9.62511C12.4448 9.6981 14.1042 10.9841 14.5429 11.4333V11.4333C14.7333 11.6282 14.8989 11.8698 14.9214 12.1422C14.9553 13.1016 13.4728 14.3966 13.1838 14.5621C12.502 15.0505 11.6125 15.0415 10.5281 14.5373C7.50206 13.2784 2.66618 8.53401 1.38384 5.39391C0.893174 4.31561 0.860062 3.42016 1.359 2.73916Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                               <path d="M9.84082 1.18318C12.5534 1.48434 14.6952 3.62393 15 6.3358" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                               <path d="M9.84082 3.77927C11.1378 4.03207 12.1511 5.04544 12.4039 6.34239" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                       </span>
                                        <p>+237 6 XX XX XX XX</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="tp-header-top-right d-flex align-items-center justify-content-end">
                                        <livewire:shared.components.header-actions />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- header main start -->
                    <div class="tp-header-main tp-header-sticky">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-xl-2 col-lg-2 col-md-4 col-6">
                                    <div class="logo">
                                        <a href="{{ LaravelLocalization::localizeUrl('/home')}}">
                                            <img src={{asset("assets/img/logo/logo.svg")}} alt="logo">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xl-7 col-lg-7 d-none d-lg-block" x-data="{search: '', category: ''}">
                                    <div class="tp-header-search pl-70">
                                        <form onsubmit="return false;">
                                            <div class="tp-header-search-wrapper d-flex align-items-center">
                                                <div class="tp-header-search-box">
                                                    <input x-model="search" type="text" placeholder="{{ __('header.searchbar.placeholder') }}...">
                                                </div>
                                                <div class="tp-header-search-category">
                                                    <select x-model="category">
                                                        <option value="">{{ __('header.searchbar.select_category') }}</option>
                                                        @foreach($categories as $category)
                                                            <option>{{ $category->label }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="tp-header-search-btn">
                                                    <button type="submit" @click="window.location.href = (@js(LaravelLocalization::localizeUrl('/products')) + '?search='+search+'&categories='+category)">
                                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M9 17C13.4183 17 17 13.4183 17 9C17 4.58172 13.4183 1 9 1C4.58172 1 1 4.58172 1 9C1 13.4183 4.58172 17 9 17Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            <path d="M19 19L14.65 14.65" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-8 col-6">
                                    @auth()
                                        <div class="tp-header-main-right d-flex align-items-center justify-content-end">
                                            <div class="tp-header-login d-none d-lg-block">
                                                <a href="{{ LaravelLocalization::localizeUrl(route('dashboard.profile')) }}" class="d-flex align-items-center">
                                                    <div class="tp-header-login-icon">
                                                    <span>
                                                       <svg width="17" height="21" viewBox="0 0 17 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                          <circle cx="8.57894" cy="5.77803" r="4.77803" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                          <path fill-rule="evenodd" clip-rule="evenodd" d="M1.00002 17.2014C0.998732 16.8655 1.07385 16.5337 1.2197 16.2311C1.67736 15.3158 2.96798 14.8307 4.03892 14.611C4.81128 14.4462 5.59431 14.336 6.38217 14.2815C7.84084 14.1533 9.30793 14.1533 10.7666 14.2815C11.5544 14.3367 12.3374 14.4468 13.1099 14.611C14.1808 14.8307 15.4714 15.27 15.9291 16.2311C16.2224 16.8479 16.2224 17.564 15.9291 18.1808C15.4714 19.1419 14.1808 19.5812 13.1099 19.7918C12.3384 19.9634 11.5551 20.0766 10.7666 20.1304C9.57937 20.2311 8.38659 20.2494 7.19681 20.1854C6.92221 20.1854 6.65677 20.1854 6.38217 20.1304C5.59663 20.0773 4.81632 19.9641 4.04807 19.7918C2.96798 19.5812 1.68652 19.1419 1.2197 18.1808C1.0746 17.8747 0.999552 17.5401 1.00002 17.2014Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                       </svg>
                                                    </span>
                                                    </div>
                                                    <div class="tp-header-login-content d-none d-xl-block">
                                                        <span>{{ __('helpers.hi') }}, {{auth()->user()->username}}</span>
{{--                                                        <h5 class="tp-header-login-title">Your Account</h5>--}}
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="tp-header-action d-flex align-items-center ml-50">
                                                <div class="tp-header-action-item d-none d-lg-block">
                                                    <livewire:shared.components.header-bookmarks-count/>
                                                </div>
                                                <div class="tp-header-action-item d-lg-none">
                                                    <button type="button" class="tp-header-action-btn tp-offcanvas-open-btn">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="16" viewBox="0 0 30 16">
                                                            <rect x="10" width="20" height="2" fill="currentColor"/>
                                                            <rect x="5" y="7" width="25" height="2" fill="currentColor"/>
                                                            <rect x="10" y="14" width="20" height="2" fill="currentColor"/>
                                                        </svg>
                                                    </button>
                                                </div>

                                            </div>
                                        </div>
                                    @else
                                        <div class="tp-header-main-right d-flex align-items-center justify-content-end">
                                            <div class="tp-header-login d-flex flex-wrap">
                                                <a href="{{ LaravelLocalization::localizeUrl('/login') }}" class="btn text-primary">
                                                    <i class="fa fa-sign-in"></i>
                                                    <span>{{ __('header.main_menus.others.sign_in') }}</span>
                                                </a>
                                                <a href="{{ LaravelLocalization::localizeUrl('/register') }}" class="btn text-secondary">
                                                    <i class="fa fa-user-plus"></i>
                                                    <span>{{ __('header.main_menus.others.register') }}</span>
                                                </a>
                                            </div>
                                            <div class="tp-header-action d-flex align-items-center ml-50 p-absolute">
                                                <div class="tp-header-action-item d-lg-none">
                                                    <button type="button" class="tp-header-action-btn tp-offcanvas-open-btn">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="16" viewBox="0 0 30 16">
                                                            <rect x="10" width="20" height="2" fill="currentColor"/>
                                                            <rect x="5" y="7" width="25" height="2" fill="currentColor"/>
                                                            <rect x="10" y="14" width="20" height="2" fill="currentColor"/>
                                                        </svg>
                                                    </button>
                                                </div>

                                            </div>
                                        </div>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- header bottom start -->
                    <div class="tp-header-bottom tp-header-bottom-border d-none d-lg-block">
                        <div class="container">
                            <div class="tp-mega-menu-wrapper p-relative">
                                <div class="row align-items-center">
                                    <div class="col-xl-3 col-lg-3">
                                        <div class="tp-header-category tp-category-menu tp-header-category-toggle">
                                            <button class="tp-category-menu-btn tp-category-menu-toggle">
                                                 <span>
                                                    <svg width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M0 1C0 0.447715 0.447715 0 1 0H15C15.5523 0 16 0.447715 16 1C16 1.55228 15.5523 2 15 2H1C0.447715 2 0 1.55228 0 1ZM0 7C0 6.44772 0.447715 6 1 6H17C17.5523 6 18 6.44772 18 7C18 7.55228 17.5523 8 17 8H1C0.447715 8 0 7.55228 0 7ZM1 12C0.447715 12 0 12.4477 0 13C0 13.5523 0.447715 14 1 14H11C11.5523 14 12 13.5523 12 13C12 12.4477 11.5523 12 11 12H1Z" fill="currentColor"/>
                                                    </svg>
                                                 </span>
                                                {{ __('header.categories.all_departments') }}
                                            </button>
                                            <nav class="tp-category-menu-content">
                                                <ul>
                                                    @foreach($categories as $parentCategory)
                                                        <li class="{{sizeof($parentCategory->descendants) > 0 ? 'has-dropdown': ''}}">
                                                            <a href="{{ LaravelLocalization::localizeUrl('/products').('?categories='.$parentCategory->id) }}">
                                                                 <span>
                                                                    <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                       <path d="M14.5 1H2.5C1.67157 1 1 1.67157 1 2.5V10C1 10.8284 1.67157 11.5 2.5 11.5H14.5C15.3284 11.5 16 10.8284 16 10V2.5C16 1.67157 15.3284 1 14.5 1Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                       <path d="M5.5 14.5H11.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                       <path d="M8.5 11.5V14.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                    </svg>
                                                                 </span>
                                                                {{$parentCategory->label}}
                                                            </a>

                                                            @if(sizeof($parentCategory->descendants) > 0)
                                                                <ul class="tp-submenu">
                                                                    @foreach($parentCategory->descendants as $child)
                                                                        <li>
                                                                            <a href="{{ LaravelLocalization::localizeUrl('/products').('?categories='.$child->id) }}">{{$child->label}}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @endforeach

                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6">
                                        <div class="main-menu menu-style-1">
                                            <nav class="tp-main-menu-content">
                                                <livewire:shared.components.header-nav />
                                            </nav>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3">
                                        <div class="tp-header-contact d-flex align-items-center justify-content-end">
                                            <div class="tp-header-contact-content">
                                                @if(!!$linkedProvider)
                                                    <button class="btn btn-outline-primary">
                                                        <i class="fa-thin fa-rectangle-history-circle-plus fa-beat-fade text-danger"></i>
                                                        {{ __('header.main_menus.others.add_product') }}
                                                    </button>
                                                @elseif(auth()->check())
                                                    <a class="btn btn-outline-primary" href="{{ LaravelLocalization::localizeUrl('/become_a_seller') }}">
                                                        <i class="fa-thin fa-shop fa-beat-fade text-danger"></i>
                                                        {{ __('header.main_menus.others.become_seller') }}
                                                    </a>
                                                @else
                                                    <a href="{{ LaravelLocalization::localizeUrl(route('custom_products')) }}" class="btn btn-outline-primary">
                                                        <i class="fa-thin fa-users-gear fa-beat-fade text-danger"></i>
                                                        {{ __('header.main_menus.others.custom_products') }}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- header area end -->

            <div id="header-sticky-2" class="tp-header-sticky-area">
                <div class="container">
                    <div class="tp-mega-menu-wrapper p-relative">
                        <div class="row align-items-center">
                            <div class="col-xl-3 col-lg-3 col-md-3 col-6">
                                <div class="logo">
                                    <a href="{{ LaravelLocalization::localizeUrl('/home') }}">
                                        <img src={{asset("assets/img/logo/logo.svg")}} alt="logo">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 d-none d-md-block">
                                <div class="tp-header-sticky-menu main-menu menu-style-1">
                                    <nav id="mobile-menu">
                                        <livewire:shared.components.header-nav />
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-6">
                                <div class="tp-header-action d-flex align-items-center justify-content-end ml-50">
                                    @if(!!$linkedProvider)
                                        <div class="tp-header-action-item d-none d-lg-flex">
                                            <a class="btn" title="{{ __('header.main_menus.others.add_product') }}">
                                                <i class="fa-solid fa-rectangle-history-circle-plus text-danger"></i>
                                            </a>
                                            <livewire:shared.components.header-bookmarks-count/>
                                        </div>
                                    @elseif(auth()->check())
                                        <div class="tp-header-action-item d-none d-lg-block">
                                            <a class="btn" title="{{ __('header.main_menus.others.become_seller') }}" href="{{ LaravelLocalization::localizeUrl('/become_a_seller') }}">
                                                <i class="fa-solid fa-shop text-danger"></i>
                                            </a>
                                            <livewire:shared.components.header-bookmarks-count/>
                                        </div>
                                    @else
                                        <div class="tp-header-action-item d-none d-lg-block">
                                            <a class="btn"
                                               href="{{ LaravelLocalization::localizeUrl(route('custom_products')) }}"
                                               title="{{ __('header.main_menus.others.custom_products') }}">
                                                <i class="fa-solid fa-users-gear text-danger"></i>
                                            </a>
                                            <a class="btn" href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeUrl('/login') }}" title="{{ __('header.main_menus.others.sign_in') }}">
                                                <i class="fa-solid fa-sign-in text-primary"></i>
                                            </a>
                                            <a class="btn" title="{{ __('header.main_menus.others.register') }}" href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeUrl('/register') }}">
                                                <i class="fa-solid fa-user-plus text-secondary"></i>
                                            </a>
                                        </div>
                                    @endif
                                    <div class="tp-header-action-item d-lg-none">
                                        <button type="button" class="tp-header-action-btn tp-offcanvas-open-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="16" viewBox="0 0 30 16">
                                                <rect x="10" width="20" height="2" fill="currentColor"/>
                                                <rect x="5" y="7" width="25" height="2" fill="currentColor"/>
                                                <rect x="10" y="14" width="20" height="2" fill="currentColor"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @break
        @default
            <header>
                <div class="tp-header-area tp-header-style-primary tp-header-height">
                    <!-- header top start  -->
                    <div class="tp-header-top-2 p-relative z-index-11 tp-header-top-border d-none d-md-block">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="tp-header-info d-flex align-items-center">
                                        <div class="tp-header-info-item">
                                            <a href="tel:+(237) 6 XX XX XX XX">
                                                 <span>
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M1.359 2.73916C1.59079 2.35465 2.86862 0.958795 3.7792 1.00093C4.05162 1.02426 4.29244 1.1883 4.4881 1.37943H4.48885C4.93737 1.81888 6.22423 3.47735 6.29648 3.8265C6.47483 4.68282 5.45362 5.17645 5.76593 6.03954C6.56213 7.98771 7.93402 9.35948 9.88313 10.1549C10.7455 10.4679 11.2392 9.44752 12.0956 9.62511C12.4448 9.6981 14.1042 10.9841 14.5429 11.4333V11.4333C14.7333 11.6282 14.8989 11.8698 14.9214 12.1422C14.9553 13.1016 13.4728 14.3966 13.1838 14.5621C12.502 15.0505 11.6125 15.0415 10.5281 14.5373C7.50206 13.2784 2.66618 8.53401 1.38384 5.39391C0.893174 4.31561 0.860062 3.42016 1.359 2.73916Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                       <path d="M9.84082 1.18318C12.5534 1.48434 14.6952 3.62393 15 6.3358" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                       <path d="M9.84082 3.77927C11.1378 4.03207 12.1511 5.04544 12.4039 6.34239" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                 </span> +(237) 6 XX XX XX XX
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="tp-header-top-right tp-header-top-black d-flex align-items-center justify-content-end">
                                        <livewire:shared.components.header-actions />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- header bottom start -->
                    <div id="header-sticky" class="tp-header-bottom-2 tp-header-sticky">
                        <div class="container">
                            <div class="tp-mega-menu-wrapper p-relative">
                                <div class="row align-items-center">
                                    <div class="col-xl-2 col-lg-5 col-md-5 col-sm-4 col-6">
                                        <div class="logo">
                                            <a href="{{ LaravelLocalization::localizeUrl('/home') }}">
                                                <img src={{asset("assets/img/logo/logo.svg")}} alt="logo">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-xl-5 d-none d-xl-block">
                                        <div class="main-menu menu-style-2">
                                            <nav class="tp-main-menu-content">
                                                <livewire:shared.components.header-nav />
                                            </nav>
                                        </div>
                                        <div class="tp-category-menu-wrapper d-none">
                                            <nav class="tp-main-menu-content">
                                                <livewire:shared.components.header-nav />
                                            </nav>
                                        </div>
                                    </div>
                                    <div class="col-xl-5 col-lg-7 col-md-7 col-sm-8 col-6">
                                        <div class="tp-header-bottom-right d-flex align-items-center justify-content-end pl-30">
                                            <div class="tp-header-search-2 d-none d-sm-block" x-data="{search: ''}">
                                                <form onsubmit="return false">
                                                    <input type="text" x-model="search" placeholder="{{ __('header.searchbar.placeholder') }}...">
                                                    <button type="submit" @click="window.location.href = (@js(LaravelLocalization::localizeUrl('/products')) + '?search='+search+'&categories='+category)">
                                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M9 17C13.4183 17 17 13.4183 17 9C17 4.58172 13.4183 1 9 1C4.58172 1 1 4.58172 1 9C1 13.4183 4.58172 17 9 17Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            <path d="M18.9999 19L14.6499 14.65" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="tp-header-action d-flex align-items-center ml-30">
                                                <a class="btn"
                                                    {{ LaravelLocalization::localizeUrl(route('custom_products')) }}
                                                >
                                                    <i class="fa-solid fa-users-gear"></i>
                                                </a>
                                                <div class="tp-header-action-item d-none d-lg-block">
                                                    <livewire:shared.components.header-bookmarks-count/>
                                                </div>
                                                <div class="tp-header-action-item tp-header-hamburger mr-20 d-xl-none">
                                                    <button type="button" class="tp-offcanvas-open-btn">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="16" viewBox="0 0 30 16">
                                                            <rect x="10" width="20" height="2" fill="currentColor"/>
                                                            <rect x="5" y="7" width="25" height="2" fill="currentColor"/>
                                                            <rect x="10" y="14" width="20" height="2" fill="currentColor"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            @break
    @endswitch
    <!-- header area start -->

</div>
