@push('css')
@endpush
<div>
    <x-slot name="title">
        Manage Language
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4>Manage Language</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-right">
                                <a href="{{ route('setting.language') }}"
                                    class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"><i
                                        class="mdi mdi-plus mr-1"></i>Language</a>
                            </div>
                        </div><!-- end col-->
                    </div>
                    <div wire:ignore class="table-responsive">
                        <form wire:submit.prevent="dataSave">
                            <div class="modal-body">
                                {{-- Start Language Input --}}
                                <div class="row p-1 m-1">
                                    <div class="col-md-4">
                                        <div class="row" style="background-color: #bedac2;">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="sign_up">Sign Up</label>
                                                    <input type="text" class="form-control" wire:model.lazy="sign_up"
                                                        name="sign_up" id="sign_up" placeholder="Sign Up">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="sign_in">Sign In</label>
                                                    <input type="text" class="form-control" wire:model.lazy="sign_in"
                                                        name="sign_in" id="sign_in" placeholder="Sign In">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="new_product">New Product</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="new_product" name="new_product"
                                                        id="new_product" placeholder="New Product">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="best_selling_product">Best Selling Product</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="best_selling_product"
                                                        name="best_selling_product" id="best_selling_product"
                                                        placeholder="Best selling Product">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="home">Home</label>
                                                    <input type="text" class="form-control" wire:model.lazy="home"
                                                        name="home" id="home" placeholder="Home">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="home">Product Categories</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="product_categories" name="product_categories"
                                                        id="product_categories" placeholder="Product Categories">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="shop_page">Shop Page</label>
                                                    <input type="text" class="form-control" wire:model.lazy="shop_page"
                                                        name="shop_page" id="shop_page" placeholder="Shop Page">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="complain_or_opinion">Complain/Opinion</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="complain_or_opinion" name="complain_or_opinion"
                                                        id="complain_or_opinion" placeholder="Complain/Opinion">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="communication">Communication</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="communication" name="communication"
                                                        id="communication" placeholder="Communication">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="return_policy">Return Policy</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="return_policy" name="return_policy"
                                                        id="return_policy" placeholder="Return Policy">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="contact_us">Contact Us</label>
                                                    <input type="text" class="form-control" wire:model.lazy="contact_us"
                                                        name="contact_us" id="contact_us" placeholder="Contact Us">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="privacy_policy">Privacy Policy</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="privacy_policy" name="privacy_policy"
                                                        id="privacy_policy" placeholder="Privacy Policy">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="privacy_policy">Shopping cart Button Text</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="shopping_cart_button_text"
                                                        name="shopping_cart_button_text" id="shopping_cart_button_text"
                                                        placeholder="Shopping cart Button Text">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="terms_and_condition">Terms And Condition</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="terms_and_condition" name="terms_and_condition"
                                                        id="terms_and_condition" placeholder="Terms And Condition">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="about_us">About Us</label>
                                                    <input type="text" class="form-control" wire:model.lazy="about_us"
                                                        name="about_us" id="about_us" placeholder="About Us">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="mission_and_vision">Mission And Vision</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="mission_and_vision" name="mission_and_vision"
                                                        id="mission_and_vision" placeholder="About Us">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="my_account">My Account</label>
                                                    <input type="text" class="form-control" wire:model.lazy="my_account"
                                                        name="my_account" id="my_account" placeholder="My Account">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="shopping_cart">Shopping Cart</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="shopping_cart" name="shopping_cart"
                                                        id="shopping_cart" placeholder="Shopping Cart">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="checkout">Checkout</label>
                                                    <input type="text" class="form-control" wire:model.lazy="checkout"
                                                        name="checkout" id="checkout" placeholder="Checkout">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="menu">Menu</label>
                                                    <input type="text" class="form-control" wire:model.lazy="menu"
                                                        name="menu" id="menu" placeholder="Menu">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="product_search">Product Search</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="product_search" name="product_search"
                                                        id="product_search" placeholder="Product Search">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row mx-md-1" style="background-color: #bedac2;">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="beaking_news">Breaking News</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="beaking_news" name="beaking_news"
                                                        id="beaking_news" placeholder="Breaking News">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="total_amount">Total</label>
                                                    <input type="text" class="form-control" wire:model.lazy="total"
                                                        name="total" id="total" placeholder="Total">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="total_amount">Sub Total</label>
                                                    <input type="text" class="form-control" wire:model.lazy="sub_total"
                                                        name="total" id="total" placeholder="Total">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="more_categories">More Categories</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="more_categories" name="more_categories"
                                                        id="more_categories" placeholder="More Categories">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="more_products">More Products</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="more_products" name="more_products"
                                                        id="more_products" placeholder="More Products">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="discount">Discount</label>
                                                    <input type="text" class="form-control" wire:model.lazy="discount"
                                                        name="discount" id="discount" placeholder="Discount">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="checkout_button_text">Checkout Button text</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="checkout_button_text"
                                                        name="checkout_button_text" id="checkout_button_text"
                                                        placeholder="Check out Button Text">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="login_button_text">Login Button Text</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="login_button_text" name="login_button_text"
                                                        id="login_button_text" placeholder="Log In Button Text">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="register_button_text">Register Button Text</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="register_button_text"
                                                        name="register_button_text" id="register_button_text"
                                                        placeholder="Register Button Text">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="logout_button_text">Log Out Button Text</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="logout_button_text" name="logout_button_text"
                                                        id="logout_button_text" placeholder="Log Out Button Text">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="sell_button_text">Sell Button Text</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="sell_button_text" name="sell_button_text"
                                                        id="sell_button_text" placeholder="Sell Button Text">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="sold_out_button_text">Sold Out Button Text</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="sold_out_button_text"
                                                        name="sold_out_button_text" id="sold_out_button_text"
                                                        placeholder="Sold out Button Text">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="cart_page_order_finish_button_text">Cart Page Order
                                                        Finish Button
                                                        Text</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="cart_page_order_finish_button_text"
                                                        name="cart_page_order_finish_button_text"
                                                        id="cart_page_order_finish_button_text"
                                                        placeholder="Cart Page Order Finish Button Text">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="checkout_page_order_done_button_text">Checkout Page
                                                        Order Done Button
                                                        Text</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="checkout_page_order_done_button_text"
                                                        name="checkout_page_order_done_button_text"
                                                        id="checkout_page_order_done_button_text"
                                                        placeholder="Checkout Page Order Done Button Text">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="see_your_order_button_text">See Your Order Button
                                                        Text</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="see_your_order_button_text"
                                                        name="see_your_order_button_text"
                                                        id="see_your_order_button_text"
                                                        placeholder="See Your Order Button Text">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="business_name_label">Business Name Label</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="business_name_label" name="business_name_label"
                                                        id="business_name_label"
                                                        placeholder="See Your Order Button Text">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="your_name_label">Your Name Label</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="your_name_label" name="your_name_label"
                                                        id="your_name_label" placeholder="Your Name Label">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="zilla_label">Zilla Label</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="zilla_label" name="zilla_label"
                                                        id="zilla_label" placeholder="Your zilla Label">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="delivery_address_label">Delivery Address Label</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="delivery_address_label"
                                                        name="delivery_address_label" id="delivery_address_label"
                                                        placeholder="Delivery Address Label">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="mobile_number_label">Mobile Number Label</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="mobile_number_label" name="mobile_number_label"
                                                        id="mobile_number_label" placeholder="Mobile Number Label">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="full_address_label">Full Address Label</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="full_address_label" name="full_address_label"
                                                        id="full_address_label" placeholder="Full Address Label">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row" style="background-color: #bedac2;">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="more_order_button_text">More Order Button Text</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="more_order_button_text"
                                                        name="more_order_button_text" id="more_order_button_text"
                                                        placeholder="More Order Button Text">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="unit">Unit</label>
                                                    <input type="text" class="form-control" wire:model.lazy="unit"
                                                        name="unit" id="unit" placeholder="Unit">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="cart_page_header_title">Cart Page Header Title</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="cart_page_header_title"
                                                        name="cart_page_header_title" id="cart_page_header_title"
                                                        placeholder="Cart Page Header Title">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="checkout_page_header_title">Checkout Page Header
                                                        Title</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="checkout_page_header_title"
                                                        name="checkout_page_header_title"
                                                        id="checkout_page_header_title"
                                                        placeholder="Checkout Page Header Title">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="checkout_page_header_title">Ordered Product
                                                        Title</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="ordered_product_title"
                                                        name="ordered_product_title" id="ordered_product_title"
                                                        placeholder="Ordered Product Title">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="checkout_page_header_title">Bill Total Title</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="bill_total_title"
                                                        name="bill_total_title" id="bill_total_title"
                                                        placeholder="Bill Total Title">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="business_name_placeholder">Business Name Placeholder</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="business_name_placeholder"
                                                        name="business_name_placeholder" id="business_name_placeholder"
                                                        placeholder="Business Name Placeholder">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="your_name_placeholder">Your Name Placeholder</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="your_name_placeholder"
                                                        name="your_name_placeholder" id="your_name_placeholder"
                                                        placeholder="Your Name Placeholder">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="your_mobile_number_placeholder">Your Mobile Number Placeholder</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="your_mobile_number_placeholder"
                                                        name="your_mobile_number_placeholder" id="your_mobile_number_placeholder"
                                                        placeholder="Your Mobile Number Placeholder">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="full_address_placeholder">Full Address Placeholder</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="full_address_placeholder"
                                                        name="full_address_placeholder" id="full_address_placeholder"
                                                        placeholder="Full Address Placeholder">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="delivery_address_placeholder">Delivery Address Placeholder</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="delivery_address_placeholder"
                                                        name="delivery_address_placeholder" id="delivery_address_placeholder"
                                                        placeholder="Delivery Address Placeholder">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="select_zila_option_text">Select Zila Option Text</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="select_zila_option_text"
                                                        name="select_zila_option_text" id="select_zila_option_text"
                                                        placeholder="Select Zila Option Text">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="no_product_in_shopping_bag_alert_text">No Product In Shopping Bag Alert</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="no_product_in_shopping_bag_alert_text"
                                                        name="no_product_in_shopping_bag_alert_text" id="no_product_in_shopping_bag_alert_text"
                                                        placeholder="No Product In Shopping Bag Alert">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="no_product_alert">No Product Alert Text</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="no_product_alert"
                                                        name="no_product_alert" id="no_product_alert"
                                                        placeholder="No Product Alert Text">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="cash_on_delivery_text">Cash On Delivery Text</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.lazy="cash_on_delivery_text"
                                                        name="cash_on_delivery_text" id="cash_on_delivery_text"
                                                        placeholder="Cash On Delivery">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="checkbox" name="is_default"
                                                        wire:model.lazy="is_default">
                                                    <label>Is Default?</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Start Language Input --}}
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@push('scripts')
<script>
    function callDelete(id) {
            @this.call('languageDelete', id);
        }
        $(document).ready(function() {
            var datatable = $('#languageTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('data.language_list') }}",
                columns: [{
                        title: 'SL',
                        data: 'id'
                    },
                    {
                        title: 'Language',
                        data: 'language',
                        name: 'language'
                    },
                    {
                        title: 'Is Default',
                        data: 'is_default',
                        name: 'is_default'
                    },
                    {
                        title: 'Action',
                        data: 'action',
                        name: 'action'
                    },
                ]
            });

            window.livewire.on('success', message => {
                datatable.draw(true);
            });
        });
</script>
@endpush
