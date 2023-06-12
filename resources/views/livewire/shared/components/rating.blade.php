<div>
    <div class="tp-product-rating d-flex align-items-center">
        <div class="tp-product-rating-icon">
            @for($i = 0; $i < intval($rating); $i++)
                <span><i class="fa-solid fa-star"></i></span>
            @endfor
            @if((($rating - intval($rating)) >= 0.5))
                <span><i class="fa-solid fa-star-half-stroke"></i></span>
            @endif
            @for($i = 0; $i < (5); $i++)
                <span><i class="fa-solid fa-star"></i></span>
            @endfor
        </div>
        <div class="tp-product-rating-text">
            <span>({{trans_choice('helpers.reviews_count', $ratersCount)}})</span>
        </div>
    </div>

</div>
