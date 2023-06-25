{{--<!DOCTYPE html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
{{--    <head>--}}
{{--        <meta charset="utf-8">--}}
{{--        <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--        <meta name="csrf-token" content="{{ csrf_token() }}">--}}

{{--        <title>{{ config('app.name', 'Laravel') }}</title>--}}

{{--        <!-- Fonts -->--}}
{{--        <link rel="preconnect" href="https://fonts.bunny.net">--}}
{{--        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />--}}

{{--        <!-- Scripts -->--}}
{{--        @vite(['resources/css/app.css', 'resources/js/app.js'])--}}
{{--    </head>--}}
{{--    <body>--}}
{{--        <div class="font-sans text-gray-900 antialiased">--}}
{{--            {{ $slot }}--}}
{{--        </div>--}}
{{--    </body>--}}
{{--</html>--}}


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'Page') | {{env('APP_NAME')}}</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico in the root directory -->
        <link rel="shortcut icon" type="image/x-icon" href={{asset("assets/img/logo/favicon.png")}}>

        <!-- CSS here -->
        <link rel="stylesheet" href={{asset("assets/css/bootstrap.css")}}>
        <link rel="stylesheet" href={{asset("assets/css/animate.css")}}>
        <link rel="stylesheet" href={{asset("assets/css/font-awesome-pro.css")}}>
        <link rel="stylesheet" href={{asset("assets/css/flaticon_shofy.css")}}>
        <link rel="stylesheet" href={{asset("assets/css/spacing.css")}}>
        <link rel="stylesheet" href={{asset("assets/css/main.css")}}>
    </head>
    <body>
        <main>
            @yield('content')
        </main>

        <script src={{asset("assets/js/vendor/jquery.js")}}></script>
{{--        <script src={{asset("assets/js/vendor/waypoints.js")}}></script>--}}
        <script src={{asset("assets/js/bootstrap-bundle.js")}}></script>
{{--        <script src={{asset("assets/js/imagesloaded-pkgd.js")}}></script>--}}
{{--        <script src={{asset("assets/js/ajax-form.js")}}></script>--}}
{{--        <script src={{asset("assets/js/main.js")}}></script>--}}
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </body>
</html>
