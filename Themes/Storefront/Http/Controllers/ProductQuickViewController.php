<?php

namespace Themes\Storefront\Http\Controllers;

use function GuzzleHttp\uri_template;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Product;

class ProductQuickViewController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::findBySlug($slug);

        if (setting('reviews_enabled')) {
            $product->load('reviews:product_id,rating');
        }

        return view('public.products.quick_view.show', compact('product'));
    }
    function uploadCustomDesign(){
        $post = \request()->all();
        //debug($post,1);
        $rules = [
            'file'=>'required|image',
        ];
        $validation = \Validator::make( $post, $rules, []);
        if($validation->fails()){
            return '';
        }
        $file = $post['file'];
        $random = rand();
        $image = $random.'_'.time().'_product-custom-design.'.$file->getClientOriginalExtension();
        $path = base_path().DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'tmp';
        if(!is_dir($path)){
            mkdir($path,0777);
        }
        $file->move($path, $image);
        return url('tmp/'.$image);
    }
}
