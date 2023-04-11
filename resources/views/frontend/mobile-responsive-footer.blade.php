{{-- Start Modal --}}

<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm m-0">
        <div class="modal-content p-3" style="">
            <div class="mobile-modal">
                <h5>
                    <span>
                        <i class="fas fa-shopping-basket" style="color: #ff5c00;"></i>
                    </span>
                    <span style="color: #ff5c00;">{{$companyInfo->name}}</span>
                </h5>
                <hr class="m-0 p-0">
                <div class="row">
                    <div class="col-4">
                        <img src="{{ asset('img/logo/logo.png') }}" class="img img-thumbnail" />
                    </div>
                    <div class="col-8">
                        <div class="row">
                            <div class="col-12">
                                <span id="mobile-modal-product-name" style="color: black;font-weight: bold;"></span><br>
                                <span style="color: rgb(8, 0, 0);">Minimum Order: </span> <span
                                    class="mobile-modal-product-min_qty"
                                    style="color: red;font-weight: bold;font-size: 12px;"></span> <span
                                    style="color: red;">Piece</span><br>
                                @if($currencySymbol)
                                {{ $currencySymbol->symbol }}
                                @endif
                                <span class="mobile-modal-product-unit-price" style="color: rgb(0, 0, 0);"></span> x
                                <span class="mobile-modal-product-quantity-label" style="color: rgb(0, 0, 0);"></span>
                            </div>
                            <div class="col-5">
                                <span class="text-danger" style="font-size: 16px;">
                                    @if($currencySymbol)
                                    {{ $currencySymbol->symbol }}
                                    @endif
                                    <span class="mobile-modal-product-price"></span>
                                </span>
                            </div>
                            {{-- <div class="col-12">
                                    <span class="text-danger" style="font-size: 18px;">
                                      Minimum order Qty <span class="mobile-modal-product-min_qty"></span>
                                    </span>
                                  </div> --}}

                            <div class="col-7 text-center">
                                <td class="product-quantity">
                                    <div class="cart-plus">
                                        <form action="#">
                                            <div class="cart-plus-minus mobile-modal-cart-plus-minus"
                                                data-device="mobile">
                                                <input type="text" class="mobile-modal-product-quantity ">
                                            </div>
                                        </form>
                                    </div>
                                </td>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-2">
                <div class="row">
                    <div class="col-6">
                        <center>
                            <a id="addToCart" class="cart-button cart-button1 mobile-modal-add-to-card"
                                style="background-color: rgb(139, 39, 39); color: white; font-weight: bold;">Buy More Product</a>
                        </center>
                    </div>

                    <div class="col-6">
                        <center>
                            <a id="addToCart" class="cart-button cart-button1 mobile-modal-add-to-card"
                                href="{{ route('check-out') }}"
                                style="background-color: rgb(139, 39, 39); color: white; font-weight: bold;">Finish Order</a>
                        </center>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- End Modal --}}
<footer id="mobileResponsiveFooter" style="z-index: 1;">
    <div class="card">
        <div class="card-body m-0 p-0">
            <div class="row">
                {{-- <div class="col-6 pt-1 text-center" id="shoppingStart">
                <div class="logo">
                    <a href="{{url('/')}}"><img src="{{ URL::asset('venam/') }}/img/logo/logo_paikari_red.png"
                    alt="Logo"></a>
            </div>
        </div> --}}
        <div class="col-3 pt-1 text-center">
            {{-- <i class="fas fa-shopping-cart mt-2" style="font-size: 30px;"></i> --}}
            <li class="header-shop-cart">
                <a href="{{url('/')}}">
                    <i class="fas fa-home" style="font-size: 20px;color: #ff5c00;"></i>
                </a><br>
                <span style="font-size:10px;font-weight:bold;color:#ff5c00;">@if (isset($companyInfo->name)) {{$companyInfo->name}} @endif</span>
        </div>
        <div class="col-3 pt-1 text-center">
            {{-- <i class="fas fa-shopping-cart mt-2" style="font-size: 30px;"></i> --}}
            <li class="header-shop-cart">
                <a href="{{route('search-category-wise')}}"><i class="fas fa-bullhorn text-dark" style="font-size: 20px;"></i>
                </a>
                <br>
                <span class="text-dark" style="font-size:10px; font-weight:bold;">All Product</span>
        </div>
        <div class="col-3 pt-1 text-center">
            {{-- <i class="fas fa-shopping-cart mt-2" style="font-size: 30px;"></i> --}}
            <li class="header-shop-cart"><a href="{{ route('my-account') }}"><i class="fas fa-store-alt text-dark"
                        style="font-size: 20px;"></i></a><br>
                <span class="text-dark" style="font-size:10px; font-weight:bold;">Order List</span>
        </div>
        <div class="col-3 pt-1 text-center">
            {{-- <i class="fas fa-shopping-cart mt-2" style="font-size: 30px;"></i> --}}
            <li class="header-shop-cart"><a href="{{ route('cart') }}">
                    <i class="fas fa-shopping-cart text-dark" style="font-size: 20px;"></i><span class="cart-count"
                        style="background-color: #ff0000;">{{ $cardBadge['data']['number_of_product'] }}</span></a><br>
                <span style="font-size:10px; font-weight:bold;color: #ff0000;">Cart</span>
        </div>
    </div>
    </div>
    </div>
</footer>

<script>
    $("#addToCart").on("click", function (event) {
        $('.modal').modal('hide');
    });
</script>
