@if(\App\Enums\StockType::fromValue($product->stock_type)->value === \App\Enums\StockType::PRE_ORDER)
    <!-- product badge -->
    <div class="tp-product-badge">
        <span class="product-trending">{{(new \App\Enums\StockType(\App\Enums\StockType::PRE_ORDER))->description}}</span>
    </div>
@elseif(\App\Enums\StockType::fromValue($product->stock_type)->value === \App\Enums\StockType::OUT_OF_STOCK)
    <!-- product badge -->
    <div class="tp-product-badge">
        <span class="product-trending bg-danger">{{(new \App\Enums\StockType(\App\Enums\StockType::OUT_OF_STOCK))->description}}</span>
    </div>
@elseif($product->is_in_promotion)
    <!-- product badge -->
    <div class="tp-product-badge">
        <span class="product-offer">-{{$product->promotion->discount_percentage}}%</span>
    </div>
@else
    <div></div>
@endif
