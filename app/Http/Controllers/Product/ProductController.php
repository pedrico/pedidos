<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\MeasurementUnit;
use App\Product;
use App\ProductCategory;
use App\ProductProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct()
    {
        // Se pasa como parametro el string admin al middleware roles, registrado en Kernel
        $this->middleware(['auth', 'roles:Admin,Supervisor']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Productos';
        $ruta = json_decode('[["Inicio", "/dashboard"],["Productos", "/product"]]', true);
        $products = DB::table('products as p')
            ->select('p.id', 'p.name', 'p.description', 'mu.unit', 'p.price', 'p.image_name', 'p.status')
            ->join('measurement_units as mu', 'mu.id', '=', 'p.measurement_unit_id')
            ->get();

        return view('product/product/index', compact('title', 'ruta', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Nuevo producto';
        $ruta = json_decode('[["Inicio", "/dashboard"],["Productos", "/product"],["Nuevo", "/product/create"]]', true);
        $measurement_units = MeasurementUnit::all();

        return view('product/product/create', compact('title', 'ruta', 'measurement_units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'measurement_unit_id' => 'required',
            'price' => 'required',
        ]);
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->measurement_unit_id = $request->measurement_unit_id;
        $product->price = $request->price;
        $product->status = 1;
        $product->save();


        $title = 'Productos';
        $ruta = json_decode('[["Inicio", "/dashboard"],["Productos", "/product"],["Nuevo", "/product/create"]]', true);
        return view('product/product/upload_image', compact('title', 'ruta', 'product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Productos';
        $ruta = json_decode('[["Inicio", "/dashboard"],["Productos", "/product"],["Editar", "/product/edit"]]', true);
        $prod = Product::find($id);
        $measurement_units = MeasurementUnit::all();

        return view('product/product/edit', compact('title', 'ruta', 'prod', 'measurement_units'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'measurement_unit_id' => 'required',
            'price' => 'required',
        ]);

        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->measurement_unit_id = $request->measurement_unit_id;
        $product->price = $request->price;
        $product->save();
        return redirect()->route('product.index')->with('message', 'Datos actualizados.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $itemName = Product::find($id)->name;
        Product::destroy($id);
        return back()->with('message', 'Se eliminó: ' . $itemName);
    }

    public function image(Request $r)
    {
        $file = $r->file('profileImg');
        $destinationPath = 'upload/product';
        // If the uploads fail due to file system, you can try doing public_path().'/uploads' 
        $filename = Str::random(12);
        $fileExtension = $file->getClientOriginalExtension();
        $fileSize = $file->getSize();
        $upload_success = $file->move($destinationPath, $filename . "_original" . "." . $fileExtension);

        //-------------------------------------------
        // Fichero y nuevo tamaño
        $nombre_fichero = $destinationPath . '/' .  $filename . "_original" . "." . $fileExtension;
        $porcentaje = 0.25;

        // Tipo de contenido
        //header('Content-Type: image/jpeg');

        // Obtener los nuevos tamaños
        list($ancho, $alto) = getimagesize($nombre_fichero);
        $nuevo_ancho = $ancho;
        $nuevo_alto = $alto;

        // Cargar
        $thumb = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
        $origen = imagecreatefromjpeg($nombre_fichero);

        // Cambiar el tamaño
        // imagecopyresized($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
        imagecopy($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto);
        // Imprimir
        imagejpeg($thumb, "upload/product/" . $filename . "." . $fileExtension);
        //-------------------------------------------

        if ($upload_success) {
            //Se crea el registro en la base de datos
            $profileImg = Product::find($r->prod_id);
            $profileImg->image_name = $filename;
            $profileImg->image_extension = $fileExtension;
            $profileImg->image_size = $fileSize;
            $profileImg->save();
            return response()->json('success', 200);
        } else {
            return response()->json('error', 400);
        }
    }

    public function update_image(Request $r)
    {
        $product = Product::find($r->product_id);

        $title = 'Productos';
        $ruta = json_decode('[["Inicio", "/dashboard"],["Productos", "/product"],["Nuevo", "/product/create"]]', true);
        return view('product/product/upload_image', compact('title', 'ruta', 'product'));
    }

    public function status(Request $request, $id, $status)
    {
        $item = Product::find($id);
        $item->status = $status;
        $item->save();
        $result = 'Cambio realizado';
        return response()->json(compact('result'));
    }

    public function product_category_assignment($productId)
    {
        $title = 'Productos';
        $ruta = json_decode('[["Inicio", "/dashboard"],["Productos", "/product"],["Asociar Categorías", "/product_asociation_category/' . $productId . '"]]', true);
        $categories = DB::table('product_categories as b')
            ->leftjoin(DB::raw('(select id, product_id, product_category_id from products_product_categories where product_id = ' . $productId . ') as ub'), 'b.id', '=', 'ub.product_category_id')
            ->select('b.id', 'b.name', 'b.description', 'ub.product_id')
            ->get();
        $product = Product::find($productId);

        return view('product/product/asociation_category', compact('title', 'ruta', 'categories', 'product'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function product_category_assign($productId, $categoryId, $action)
    {
        if ($action) {
            $ppc = new ProductProductCategory();
            $ppc->product_id = $productId;
            $ppc->product_category_id = $categoryId;
            $ppc->save();
            return back()->with('message', 'Categoría asignada.');
        } else if ($action == 0) {
            $ppc = ProductProductCategory::where('product_id', $productId)->where('category_id', $categoryId)->first();
            $ppc->delete();
            return back()->with('message', 'Categoría desasignada.');
        }
    }
}
