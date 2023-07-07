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
                        <livewire:features.dashboard.components.dashboard-menu :currentMenu="'nav-my-orders-tab'"/>
                    </div>
                    <div class="col-xxl-8 col-lg-8">
                        <div class="profile__tab-content">
                            <div class="tab-content" id="profile-tabContent">
                                <div class="tab-pane fade show active" id="nav-my-orders" role="tabpanel" aria-labelledby="nav-my-orders-tab">
                                    @if($total > 0)
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="tp-shop-top-left d-flex align-items-center h-100">
                                                    <div class="tp-shop-top-result">
                                                        <p>{{ __('products.results', ['from' => $from, 'to' => $to, 'total' => $total]) }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="tp-shop-top-right d-sm-flex align-items-center justify-content-xl-end">
                                                    <div class="tp-shop-top-select">
                                                        <div class="nice-select" tabindex="0">
                                                                <span class="current">
                                                                    {{ __('dashboard.orders.sorts.'.str_replace('-desc', '', str_replace('-asc', '', $sorting))) }}
                                                                    @if(str_ends_with($sorting, '-asc'))
                                                                        (asc &#8593;)
                                                                    @elseif(str_ends_with($sorting, '-desc'))
                                                                        (desc &#8595;)
                                                                    @endif
                                                                </span>
                                                            <ul class="list">
                                                                @foreach($sortingValues as $sortingValue)
                                                                    <li wire:click="$set('sorting', '{{$sortingValue}}')"
                                                                        data-value="{{$sortingValue}}" class="option">
                                                                        {{ __('dashboard.orders.sorts.'.str_replace('-desc', '', str_replace('-asc', '', $sortingValue))) }}
                                                                        @if(str_ends_with($sortingValue, '-asc'))
                                                                            (asc &#8593;)
                                                                        @elseif(str_ends_with($sortingValue, '-desc'))
                                                                            (desc &#8595;)
                                                                        @endif
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="profile__ticket table-responsive mt-20">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">{{ __('dashboard.orders.table_header.product') }}</th>
                                                <th scope="col">{{ __('dashboard.orders.table_header.customer_name') }}</th>
                                                <th scope="col">{{ __('dashboard.orders.table_header.customer_phone') }}</th>
                                                <th scope="col">{{ __('dashboard.orders.table_header.quantity') }}</th>
                                                <th scope="col">{{ __('dashboard.orders.table_header.ordered_on') }}</th>
                                                <th scope="col">{{ __('dashboard.orders.table_header.details') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($orders as $order)
                                                <tr>
                                                    <td>
                                                        {{ $order->id }}
                                                    </td>
                                                    <td style="max-width: 300px" title="{{ $order->product->name }}" class="single-line-ellipsis">
                                                        {{ $order->product->name }}
                                                    </td>
                                                    <td class="single-line-ellipsis">
                                                        {{ $order->customer_name }}
                                                    </td>
                                                    <td class="single-line-ellipsis">{{ $order->customer_phone }}</td>
                                                    <td class="single-line-ellipsis">{{ $order->quantity }}</td>
                                                    <td class="single-line-ellipsis">{{ $order->created_at }}</td>
                                                    <td>
                                                        <a class="cursor-pointer">
                                                            <i class="fa fa-eye text-primary"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center fst-italic">
                                                        {{ __('dashboard.orders.no_orders') }}
                                                    </td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tp-shop-pagination mt-20">
                                        <div class="tp-pagination">
                                            <nav>
                                                {{$orders->links()}}
                                            </nav>
                                        </div>
                                    </div>
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
