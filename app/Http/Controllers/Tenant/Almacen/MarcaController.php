<?php

namespace App\Http\Controllers\Tenant\Almacen;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Tenant\Almacenes\Marca;
use App\Http\Requests\Tenant\MarcaRequest;

class MarcaController extends Controller
{
    public function index(){
        return Inertia::render("Tenant/Almacen/Marca/MarcaIndex",[
            'marcas'=>Inertia::lazy(fn()=> $this->Lista())
        ]);
    }
    private function Lista(){
        $marca = Marca::where("estado","ACTIVO")->orderBy("id","DESC")->get();
        return $marca;
    }
    public function store(MarcaRequest $request){
        try{
            $marca = new Marca();
            $marca->nombre = $request->get("nombre");
            $marca->procedencia = $request->get("procedencia");
            $marca->estado ="ACTIVO";
            $marca->save();

            return new JsonResponse([
                "success" => true,
                "message" => "¡Marca registrada.!",
            ]);
        }catch(\Exception $ex){
            return new JsonResponse([
                "success" => false,
                "message" => $ex->getMessage(),
            ]);
        }
    }
    public function update(MarcaRequest $request,Marca $marca){
        try{
            $marca->nombre = $request->get("nombre");
            $marca->update();
            return new JsonResponse([
                "success" => true,
                "message" => "¡Marca actualizada.!",
            ]);
        }catch(\Exception $ex){
            return new JsonResponse([
                "success" => false,
                "message" => $ex->getMessage(),
            ]);
        }
    }
    public function delete($id){
        try{
            $marca = Marca::findOrFail($id);
            $marca->estado ="ANULADO";
            $marca->update();
            return redirect()->back()->with("success","¡Marca anulada.!");
        }catch(\Exception $ex){
            return redirect()->back()->with("error",$ex->getMessage());
        }
    }
}