<?php

namespace Modules\Cart\Http\Controllers;

use Modules\Coupon\Entities\Coupon;
use Modules\Support\Country;
use Modules\Cart\Facades\Cart;
use Illuminate\Routing\Controller;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->check()){
            $current_user_role = auth()->user()->hasRoleIds(['3']);
            if($current_user_role){
                $coupon_row = Coupon::find(1);

                Cart::applyCoupon($coupon_row);
            }
        }
        $cart = Cart::instance();
        $countries = Country::supported();

        return view('public.cart.index', compact('cart', 'countries'));
    }
}
