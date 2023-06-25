<div class="tp-header-top-menu d-flex align-items-center justify-content-end">
    <div class="tp-header-top-menu-item tp-header-lang">
        <span class="tp-header-lang-toggle" id="tp-header-lang-toggle">
            {{ ucfirst(LaravelLocalization::getCurrentLocaleNative()) }}
        </span>
        <ul>
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <li wire:key="'locale-'.$localeCode.rand()">
                    <a class="{{$localeCode === LaravelLocalization::getCurrentLocale() ? 'text-primary' : ''}}" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ ucfirst($properties['native']) }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="tp-header-top-menu-item tp-header-currency">
        <span class="tp-header-currency-toggle" id="tp-header-currency-toggle">{{ __('header.currencies.xaf') }}</span>
        <ul>
            {{--                                        <li>--}}
            {{--                                            <a href="#">EUR</a>--}}
            {{--                                        </li>--}}
        </ul>
    </div>
    <div class="tp-header-top-menu-item tp-header-setting">
        <span class="tp-header-setting-toggle" id="tp-header-setting-toggle">{{ __('header.settings.title') }}</span>
        @auth()
            <ul>
                <li>
                    <a href="{{ LaravelLocalization::localizeUrl(route('dashboard.profile')) }}">{{ __('header.settings.my_profile') }}</a>
                </li>
                <li>
                    <a href="wishlist.html">{{ __('header.settings.favorites') }}</a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <a type="submit" class="text-danger" @click.prevent="$root.submit();">{{ __('header.settings.logout') }}</a>
                    </form>
                </li>
            </ul>
        @endauth
    </div>
</div>
