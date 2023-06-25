{{--@if ($errors->any())--}}
{{--    <div {{ $attributes }}>--}}
{{--        <div class="font-medium text-red-600">{{ __('Whoops! Something went wrong.') }}</div>--}}

{{--        <ul class="mt-3 list-disc list-inside text-sm text-red-600">--}}
{{--            @foreach ($errors->all() as $error)--}}
{{--                <li>{{ $error }}</li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--@endif--}}

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-danger">{{ __('helpers.validatation_errors') }}</div>

        <ul style="padding-left: 1rem" class="mt-3 list-disc list-inside small text-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
