<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
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
        $title = 'Categorías de productos';
        $ruta = json_decode('[["Inicio", "/dashboard"],["Categorías", "/product_category"]]', true);
        $categories = ProductCategory::all();

        return view('product/category/index', compact('title', 'ruta', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Nueva categoría de productos';
        $ruta = json_decode('[["Inicio", "/dashboard"],["Categorías de productos", "/product_category"],["Nuevo", "/product_category/create"]]', true);

        return view('product/category/create', compact('title', 'ruta'));
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
        ]);
        $category = new ProductCategory();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->status = 1;
        $category->save();


        $title = 'Categorías de productos';
        $ruta = json_decode('[["Inicio", "/dashboard"],["Categorías de productos", "/product_category"],["Nuevo", "/product_category/create"]]', true);
        return view('product/upload_image', compact('title', 'ruta', 'category'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Categorías de productos';
        $ruta = json_decode('[["Inicio", "/dashboard"],["Categorías de productos", "/product_category"],["Nuevo", "/product_category/create"]]', true);
        $cat = ProductCategory::find($id);

        return view('product/category/edit', compact('title', 'ruta', 'cat'));
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
            'description' => 'required'
        ]);

        $cat = ProductCategory::find($id);
        $cat->name = $request->name;
        $cat->description = $request->description;
        $cat->save();
        return redirect()->route('product_category.index')->with('message', 'Datos actualizados.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        $itemName = ProductCategory::find($id)->name;
        ProductCategory::destroy($id);
        return back()->with('message', 'Se eliminó: ' . $itemName);
    }

    public function image(Request $r)
    {
        $file = $r->file('profileImg');
        $destinationPath = 'upload/product_category';
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
        imagejpeg($thumb, "upload/product_category/" . $filename . "." . $fileExtension);
        //-------------------------------------------

        if ($upload_success) {
            //Se crea el registro en la base de datos
            $profileImg = ProductCategory::find($r->cat_id);
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
        $category = ProductCategory::find($r->category_id);

        $title = 'Categorías de productos';
        $ruta = json_decode('[["Inicio", "/dashboard"],["Categorías de productos", "/product_category"],["Nuevo", "/product_category/create"]]', true);
        return view('product/upload_image', compact('title', 'ruta', 'category'));
    }

    public function status(Request $request, $id, $status)
    {
        $item = ProductCategory::find($id);
        $item->status = $status;        
        $item->save();
        $result = 'Cambio realizado';
        return response()->json(compact('result'));        
    }
}
