<?php

namespace App\Http\Controllers\Tenant\Cajas;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MovimientoController extends Controller
{
    public function index(){
        return Inertia::render("Tenant/Cajas/Movimiento/MovimientoIndex");
    }
}
