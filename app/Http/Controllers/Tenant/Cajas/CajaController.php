<?php

namespace App\Http\Controllers\Tenant\Cajas;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Tenant\Caja\Caja;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\CajaRequest;

class CajaController extends Controller
{
    public function index(){
        return Inertia::render("Tenant/Cajas/Caja/CajaIndex",[
            'cajas'=>Inertia::lazy(fn()=>$this->Lista())
        ]);
    }
    private function Lista(){
        $caja = Caja::where('estado',"ACTIVA")->get(["id","nombre",'estado',DB::raw('DATE_FORMAT(created_at,"%d/%m/%Y %T %p") as fechaCreacion')]);
        return $caja;
    }
    public function store(CajaRequest $request){
        try{
            $caja = new Caja();
            $caja->nombre = $request->get("nombre");
            $caja->save();
            return redirect()->back()->with("success",'Caja registrada correctamente.');
        }catch(\Exception $ex){
            return redirect()->back()->with("error",$ex->getMessage());
        }
    }

    public function update(CajaRequest $request){
        try{
            $caja = Caja::findOrFail($request->get("id"));
            $caja->nombre = $request->get("nombre");
            $caja->update();
            return redirect()->back()->with("success",'Caja actualizada correctamente.');
        }catch(\Exception $ex){
            return redirect()->back()->with("error",$ex->getMessage());
        }
    }

    public function delete(CajaRequest $request){
        try{
            $caja = Caja::findOrFail($request->get("id"));
            $caja->estado = "ANULADA";
            $caja->update();
            return redirect()->back()->with("success",'Caja anulada correctamente.');
        }catch(\Exception $ex){
            return redirect()->back()->with("error",$ex->getMessage());
        }
    }
}
