<?php

namespace App\Http\Controllers\Tenant\Almacen;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Tenant\Almacenes\Servicio;
use App\Http\Requests\Tenant\ServicioRequest;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render("Tenant/Almacen/Servicio/ServicioIndex",[
            "servicios"=>Inertia::lazy(fn() => $this->Lista())
        ]);
    }
    private function Lista(){
        $servicio = Servicio::where("estado","ACTIVO")->orderBy("id", "DESC")->get();
        return $servicio;
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
     * @param  \App\Http\Requests\Tenant\ServicioRequest;  $request
     * @return \App\Http\Requests\Tenant\ServicioRequest;
     */
    public function store(ServicioRequest $request)
    {
        try{
            $servicio = new Servicio();
            $servicio->nombre = $request->get("nombre");
            $servicio->precio = $request->get("precio");
            $servicio->estado_alquiler = $request->get("estado_alquiler");
            $servicio->estado ="ACTIVO";
            $servicio->save();
            return new JsonResponse([
                "success"=>true,
                "message"=> "Servicio agregado correctamente.",
                "servicio"=> $servicio
            ]);

        }catch(\Exception $ex){
            return new JsonResponse([
                "success"=>false,
                "message"=> $ex->getMessage(),
            ]);
        }
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
    public function update(ServicioRequest $request, Servicio $servicio)
    {
        try{
            
            $servicio->nombre = $request->get("nombre");
            $servicio->precio = $request->get("precio");
            $servicio->estado_alquiler = $request->get("estado_alquiler");
            $servicio->update();
            return new JsonResponse([
                "success"=>true,
                "message"=> "Servicio actualizado correctamente.",
            ]);

        }catch(\Exception $ex){
            return new JsonResponse([
                "success"=>false,
                "message"=> $ex->getMessage(),
            ]);
        }
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
