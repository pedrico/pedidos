<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\ProfileImage;
use App\User;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function __construct()
    {
        // Se pasa como parametro el string admin al middleware roles, registrado en Kernel
        $this->middleware(['auth', 'roles:Cliente']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Perfil';
        $ruta = json_decode('[["Inicio", "/dashboard"],["Perfil", "/profile"]]', true);
        // dd(auth()->user()->addresses);

        return view('customer/profile', compact('title', 'ruta'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            'last_name' => 'required',
            'second_last_name' => 'required',
        ]);

        $user = User::find(auth()->user()->id);
        $user->name = $request->name;
        $user->second_name = $request->second_name;
        $user->last_name = $request->last_name;
        $user->second_last_name = $request->second_last_name;
        $user->save();
        return redirect()->route('profile.index')->with('message', 'Datos actualizados.');
    }

    public function map($lat, $long)
    {
        // return view('customer/map2');
        return view('customer/map', compact('lat', 'long'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function profile_image(Request $r)
    {
        $file = $r->file('profileImg');
        $destinationPath = 'upload';
        // If the uploads fail due to file system, you can try doing public_path().'/uploads' 
        $filename = Str::random(12);
        $fileExtension = $file->getClientOriginalExtension();
        $fileSize = $file->getSize();
        //$filename = $file->getClientOriginalName();
        //$extension =$file->getClientOriginalExtension(); 
        $upload_success = $file->move($destinationPath, $filename . "_original" . "." . $fileExtension);
        // $resize_image = imagecreatefromjpeg($file->getRealPath());

        //-------------------------------------------
        // Fichero y nuevo tamaño
        $nombre_fichero = $destinationPath . '/' .  $filename . "_original" . "." . $fileExtension;
        // dd($nombre_fichero);
        $porcentaje = 0.25;

        // Tipo de contenido
        //header('Content-Type: image/jpeg');

        // Obtener los nuevos tamaños
        list($ancho, $alto) = getimagesize($nombre_fichero);
        $nuevo_ancho = $ancho;
        $nuevo_alto = $ancho;

        // Cargar
        $thumb = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
        $origen = imagecreatefromjpeg($nombre_fichero);

        // Cambiar el tamaño
        // imagecopyresized($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
        imagecopy($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto);
        // Imprimir
        imagejpeg($thumb, "upload/" . $filename . "." . $fileExtension);


        //-------------------------------------------


        if ($upload_success) {
            //Se crea el registro en la base de datos
            $profileImg = new ProfileImage();
            $profileImg->name = $filename;
            $profileImg->extension = $fileExtension;
            $profileImg->size = $fileSize;
            $profileImg->user_id = auth()->user()->id;
            $profileImg->save();
            return response()->json('success', 200);
        } else {
            return response()->json('error', 400);
        }
    }
}
