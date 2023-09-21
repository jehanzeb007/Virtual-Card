<?php

namespace Modules\Account\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Order\Entities\Order;

class AccountDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $my = auth()->user();
        $recentOrders = auth()->user()->recentOrders(5);


        $total_orders = Order::where('customer_id','=',$my->id)->count();
        $completed_orders = Order::where('customer_id','=',$my->id)->where('status','=','completed')->count();
        $total_pay = Order::where('customer_id','=',$my->id)->sum('total');
        $total_discount = Order::where('customer_id','=',$my->id)->sum('discount');

        return view('public.account.dashboard.index', compact('my', 'recentOrders','total_orders','completed_orders','total_pay','total_discount'));
    }
}
