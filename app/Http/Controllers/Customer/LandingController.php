<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderDetail;
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
            ->join('product_categories as pc', 'ppc.product_category_id', '=', 'pc.id')
            ->join('measurement_units as u', 'p.measurement_unit_id', '=', 'u.id')
            ->select('p.id', 'p.name', 'p.description', 'p.price', 'p.image_name', 'p.image_extension', 'u.unit', 'pc.name as category')
            ->where('ppc.product_category_id', $catId)
            ->get();
        return view('customer.landing_products', compact('products', 'cat'));
    }

    public function add_cart_product(Request $request)
    {
        if (auth()->user()) {
            $productId = $request->product_id;
            $product = Product::find($productId);
            $quantity = $request->quantity;
            $order = DB::table('orders as o')
                ->where('user_id', auth()->user()->id)
                ->where('status', 1)
                ->orderBy('id', 'desc')
                ->first();

            //Hay una orden abierta a la que se agregará el producto seleccionado
            if ($order) {
                $orderDetail = new OrderDetail();
                $orderDetail->product_id = $product->id;
                $orderDetail->order_id = $order->id;
                $orderDetail->price = $product->price;
                $orderDetail->quantity = $quantity;
                $orderDetail->save();
            } else {
                //No hay pedido abierto, se realizará uno nuevo.
                $order = new Order();
                $order->correlative = "P";
                $order->user_id = auth()->user()->id;
                $order->address_id = 1;
                $order->status = 1; //Pedido abierto
                $order->save();
                $order->correlative  = 'P-' . $order->id;
                $order->save();

                //Se agrega el producto
                $orderDetail = new OrderDetail();
                $orderDetail->product_id = $product->id;
                $orderDetail->order_id = $order->id;
                $orderDetail->price = $product->price;
                $orderDetail->quantity = $quantity;
                $orderDetail->save();
            }
            $result = 'Se agregó: ' . '<b>' . $quantity . ' ' . $product->name . '(s)' . ' a tu orden.';
            return response()->json(compact('result'));
        } else {
            return redirect()->route('login');
        }
    }

    function haversineGreatCircleDistance(
        $latitudeFrom,
        $longitudeFrom,
        $latitudeTo,
        $longitudeTo,
        $earthRadius = 6371000
    ) {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }

    public function checkout()
    {
        if (auth()->user()) {
            $order = DB::table('orders as o')
                ->where('user_id', auth()->user()->id)
                ->where('status', 1)
                ->orderBy('id', 'desc')
                ->first();
            $products = DB::table('order_details as od')
                ->join('products as p', 'p.id', '=', 'od.product_id')
                ->join('measurement_units as mu', 'p.measurement_unit_id', '=', 'mu.id')
                ->select('od.id', 'od.price', 'od.quantity', 'p.name', 'p.description', 'mu.unit')
                ->where('od.order_id', $order->id)
                ->get();

            $quantity = DB::table('order_details as od')
                ->select(DB::raw('sum(od.quantity) as quantity'))
                ->where('od.order_id', $order->id)
                ->groupBy(('od.order_id'))
                ->first();

            $total = DB::table('order_details as od')
                ->select(DB::raw('sum(od.quantity * od.price) as total'))
                ->where('od.order_id', $order->id)
                ->groupBy(('od.order_id'))
                ->first();

            return view('customer.checkout', compact('products', 'quantity', 'total'));
        } else {
            return redirect()->route('login');
        }
    }
}
