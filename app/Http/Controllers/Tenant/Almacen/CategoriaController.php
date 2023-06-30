<?php

namespace App\Http\Controllers\Tenant\Almacen;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Tenant\Almacenes\Categoria;
use App\Http\Requests\Tenant\CategoriaRequest;

class CategoriaController extends Controller
{
    public function index(){
        return Inertia::render("Tenant/Almacen/Categoria/CategoriaIndex",[
            'categorias'=>Inertia::lazy(fn()=>$this->Lista())
        ]);
    }
    private function Lista(){
        $categoria = Categoria::where("estado","ACTIVO")->orderBy("id","DESC")->get();
        return $categoria;
    }
    public function store(CategoriaRequest $request){
        try{
            $categoria = new Categoria();
            $categoria->descripcion = $request->get("descripcion");
            $categoria->estado ="ACTIVO";
            $categoria->save();
            return new JsonResponse([
                "success" => true,
                "message" => "¡Categoria registrada.!",
            ]);

        }catch(\Exception $ex){
            return new JsonResponse([
                "success" => false,
                "message" => $ex->getMessage(),
            ]);
        }
    }
    public function update(CategoriaRequest $request,Categoria $categoria){
        try{
            $categoria->descripcion = $request->get("descripcion");
            $categoria->update();
             return new JsonResponse([
                "success" => true,
                "message" => "¡Categoria actualizada.!",
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
            $categoria = Categoria::findOrFail($id);
            $categoria->estado ="ANULADO";
            $categoria->update();
            return redirect()->back()->with("success","¡Categoria anulada.!");
        }catch(\Exception $ex){
            return redirect()->back()->with("error",$ex->getMessage());
        }
    }
}