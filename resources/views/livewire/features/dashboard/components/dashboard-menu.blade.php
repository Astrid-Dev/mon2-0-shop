<div>
    <div class="profile__tab mr-40">
        <nav>
            <div class="nav nav-tabs tp-tab-menu flex-column" id="profile-tab" role="tablist">
                @foreach($menu as $menuItem)
                    <a class="nav-link {{$currentMenu === $menuItem['key'] ? 'active' : ''}}" id="{{$menuItem['key']}}"
                        href="{{$menuItem['link']}}"
                        role="tab">
                        <span><i class="{{$menuItem['icon']}}"></i></span>
                        {{ __($menuItem['label']) }}
                    </a>
                @endforeach
{{--                <button class="nav-link" id="nav-password-tab" data-bs-toggle="tab" data-bs-target="#nav-password" type="button" role="tab" aria-controls="nav-password" aria-selected="false"><span><i class="fa-regular fa-lock"></i></span> Change Password</button>--}}
                <span id="marker-vertical" class="tp-tab-line d-none d-sm-inline-block"></span>
            </div>
        </nav>
    </div>
</div>
