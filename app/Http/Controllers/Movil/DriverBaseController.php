<?php

namespace App\Http\Controllers\Movil;

use App\Base;
use App\DvbaseDvmoto;
use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DriverBaseController extends Controller
{
    public function bases(Request $request)
    {
        $userId = $request->userId;
        $user = User::find($userId);

        if ($user and $user->hasRoles(['Driver Base'])) {
            $bases = DB::table('bases as b')
                ->join('user_bases as ub', 'ub.base_id', '=', 'b.id')
                ->select('b.id', 'b.name', 'b.address', 'b.lat', 'b.lng')
                ->where('ub.user_id', $userId)
                ->get();

            return response()->json([
                'bases' => $bases
            ]);
        }
        //Si el usuario no es driver base o no existe
        return response()->json([
            'error' => '1'
        ]);
    }

    public function order_assignment(Request $request)
    {
        $orderId = $request->orderId;
        $driverId = $request->driverId;
        $user = User::find($driverId);

        if ($user and $user->hasRoles(['Driver Base'])) {
            $order  = Order::find($orderId);
            if ($order) {
                if (!$order->driver_id) {
                    //Se valida que la orden no este asignada a ningun driver base
                    $order->driver_id = $driverId;
                    $order->status = 2; //Asignado a driver
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
                'mensaje' => 'No se encuentra la orden.'
            ]);
        }
        //Si el usuario no es driver base o no existe
        return response()->json([
            'error' => '1',
            'mensaje' => 'No se encuentra el driver.'
        ]);
    }

    //Listado de ordenes asignadas a un driver base
    public function orders(Request $request)
    {
        $driverId = $request->driverId;
        $user = User::find($driverId);

        if ($user and $user->hasRoles(['Driver Base'])) {
            $orders = DB::table('orders as o')
                ->join('users as u', 'u.id', '=', 'o.user_id')
                ->join('addresses as a', 'a.id', '=', 'o.address_id')
                ->select('o.id', 'o.correlative', 'o.recipient_alternative_name', 'a.address', 'u.name', 'u.last_name', 'u.second_last_name', 'o.delivery_date', 'o.delivery_time', 'o.status', 'o.base_id')
                ->where('o.driver_id', $user->id)
                ->orWhere(function ($query) {
                    $query->where('status', 2)
                        ->where('status', 3);
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

    //Listado de ordenes asignadas a un Driver Y en una Base X
    public function driver_base_orders(Request $request)
    {
        $driverId = $request->driverId;
        $user = User::find($driverId);

        $baseId = $request->baseId;
        $base = Base::find($baseId);

        if ($user and $user->hasRoles(['Driver Base'])) {
            if ($base) {
                $orders = DB::table('orders as o')
                    ->join('users as u', 'u.id', '=', 'o.user_id')
                    ->join('addresses as a', 'a.id', '=', 'o.address_id')
                    ->select('o.id', 'o.correlative', 'o.recipient_alternative_name', 'a.address', 'u.name', 'u.last_name', 'u.second_last_name', 'o.delivery_date', 'o.delivery_time', 'o.status', 'o.base_id')
                    ->where('o.driver_id', $user->id)
                    ->where('o.base_id', $base->id)
                    ->orWhere(function ($query) {
                        $query->where('status', 2)
                            ->where('status', 3);
                    })
                    ->get();
                return response()->json([
                    'error' => '0',
                    'orders' => $orders,
                ]);
            }
            return response()->json([
                'error' => '1',
                'mensaje' => 'No se encuentra la base.'
            ]);
        }
        //Si el usuario no es driver base o no existe
        return response()->json([
            'error' => '1',
            'mensaje' => 'No se encuentra el driver.'
        ]);
    }

    //Asignación diaria de motos a drivers base
    public function base_moto_assign(Request $request)
    {
        $dvBaseId = $request->dvBaseId;
        $dvBase = User::find($dvBaseId);

        $dvMotoId = $request->dvMotoId;
        $dvMoto = User::find($dvMotoId);

        if ($dvBase and $dvBase->hasRoles(['Driver Base'])) {
            if ($dvMoto and $dvMoto->hasRoles(['Driver Moto'])) {
                $dvbase_dvmoto = DvbaseDvmoto::where('dvBase_id', $dvBaseId)
                    ->where('dvMoto_id', $dvMotoId)
                    ->whereDate('created_at', Carbon::today())
                    ->first();
                if (!$dvbase_dvmoto) {
                    $dvbase_dvmoto = new DvbaseDvmoto();
                    $dvbase_dvmoto->dvBase_id = $dvBaseId;
                    $dvbase_dvmoto->dvMoto_id = $dvMotoId;
                    $dvbase_dvmoto->save();
                    $mensaje = 'El motorista ' . $dvMoto->name . ' ' . $dvMoto->last_name . ' ha sido asignado a ' . $dvBase->name . ' ' . $dvBase->last_name;

                    return response()->json([
                        'error' => '0',
                        'mensaje' => $mensaje
                    ]);
                }
                return response()->json([
                    'error' => '1',
                    'mensaje' => 'Hoy el motorista ya está asignado a otro driver.'
                ]);
            }
            return response()->json([
                'error' => '1',
                'mensaje' => 'No se encuentra el driver Moto.'
            ]);
        }
        //Si el usuario no es driver base o no existe
        return response()->json([
            'error' => '1',
            'mensaje' => 'No se encuentra el driver Base.'
        ]);
    }

    //Lista diaria de motos asignadas a driver base
    public function base_moto_list(Request $request)
    {
        $dvBaseId = $request->dvBaseId;
        $dvBase = User::find($dvBaseId);
        if ($dvBase and $dvBase->hasRoles(['Driver Base'])) {
            $dvMotos = DB::table('users as dvBase')
                ->join('dvbases_dvmotos as dvs', 'dvBase.id', '=', 'dvs.dvBase_id')
                ->join('users as  dvMoto', 'dvMoto.id', '=', 'dvs.dvMoto_id')
                ->join('roles_users as ru', 'ru.user_id', '=', 'dvMoto.id')
                ->join('roles as r', 'ru.rol_id', '=', 'r.id')  
                ->select('dvMoto.id', 'dvMoto.name', 'dvMoto.second_name', 'dvMoto.last_name', 'dvMoto.second_last_name',  DB::raw("concat(r.prefix, '-', \"dvMoto\".id) as correlative"))
                ->whereDate('dvs.created_at', Carbon::today())
                ->get();
            return response()->json([
                'error' => '0',
                'dvMotos' => $dvMotos
            ]);
        }
        //Si el usuario no es driver base o no existe
        return response()->json([
            'error' => '1',
            'mensaje' => 'No se encuentra el driver Base.'
        ]);
    }
}
