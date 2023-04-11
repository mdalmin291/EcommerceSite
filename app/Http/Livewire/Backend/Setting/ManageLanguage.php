<?php

namespace App\Http\Livewire\Backend\Setting;

use App\Models\Backend\Setting\Language;
use Livewire\Component;

class ManageLanguage extends Component
{
    public $language;
    public $sign_up;
    public $sign_in;
    public $new_product;
    public $best_selling_product;
    public $home;
    public $product_categories;
    public $shop_page;
    public $complain_or_opinion;
    public $communication;
    public $return_policy;
    public $contact_us;
    public $discount;
    public $privacy_policy;
    public $terms_and_condition;
    public $about_us;
    public $mission_and_vision;
    public $my_account;
    public $shopping_cart;
    public $checkout;
    public $menu;
    public $product_search;
    public $beaking_news;
    public $total;
    public $sub_total;
    public $more_categories;
    public $more_products;
    public $shopping_cart_button_text;
    public $checkout_button_text;
    public $login_button_text;
    public $register_button_text;
    public $logout_button_text;
    public $sell_button_text;
    public $sold_out_button_text;
    public $cart_page_order_finish_button_text;
    public $checkout_page_order_done_button_text;
    public $see_your_order_button_text;
    public $more_order_button_text;
    public $business_name_label;
    public $your_name_label;
    public $zilla_label;
    public $delivery_address_label;
    public $mobile_number_label;
    public $full_address_label;
    public $unit;
    public $cart_page_header_title;
    public $checkout_page_header_title;
    public $ordered_product_title;
    public $bill_total_title;
    public $business_name_placeholder;
    public $your_name_placeholder;
    public $your_mobile_number_placeholder;
    public $full_address_placeholder;
    public $delivery_address_placeholder;
    public $select_zila_option_text;
    public $no_product_in_shopping_bag_alert_text;
    public $no_product_alert;
    public $cash_on_delivery_text;
    public $is_default;
    public $LanguageId;

    public function mount($id = NULL)
    {
        $QueryUpdate = Language::find($id);
        $this->LanguageId = $QueryUpdate->id;
        $this->sign_up = $QueryUpdate->sign_up;
        $this->sign_in = $QueryUpdate->sign_in;
        $this->new_product = $QueryUpdate->new_product;
        $this->best_selling_product = $QueryUpdate->best_selling_product;
        $this->home = $QueryUpdate->home;
        $this->product_categories = $QueryUpdate->product_categories;
        $this->shop_page = $QueryUpdate->shop_page;
        $this->complain_or_opinion = $QueryUpdate->complain_or_opinion;
        $this->communication = $QueryUpdate->communication;
        $this->return_policy = $QueryUpdate->return_policy;
        $this->contact_us = $QueryUpdate->contact_us;
        $this->privacy_policy = $QueryUpdate->privacy_policy;
        $this->terms_and_condition = $QueryUpdate->terms_and_condition;
        $this->about_us = $QueryUpdate->about_us;
        $this->mission_and_vision = $QueryUpdate->mission_and_vision;
        $this->my_account = $QueryUpdate->my_account;
        $this->discount = $QueryUpdate->discount;
        $this->checkout_button_text = $QueryUpdate->checkout_button_text;
        $this->login_button_text = $QueryUpdate->login_button_text;
        $this->register_button_text = $QueryUpdate->register_button_text;
        $this->logout_button_text = $QueryUpdate->logout_button_text;
        $this->sell_button_text = $QueryUpdate->sell_button_text;
        $this->sold_out_button_text = $QueryUpdate->sold_out_button_text;
        $this->cart_page_order_finish_button_text = $QueryUpdate->cart_page_order_finish_button_text;
        $this->checkout_page_order_done_button_text = $QueryUpdate->checkout_page_order_done_button_text;
        $this->shopping_cart = $QueryUpdate->shopping_cart;
        $this->shopping_cart_button_text = $QueryUpdate->shopping_cart_button_text;
        $this->see_your_order_button_text = $QueryUpdate->see_your_order_button_text;
        $this->more_order_button_text = $QueryUpdate->more_order_button_text;
        $this->more_order_button_text = $QueryUpdate->more_order_button_text;
        $this->business_name_label = $QueryUpdate->business_name_label;
        $this->your_name_label = $QueryUpdate->your_name_label;
        $this->zilla_label = $QueryUpdate->zilla_label;
        $this->delivery_address_label = $QueryUpdate->delivery_address_label;
        $this->mobile_number_label = $QueryUpdate->mobile_number_label;
        $this->full_address_label = $QueryUpdate->full_address_label;
        $this->checkout = $QueryUpdate->checkout;
        $this->menu = $QueryUpdate->menu;
        $this->product_search = $QueryUpdate->product_search;
        $this->beaking_news = $QueryUpdate->beaking_news;
        $this->total = $QueryUpdate->total;
        $this->sub_total = $QueryUpdate->sub_total;
        $this->more_categories = $QueryUpdate->more_categories;
        $this->more_products = $QueryUpdate->more_products;
        $this->unit = $QueryUpdate->unit;
        $this->cart_page_header_title = $QueryUpdate->cart_page_header_title;
        $this->checkout_page_header_title = $QueryUpdate->checkout_page_header_title;
        $this->ordered_product_title = $QueryUpdate->ordered_product_title;
        $this->bill_total_title = $QueryUpdate->bill_total_title;
        $this->business_name_placeholder = $QueryUpdate->business_name_placeholder;
        $this->your_name_placeholder = $QueryUpdate->your_name_placeholder;
        $this->your_mobile_number_placeholder = $QueryUpdate->your_mobile_number_placeholder;
        $this->full_address_placeholder = $QueryUpdate->full_address_placeholder;
        $this->delivery_address_placeholder = $QueryUpdate->delivery_address_placeholder;
        $this->select_zila_option_text = $QueryUpdate->select_zila_option_text;
        $this->no_product_in_shopping_bag_alert_text = $QueryUpdate->no_product_in_shopping_bag_alert_text;
        $this->no_product_alert = $QueryUpdate->no_product_alert;
        $this->cash_on_delivery_text = $QueryUpdate->cash_on_delivery_text;
        $this->is_default = $QueryUpdate->is_default;
    }

    public function languageDelete($id)
    {
        Language::find($id)->delete();
        $this->emit('success', [
            'text' => 'Language Deleted Successfully',
        ]);
    }
    public function dataSave()
    {
        $Query = Language::find($this->LanguageId);
        $Query->sign_up = $this->sign_up;
        $Query->sign_in = $this->sign_in;
        $Query->new_product = $this->new_product;
        $Query->best_selling_product = $this->best_selling_product;
        $Query->home = $this->home;
        $Query->product_categories = $this->product_categories;
        $Query->shop_page = $this->shop_page;
        $Query->complain_or_opinion = $this->complain_or_opinion;
        $Query->communication = $this->communication;
        $Query->return_policy = $this->return_policy;
        $Query->contact_us = $this->contact_us;
        $Query->privacy_policy = $this->privacy_policy;
        $Query->terms_and_condition = $this->terms_and_condition;
        $Query->about_us = $this->about_us;
        $Query->mission_and_vision = $this->mission_and_vision;
        $Query->my_account = $this->my_account;
        $Query->discount = $this->discount;
        $Query->shopping_cart = $this->shopping_cart;
        $Query->checkout = $this->checkout;
        $Query->menu = $this->menu;
        $Query->product_search = $this->product_search;
        $Query->beaking_news = $this->beaking_news;
        $Query->total = $this->total;
        $Query->sub_total = $this->sub_total;
        $Query->more_categories = $this->more_categories;
        $Query->more_products = $this->more_products;
        $Query->shopping_cart_button_text = $this->shopping_cart_button_text;
        $Query->checkout_button_text = $this->checkout_button_text;
        $Query->login_button_text = $this->login_button_text;
        $Query->register_button_text = $this->register_button_text;
        $Query->logout_button_text = $this->login_button_text;
        $Query->sell_button_text = $this->sell_button_text;
        $Query->sold_out_button_text = $this->sold_out_button_text;
        $Query->cart_page_order_finish_button_text = $this->cart_page_order_finish_button_text;
        $Query->checkout_page_order_done_button_text = $this->checkout_page_order_done_button_text;
        $Query->see_your_order_button_text = $this->see_your_order_button_text;
        $Query->more_order_button_text = $this->more_order_button_text;
        $Query->business_name_label = $this->business_name_label;
        $Query->your_name_label = $this->your_name_label;
        $Query->zilla_label = $this->zilla_label;
        $Query->delivery_address_label = $this->delivery_address_label;
        $Query->mobile_number_label = $this->mobile_number_label;
        $Query->full_address_label = $this->full_address_label;
        $Query->unit = $this->unit;
        $Query->cart_page_header_title = $this->cart_page_header_title;
        $Query->checkout_page_header_title = $this->checkout_page_header_title;
        $Query->ordered_product_title = $this->ordered_product_title;
        $Query->bill_total_title = $this->bill_total_title;
        $Query->business_name_placeholder = $this->business_name_placeholder;
        $Query->your_name_placeholder = $this->your_name_placeholder;
        $Query->your_mobile_number_placeholder = $this->your_mobile_number_placeholder;
        $Query->full_address_placeholder = $this->full_address_placeholder;
        $Query->delivery_address_placeholder = $this->delivery_address_placeholder;
        $Query->select_zila_option_text = $this->select_zila_option_text;
        $Query->no_product_in_shopping_bag_alert_text = $this->no_product_in_shopping_bag_alert_text;
        $Query->no_product_alert = $this->no_product_alert;
        $Query->cash_on_delivery_text = $this->cash_on_delivery_text;

        if ($this->is_default) {
            $Query->is_default = 1;
        } else {
            $Query->is_default = 0;
        }
        $Query->save();
        $this->emit('success_redirect', [
            'text' => 'Language Updated Successfully',
            'url' => route('setting.language'),
        ]);
    }
    public function render()
    {
        return view('livewire.backend.setting.manage-language', [
            'languages' => Language::get(),
        ]);
    }
}
