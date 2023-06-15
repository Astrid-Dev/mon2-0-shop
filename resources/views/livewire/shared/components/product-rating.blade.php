<div wire:key="rand()">
    <div class="tp-product-rating d-flex align-items-center">
        <div class="tp-product-rating-icon">
            @for($i = 0; $i < floor($rating ?? 0); $i++)
                <span><i class="fa-solid fa-star"></i></span>
            @endfor
            @if((($rating - floor($rating ?? 0)) >= 0.5))
                <span><i class="fa-solid fa-star-half-stroke"></i></span>
            @endif
            @for($i = 0; $i < (5 - ((($rating - floor($rating ?? 0)) >= 0.5) ? ceil($rating ?? 0) : floor($rating ?? 0))); $i++)
                <span class="un-count"><i class="fa-solid fa-star"></i></span>
            @endfor
        </div>
        @switch($reviewDisplayType)
            @case('full')
                <div class="tp-product-rating-text">
                    <span>({{trans_choice('helpers.reviews_count', $ratersCount)}})</span>
                </div>
            @break
            @case('short')
                <div class="tp-product-rating-text">
                    <span>({{number_format($rating ?? 0, 1)}})</span>
                </div>
            @break
            @case('none')
            @break
        @endswitch
    </div>

</div>
