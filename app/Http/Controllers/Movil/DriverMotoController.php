<?php

namespace App\Http\Controllers\Movil;

use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DriverMotoController extends Controller
{
    //Asignación de orden a driver Moto
    public function order_assignment(Request $request)
    {
        $orderId = $request->orderId;
        $driverId = $request->driverId;
        $user = User::find($driverId);

        if ($user and $user->hasRoles(['Driver Moto'])) {
            $order  = Order::find($orderId);
            if ($order) {
                //Se valida que la orden ha sido asignada a un driver Base previamente. 
                if ($order->dvBase_id) {
                    if (!$order->dvMoto_id) {
                        //Se valida que la orden no este asignada a ningun driver moto
                        $order->dvMoto_id = $driverId;
                        $order->status = 6; //Asignado a driver moto
                        $order->save();
                        return response()->json([
                            'error' => '0',
                            'mensaje' => 'asignado'
                        ]);
                    }
                    return response()->json([
                        'error' => '1',
                        'mensaje' => 'El pedido ya se encuentra asignado.'
                    ]);
                }
                return response()->json([
                    'error' => '1',
                    'mensaje' => 'El pedido no ha sido asignado a un driver Base.'
                ]);
            }
            return response()->json([
                'error' => '1',
                'mensaje' => 'No se encuentra la orden.'
            ]);
        }
        //Si el usuario no es driver moto o no existe
        return response()->json([
            'error' => '1',
            'mensaje' => 'No se encuentra el driver.'
        ]);
    }

    //Listado de ordenes asignadas a un driver moto
    public function orders(Request $request)
    {
        $driverId = $request->driverId;
        $user = User::find($driverId);
        if ($user and $user->hasRoles(['Driver Moto'])) {
            $orders = DB::table('orders as o')
                ->join('users as u', 'u.id', '=', 'o.user_id')
                ->join('addresses as a', 'a.id', '=', 'o.address_id')
                ->select('o.id', 'o.correlative', 'o.recipient_alternative_name', 'a.address', 'u.name', 'u.last_name', 'u.second_last_name', 'o.delivery_date', 'o.delivery_time', 'o.status', 'a.indications', 'a.lat', 'a.lng')
                ->where('o.dvMoto_id', $user->id)
                ->orWhere(function ($query) {
                    $query->where('status', 5)
                        ->where('status', 6);
                })
                ->get();
            return response()->json([
                'error' => '0',
                'orders' => $orders,
            ]);
        }
        //Si el usuario no es driver base o no existe
        return response()->json([
            'error' => '1',
            'mensaje' => 'No se encuentra el driver.'
        ]);
    }

    public function movimientos_arqui2(){
        return response()->json([
            'mensaje' => 'movimiento'
        ]);
    }

    public function movimientos_arqui2_pagina(){
        return view('customer.movimientos_arqui2');
    }
}
