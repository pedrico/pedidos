<?php

namespace App\Http\Controllers;

use App\Base;
use Illuminate\Http\Request;

class BaseController extends Controller
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
        $title = 'Bases de distribución';
        $ruta = json_decode('[["Inicio", "/dashboard"],["Bases", "/base"]]', true);
        $bases = Base::all();

        return view('base/index', compact('title', 'ruta', 'bases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Bases de distribución';
        $ruta = json_decode('[["Inicio", "/dashboard"],["Bases ", "/base"],["Nuevo", "/base/create"]]', true);

        return view('base/create', compact('title', 'ruta'));
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
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ]);
        $base = new Base();
        $base->name = $request->name;
        $base->address = $request->address;
        $base->lat = $request->lat;
        $base->lng = $request->lng;
        $base->status = 1;
        $base->save();

        return redirect()->route('base.index')->with('message', 'Nueva base creada.');
    }
    
     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Bases de distribución';
        $ruta = json_decode('[["Inicio", "/dashboard"],["Bases", "/base"],["Nuevo", "/base/edit"]]', true);
        $base = Base::find($id);

        return view('base/edit', compact('title', 'ruta', 'base'));
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
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ]);

        $base = Base::find($id);
        $base->name = $request->name;
        $base->address = $request->address;
        $base->lat = $request->lat;
        $base->lng = $request->lng;
        $base->save();

        return redirect()->route('base.index')->with('message', 'Datos actualizados.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        $itemName = Base::find($id)->name;
        Base::destroy($id);
        return back()->with('message', 'Se eliminó: ' . $itemName);
    }

    public function status(Request $request, $id, $status)
    {
        $item = Base::find($id);
        $item->status = $status;        
        $item->save();
        $result = 'Cambio realizado';
        return response()->json(compact('result'));        
    }
}
