<?php

namespace App\Http\Controllers\Tenant\Almacen;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\AlmacenRequest;
use App\Models\Tenant\Almacenes\Almacen;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;

class AlmacenController extends Controller
{
    public function index()
    {
        return Inertia::render("Tenant/Almacen/Almacen/AlmacenIndex", [
            "almacenes" => Inertia::lazy(fn() => $this->Lista()),
        ]);
    }
    private function Lista()
    {
        $almacen = Almacen::where("estado", "ACTIVO")->orderBy("id", "DESC")->get();
        return $almacen;
    }
    public function store(AlmacenRequest $request)
    { //
        try {
            $almacen = new Almacen();
            $almacen->descripcion = $request->get('descripcion');
            $almacen->ubicacion = $request->get("ubicacion");
            $almacen->estado = "ACTIVO";
            $almacen->save();

            return new JsonResponse([
                "success" => true,
                "message" => "Almacen registrado correctamente.",
            ]);
        } catch (\Exception$ex) {
            return new JsonResponse([
                "success" => false,
                "message" => $ex->getMessage(),
            ]);
        }
    }
    public function update(AlmacenRequest $request)
    { //
        try {
            $almacen = Almacen::findOrFail($request->get("id"));
            $almacen->descripcion = $request->get('descripcion');
            $almacen->ubicacion = $request->get("ubicacion");
            $almacen->save();
            return new JsonResponse([
                "success" => true,
                "message" => "Almacen actualizado correctamente.",
            ]);

        } catch (\Exception$ex) {
            return new JsonResponse([
                "success" => false,
                "message" => $ex->getMessage(),
            ]);
        }
    }
    public function delete($id)
    { //
        try {
            $almacen = Almacen::findOrFail($id);
            $almacen->estado = "ANULADO";
            $almacen->save();

            return redirect()->back()->with("success", "Almacen anulado correctamente.");
        } catch (\Exception$ex) {
            return redirect()->back()->with("error", $ex->getMessage());
        }
    }
}
