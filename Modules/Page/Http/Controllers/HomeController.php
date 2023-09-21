<?php

namespace Modules\Page\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Product\Entities\Product;
use Modules\Slider\Entities\Slider;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $sliderTestimonial = Slider::whereId(2)->with('slides')->first();
        return view('public.home.index',['sliderTestimonial'=>$sliderTestimonial, 'products'=>$products]);
    }
}
