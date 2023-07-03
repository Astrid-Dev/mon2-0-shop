<ul>
    {{--                                                    <li><a href="contact.html">{{ __('header.main_menus.home.title') }}</a></li>--}}
    <li><a href="{{ LaravelLocalization::localizeUrl('/products').('?siblings='.\App\Enums\SiblingType::MAN) }}">{{ __('header.main_menus.sibling.man') }}</a></li>
    <li><a href="{{ LaravelLocalization::localizeUrl('/products').('?siblings='.\App\Enums\SiblingType::WOMAN) }}">{{ __('header.main_menus.sibling.woman') }}</a></li>
    <li><a href="{{ LaravelLocalization::localizeUrl('/products').('?siblings='.\App\Enums\SiblingType::KID) }}">{{ __('header.main_menus.sibling.kid') }}</a></li>
    <li><a href="{{ LaravelLocalization::localizeUrl('/products').('?asset=discount') }}">{{ __('header.main_menus.promotions.title') }}</a></li>
    <li><a href="{{ LaravelLocalization::localizeUrl('/products').('?sorting=newest') }}">{{ __('header.main_menus.new_arrivals.title') }}</a></li>
    <li style="margin-right: 0"><a href="{{ LaravelLocalization::localizeUrl(route('custom_products')) }}">{{ __('header.main_menus.others.gifts') }}</a></li>
</ul>
