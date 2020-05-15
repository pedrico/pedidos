<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function landing()
    {
        $categories = ProductCategory::all();
        return view('customer.landing', compact('categories'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function landing_products($catId)
    {
        $cat = ProductCategory::find($catId);
        $products = DB::table('products as p')
        ->join('products_product_categories as ppc', 'p.id', '=', 'ppc.product_id')
        ->where('ppc.product_category_id', $catId)
        ->get();
        return view('customer.landing_products', compact('products', 'cat'));
    }
}
