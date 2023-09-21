<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductCategories;
use Modules\Product\Entities\Categories;
use Modules\Product\Events\ProductViewed;
use Modules\Product\Filters\ProductFilter;
use Modules\Product\Events\ShowingProductList;
use Modules\Product\Http\Middleware\SetProductSortOption;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(SetProductSortOption::class)->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Modules\Product\Entities\Product $model
     * @param \Modules\Product\Filters\ProductFilter $productFilter
     * @return \Illuminate\Http\Response
     */
    public function index(Product $model, ProductFilter $productFilter)
    {
        $productIds = [];

        if (request()->has('query')) {
            $model = $model->search(request('query'));
            $productIds = $model->keys();
        }

        $query = $model->filter($productFilter);

        if (request()->has('category')) {
            $productIds = (clone $query)->select('id')->pluck('id');
        }

        $products = $query->paginate(request('perPage', 15))
            ->appends(request()->query());

        if (request()->wantsJson()) {
            return response()->json($products);
        }

        event(new ShowingProductList($products));

        return view('public.products.index', compact('products', 'productIds'));
    }

    /**
     * Show the specified resource.
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
		$categories=[];
        $product = Product::findBySlug($slug);
		$cats=ProductCategories::where('product_id','=',$product->id)->get()->toArray();
		foreach($cats as $cat)
		{
			$categories[]=Categories::where('id','=',$cat['category_id'])->first()->toArray();
		}
        $relatedProducts = $product->relatedProducts()->forCard()->get();
        $upSellProducts = $product->upSellProducts()->forCard()->get();
        $reviews = $this->getReviews($product);

        if (setting('reviews_enabled')) {
            $product->load('reviews:product_id,rating');
        }

        event(new ProductViewed($product));

        return view('public.products.show', compact('product', 'relatedProducts', 'upSellProducts', 'reviews','categories'));
    }

    /**
     * Get reviews for the given product.
     *
     * @param \Modules\Product\Entities\Product $product
     * @return \Illuminate\Support\Collection
     */
    private function getReviews($product)
    {
        if (! setting('reviews_enabled')) {
            return collect();
        }

        return $product->reviews()->paginate(15, ['*'], 'reviews');
    }
}
