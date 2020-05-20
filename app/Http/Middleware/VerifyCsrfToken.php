<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'movil/login',
        'movil/bases',
        'movil/driver_base/order_assignment',
        'movil/driver_base/orders',
        'movil/driver_base/driver_base_orders',
        'movil/driver_base/base_moto_assign',
        'movil/driver_base/base_moto_list',
        'movil/driver_moto/order_assignment',
        'movil/driver_moto/orders',
        'movil/driver_moto/movimientos_arqui2',
        
        
        
    ];
}
