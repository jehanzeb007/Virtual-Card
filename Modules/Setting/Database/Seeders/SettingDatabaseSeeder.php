<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Setting\Entities\Setting;

class SettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::setMany([
            'active_theme' => 'Storefront',
            'supported_countries' => ['BD'],
            'default_country' => 'BD',
            'supported_locales' => ['en'],
            'default_locale' => 'en',
            'default_timezone' => 'Asia/Dhaka',
            'customer_role' => 2,
            'reviews_enabled' => true,
            'auto_approve_reviews' => true,
            'supported_currencies' => ['USD'],
            'default_currency' => 'USD',
            'send_order_invoice_email' => false,
            'store_email' => 'admin@fleetcart.test',
            'search_engine' => 'mysql',
            'local_pickup_cost' => 0,
            'flat_rate_cost' => 0,
            'translatable' => [
                'store_name' => 'FleetCart',
                'free_shipping_label' => 'Free Shipping',
                'local_pickup_label' => 'Local Pickup',
                'flat_rate_label' => 'Flat Rate',
                'paypal_express_label' => 'PayPal Express',
                'paypal_express_description' => 'Pay with your credit/debit card via PayPal.',
                'stripe_label' => 'Stripe',
                'stripe_description' => 'Pay via credit or debit card.',
                'cod_label' => 'Cash On Delivery',
                'cod_description' => 'Pay with cash upon delivery.',
                'bank_transfer_label' => 'Bank Transfer',
                'bank_transfer_description' => 'Make your payment directly into our bank account. Please use your Order ID as the payment reference.',
                'check_payment_label' => 'Check / Money Order',
                'check_payment_description' => 'Please send a check to our store.',
            ],

            // storefront
            'storefront_copyright_text' => 'Copyright © <a href="{{ store_url }}">{{ store_name }}</a> {{ year }}. All rights reserved.',
            'storefront_feature_1_icon' => 'fa fa-truck',
            'storefront_feature_1_title' => 'Free Delivery',
            'storefront_feature_1_subtitle' => 'Orders over $60',
            'storefront_feature_2_icon' => 'fa fa-commenting-o',
            'storefront_feature_2_title' => '99% Customer',
            'storefront_feature_2_subtitle' => 'Feedbacks',
            'storefront_feature_3_icon' => 'fa fa-credit-card',
            'storefront_feature_3_title' => 'Payment',
            'storefront_feature_3_subtitle' => 'Secured system',
            'storefront_feature_4_icon' => 'fa fa-headphones',
            'storefront_feature_4_title' => '24/7 Support',
            'storefront_feature_4_subtitle' => 'Helpline - 121',
            'storefront_recently_viewed_section_enabled' => true,
            'storefront_recently_viewed_section_title' => 'Recently Viewed',
            'storefront_recently_viewed_section_total_products' => 5,
        ]);
    }
}
