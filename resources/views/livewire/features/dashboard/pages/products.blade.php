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
                        <livewire:features.dashboard.components.dashboard-menu :currentMenu="'nav-products-tab'"/>
                    </div>
                    <div class="col-xxl-8 col-lg-8">
                        <div class="profile__tab-content">
                            <div class="tab-content" id="profile-tabContent">
                                <div class="tab-pane fade show active" id="nav-products" role="tabpanel" aria-labelledby="nav-products-tab">
                                    <div class="profile__ticket table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th scope="col">{{ __('dashboard.products.table_header.name') }}</th>
                                                <th scope="col">{{ __('dashboard.products.table_header.category') }}</th>
                                                <th scope="col">{{ __('dashboard.products.table_header.price') }}</th>
                                                <th scope="col">{{ __('dashboard.products.table_header.is_in_promotion') }}</th>
                                                <th scope="col">{{ __('dashboard.products.table_header.actions') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($products as $product)
                                                <tr>
                                                    <td>{{ $product->id }}</td>
                                                    <td title="{{ $product->name }}" style="max-width: 300px" class="single-line-ellipsis">
                                                        {{ $product->name }}
                                                    </td>
                                                    <td title="{{ $product->category->label }}" class="single-line-ellipsis">
                                                        {{ $product->category->label }}
                                                    </td>
                                                    <td class="single-line-ellipsis">{{ $product->formatted_price->new }} XAF</td>
                                                    @if($product->is_in_promotion)
                                                        <td class="text-success">{{ __('helpers.choices.yes') }}</td>
                                                    @else
                                                        <td class="text-secondary">{{ __('helpers.choices.no') }}</td>
                                                    @endif
                                                    <td>
                                                        <a href="{{ $product->details_page_link }}"
                                                            {{ __('dashboard.products.actions.view') }}
                                                        >
                                                            <i class="fa fa-eye text-primary"></i>
                                                        </a>
                                                        <a href="#"
                                                           title="{{ __('dashboard.products.actions.edit') }}"
                                                        >
                                                            <i class="fa fa-edit text-success"></i>
                                                        </a>
                                                        <a class="cursor-pointer"
                                                           title="{{ __('dashboard.products.actions.delete') }}"
                                                           wire:click="shouldDeleteProduct({{$product->id}}, '{{$product->name}}')")>
                                                            <i class="fa fa-trash text-danger"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tp-shop-pagination mt-20">
                                        <div class="tp-pagination">
                                            <nav>
                                                {{$products->links()}}
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
