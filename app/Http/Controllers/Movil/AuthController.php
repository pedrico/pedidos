<?php

namespace App\Http\Controllers\Movil;

use App\Http\Controllers\Controller;
use App\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $llave = $request->llave;
        $pass = $request->pass;
        $rol = $request->rol;
        $bdPass = DB::table('users as u')
            ->join('roles_users as ru', 'ru.user_id', '=', 'u.id')
            ->join('roles as r', 'ru.rol_id', '=', 'r.id')            
            ->select('u.id', 'u.password', 'u.name', 'u.last_name', 'u.email')
            ->where('u.email', $llave)
            ->where('r.name', $rol)->first();
        if ($bdPass) {
            if (Hash::check($pass, $bdPass->password)) {
                //Credenciales correctas
                $phones = Phone::select('number')->where('user_id', $bdPass->id)->get();
                return response()->json([
                    'password' => '=)',
                    'state' => '1',
                    'id' => $bdPass->id,
                    'name' => $bdPass->name,
                    'lastname' => $bdPass->last_name,
                    'email' => $bdPass->email,
                    'phones' => $phones
                ]);
            } else {
                //Credenciales invalidas
                return response()->json([
                    'password' => '=(',
                    'state' => '0'
                ]);
            }
        }
        //Usuario no existe
        return response()->json([
            'password' => '=(',
            'state' => '2'
        ]);
    }
}
