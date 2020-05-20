<?php

namespace App\Http\Controllers;

use App\Role;
use App\RolesUser;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
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
        $users = \App\User::all();
        $title = 'Usuarios';
        $ruta = json_decode('[["Inicio", "/dashboard"],["Usuarios", "/dashboard"]]', true);

        return view('user.index', compact('users', 'title', 'ruta'));
    }

    public function assign_role(Request $request, $userId)
    {
        $this->validate($request, [
            'rol' => 'required|string|min:5',           
        ]);

        $user = User::find($userId);
        $rol = Role::where('name', $request->rol)->first();
        if ($rol and ($rol->id == 3 or $rol->id == 4)) {
            $rol_user = new RolesUser();
            $rol_user->rol_id = $rol->id;
            $rol_user->user_id = $user->id;
            $rol_user->save();
    
            return back()->with('message', 'El usuario' . $user->name . ' ' . $user->last_name . ' ha sido asignado a  ' . $rol->name);    
        }
        return back()->with('message', 'No se ha podido realizar la acción.');
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
        //
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
}
