<?php

namespace App\Http\Controllers;

use App\Base;
use App\User;
use App\UserBase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BaseDriverController extends Controller
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
        $users = DB::table('users as u')
            ->join('roles_users as ru', 'ru.user_id', '=', 'u.id')
            ->select('u.id', 'u.name', 'u.second_name', 'u.last_name', 'u.second_last_name', 'u.email')
            ->where('ru.rol_id', 3)
            ->get();
        $title = 'Drivers Base';
        $ruta = json_decode('[["Inicio", "/dashboard"],["Drivers Base", "/base_driver"]]', true);

        return view('base_driver.index', compact('users', 'title', 'ruta'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function base_assignment($id)
    {
        $title = 'Asignación de bases';
        $ruta = json_decode('[["Inicio", "/dashboard"],["Drivers Base", "/base_driver"], ["Asignación de bases", "/base_assignment/' . $id . '"]]', true);

        $user = User::find($id);
        $bases = DB::table('bases as b')
            ->leftjoin(DB::raw('(select id, user_id, base_id from user_bases where user_id = ' . $user->id . ') as ub'), 'b.id', '=', 'ub.base_id')
            ->select('b.id', 'b.name', 'b.address', 'ub.user_id')
            ->get();
        return view('base_driver.base_assignment', compact('bases', 'user', 'title', 'ruta'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function base_assign($userId, $baseId, $action)
    {
        if ($action) {
            $user_base = new UserBase();
            $user_base->user_id = $userId;
            $user_base->base_id = $baseId;
            $user_base->save();
            return back()->with('message', 'Base asignada.');
        } else if ($action == 0) {
            $user_base = UserBase::where('user_id', $userId)->where('base_id', $baseId)->first();
            $user_base->delete();
            return back()->with('message', 'Base desasignada.');
        }
    }
}
