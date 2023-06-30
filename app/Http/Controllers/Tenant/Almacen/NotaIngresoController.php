<?php

namespace App\Http\Controllers\Tenant\Almacen;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Tenant\Tabla;
use Illuminate\Support\Facades\DB;
use App\Models\Tenant\TablaDetalle;
use App\Http\Controllers\Controller;
use App\Models\Tenant\MotivoTraslado;
use Illuminate\Support\Facades\Request;
use App\Models\Tenant\Almacenes\Almacen;
use App\Http\Requests\NotaIngresoRequest;
use App\Models\Tenant\Almacenes\Producto;
use App\Models\Tenant\Almacenes\NotaIngreso\NotaIngreso;
use App\Models\Tenant\Almacenes\NotaIngreso\NotaIngresoDetalle;

class NotaIngresoController extends Controller
{

    public function index()
    {
        return Inertia::render("Tenant/Almacen/Notas/Ingreso/IngresoIndex", [
            "notaIngreso"=>Inertia::lazy(fn() => $this->Lista()),
            'filters'=>Request::only(['tamanio','search','page'])
        ]);
    }
    public function Lista(){
        $tamanio = Request::input('tamanio') ? Request::input('tamanio') : 5;
        $notaIngreso = NotaIngreso::where("estado", "ACTIVO")
        ->orderBy("id", "DESC")
        ->paginate($tamanio);
        return $notaIngreso;
    }
    public function create()
    {
        return Inertia::render("Tenant/Almacen/Notas/Ingreso/Partials/Create", [
            'consultas' => Inertia::lazy(fn() => $this->getTables()),
            'fecha' => now()->format("Y-m-d"),
        ]);
    }

    private function getTables()
    {
        $monedas = Tabla::find(1)->detalles->each(function ($detalle) {
            unset($detalle->id);
            unset($detalle->tabla_id);
            unset($detalle->nombre);
            unset($detalle->parametro);
            unset($detalle->operacion);
            unset($detalle->tipo);
            unset($detalle->editable);
            unset($detalle->estado);
            return $detalle;
        });
        
        $productos = Producto::where("estado", "ACTIVO")->get(['id', 'nombre'])->each(function ($producto) {
            unset($producto->marca);
            unset($producto->categoria);
            unset($producto->almacen);
            return $producto;
        });
        $almacenes = Almacen::where("estado",'ACTIVO')
        ->where('descripcion',"<>",'MERMAS')
        ->get(["id",'descripcion']);

        $motivoTraslado = MotivoTraslado::where("tipo","INGRESO")
        ->get(['id','nombre','codigo']);
        return compact("monedas",'productos','motivoTraslado','almacenes');
    }

    public function store(NotaIngresoRequest $request)
    {
        try {
            DB::beginTransaction();
            $fecha_hoy = Carbon::now()->toDateString();
            $fecha = Carbon::createFromFormat('Y-m-d', $fecha_hoy);
            $fecha = str_replace("-", "", $fecha);
            $fecha = str_replace(" ", "", $fecha);
            $fecha = str_replace(":", "", $fecha);

            $dolar_aux = json_encode(precio_dolar(), true);
            $dolar_aux = json_decode($dolar_aux, true);
            $dolar = (float) $dolar_aux['original']['venta'];

            $notaIngreso = new NotaIngreso();
            $notaIngreso->user_id = Auth()->user()->id;
            $notaIngreso->motivo_traslado_id = $request->get("origen");
            $notaIngreso->numero = $fecha . (NotaIngreso::all()->count() + 1);
            $notaIngreso->fecha = $request->get('fecha');
            $notaIngreso->destino = Almacen::find($request->get("destino"))->descripcion;
            $notaIngreso->origen = MotivoTraslado::find($request->get("origen"))->codigo;
            $notaIngreso->moneda = $request->get("moneda");
            $notaIngreso->tipo_cambio = $dolar;
            $notaIngreso->total = $request->get("total");
            $notaIngreso->dolar = $dolar;
            $notaIngreso->observacion = $request->get("observacion");
            $total = (float) $request->get("total");
            if ($request->get('moneda') == "DOLARES") {
                $notaIngreso->total_soles = $total * $dolar;
                $notaIngreso->total_dolares = $total;
            } else {
                $notaIngreso->total_dolares = $total / $dolar;
                $notaIngreso->total_soles = $total;
            }
            $notaIngreso->save();

            $detalles = $request->get("detalles");
            foreach ($detalles as $fila) {

                $costo_soles=0;
                $costo_dolares=0;
                if ($request->get('moneda') == 'DOLARES') {

                    $costo_soles = (float)$fila["costo"] * (float)$dolar;
                    $costo_dolares = (float)$fila["costo"];

                } else {

                    $costo_soles = (float)$fila["costo"];
                    $costo_dolares = (float)$fila["costo"] / (float)$dolar;

                }

                $detalleIngreso = new NotaIngresoDetalle();
                $detalleIngreso->nota_ingreso_id = $notaIngreso->id;
                $detalleIngreso->producto_id = $fila["producto_id"];
                $detalleIngreso->cantidad = $fila["cantidad"];
                $detalleIngreso->costo = $fila["costo"];
                $detalleIngreso->costo_soles = $costo_soles;
                $detalleIngreso->costo_dolares = $costo_dolares;
                $detalleIngreso->valor_ingreso = $fila["total"];
                $detalleIngreso->save();
            }
            DB::commit();
            return redirect()->route("tenant.almacen.notaingreso.index")->with("success","Nota de ingreso registrada.");
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with("error", $ex->getMessage());
        }
    }

    public function show($id)
    {
        //
    }

    public function edit(NotaIngreso $nota)
    {
        return Inertia::render("Tenant/Almacen/Notas/Ingreso/Partials/Edit", [
            'nota'=> $nota,
            'consultas' => Inertia::lazy(fn() => $this->getTables()),
            'fecha' => now()->format("Y-m-d"),
        ]);
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
