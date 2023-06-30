<?php

namespace App\Http\Controllers\Tenant\Almacen;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use App\Models\Tenant\Almacenes\NotaSalida\NotaSalida;

class NotaSalidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render("Tenant/Almacen/Notas/Salida/SalidaIndex",[
            "notaSalida"=>Inertia::lazy(fn() => $this->Lista()),
            'filters'=>Request::only(['tamanio','search','page'])
        ]);
    }
    private function Lista(){
        $tamanio = Request::input('tamanio') ? Request::input('tamanio') : 5;
        $notaSalida = NotaSalida::where("estado","ACTIVO")
        ->orderBy("id", "DESC")
        ->paginate($tamanio);
        return $notaSalida;
    }

   
    public function create()
    {
        return Inertia::render("Tenant/Almacen/Notas/Salida/Partials/Create");
    }

   
    public function store(Request $request)
    {
        //
    }

   
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
