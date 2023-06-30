<?php

namespace App\Http\Controllers\Tenant\Almacen;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Tenant\Almacenes\Marca;
use Illuminate\Support\Facades\Request;
use App\Models\Tenant\Almacenes\Almacen;
use App\Models\Tenant\Almacenes\Producto;
use App\Models\Tenant\Almacenes\Categoria;
use Illuminate\Http\Request as RequestAlias;
use App\Http\Requests\Tenant\ProductoRequest;

class ProductoController extends Controller
{
    public function index()
    {
        return Inertia::render('Tenant/Almacen/Producto/ProductoIndex', [
            'productos' => Inertia::lazy(fn() => $this->Lista()),
            'filters'=>Request::only(['tamanio','search','page'])
        ]);
    }
    private function Lista()
    {
        $tamanio = Request::input('tamanio') ? Request::input('tamanio') : 10;
        $producto = Producto::where('estado', 'ACTIVO')
            ->when(Request::input('search'), function ($query, $search) {
                $query->where("nombre", "LIKE", "%$search%")
                    ->OrWhere("codigo_barra", "LIKE", "%$search%");
            })
            ->orderBy("id", "DESC")
            ->paginate($tamanio);
        $productos = $producto->each(function ($prod) {
            $prod->_almacen = $prod->almacen->descripcion;
            $prod->_categoria = $prod->categoria->descripcion;
            $prod->_marca = $prod->marca->nombre;
            $prod->tiene_igv = $prod->tiene_igv == 1 ? true : false;
            $prod->updateIgv = false;
            unset($prod->almacen);
            unset($prod->categoria);
            unset($prod->marca);
            return $prod;
        });
        return $producto;
    }
    public function create()
    {
        return Inertia::render("Tenant/Almacen/Producto/Partials/CreateEdit", [
            'getTables' => Inertia::lazy(fn() => $this->getTables()),
        ]);
    }
    public function edit($id)
    {
        if (!Producto::find($id)) {
            return redirect()->route('tenant.almacen.productos.index')->with("error", "El producto con el id N°$id no existe.");
        }

        return Inertia::render("Tenant/Almacen/Producto/Partials/CreateEdit", [
            'producto' => Producto::find($id),
            'getTables' => Inertia::lazy(fn() => $this->getTables()),
        ]);
    }
    public function store(ProductoRequest $request)
    {
        try {
            $producto = new Producto();
            $producto->almacen_id = $request->get("almacen_id");
            $producto->categoria_id = $request->get("categoria_id");
            $producto->marca_id = $request->get("marca_id");
            $producto->nombre = $request->get("nombre");
            $producto->descripcion = $request->get("descripcion");
            $producto->codigo_barra = $request->get("codigo_barra");
            $producto->precio_venta = $request->get("precio_venta");
            $producto->precio_compra = $request->get("precio_compra");
            $producto->stock = $request->get("stock");
            $producto->stock_minimo = $request->get("stock_minimo");
            $producto->unidad_medida = $request->get("unidad_medida");
            $producto->estado = $request->get("estado");
            $producto->tiene_igv = $request->get("tieneIgv");
            $producto->save();
            if ($request->get('registrando')) {
                return redirect()->back()->with("success", "Producto registrado correctamente");
            }else{
                return redirect()->route("tenant.almacen.productos.index")->with("success", "Producto registrado correctamente");
            }
            
        } catch (\Exception $ex) {
            return redirect()->back()->with("error", $ex->getMessage());
        }

    }
    public function update(ProductoRequest $request, Producto $producto)
    {
        try {

            $producto->almacen_id = $request->get("almacen_id");
            $producto->categoria_id = $request->get("categoria_id");
            $producto->marca_id = $request->get("marca_id");
            $producto->nombre = $request->get("nombre");
            $producto->descripcion = $request->get("descripcion");
            $producto->codigo_barra = $request->get("codigo_barra");
            $producto->precio_venta = $request->get("precio_venta");
            $producto->precio_compra = $request->get("precio_compra");
            $producto->stock_minimo = $request->get("stock_minimo");
            $producto->unidad_medida = $request->get("unidad_medida");
            $producto->tiene_igv = $request->get("tieneIgv");
            $producto->update();
            return redirect()->route("tenant.almacen.productos.index")->with("success", "Producto actualizado correctamente");
        } catch (\Exception$ex) {
            return redirect()->back()->with("error", $ex->getMessage());
        }

    }

    public function updateIgv(RequestAlias $request, Producto $producto)
    {
        try {
           
            $producto->tiene_igv = $request->get("tieneIgv");
            $producto->update();
            return redirect()->route("tenant.almacen.productos.index")->with("success", "Igv actualizado correctamente");
        } catch (\Exception$ex) {
            return redirect()->back()->with("error", $ex->getMessage());
        }

    }

    private function getTables()
    {
        $almacenes = Almacen::where("estado", "ACTIVO")->orderBy("id", "DESC")->get(["id", "descripcion"]);
        $categorias = Categoria::where("estado", "ACTIVO")->orderBy("id", "DESC")->get(["id", "descripcion"]);
        $marcas = Marca::where("estado", "ACTIVO")->orderBy("id", "DESC")->get(["id", "nombre"]);
        $unidadMedidas = unidadMedidas();
        return compact('almacenes', 'categorias', 'marcas', 'unidadMedidas');
    }
    public function getProductos(RequestAlias $request){
        $productos = Producto::where("estado", "ACTIVO")
        ->when(Request::input('search'), function ($query, $search) {
            $query->where("nombre", "LIKE", "%$search%")
                ->OrWhere("codigo_barra", "LIKE", "%$search%");
        })
        ->paginate(10);
        $productos->each(function ($prod) {
            $prod->_almacen = $prod->almacen->descripcion;
            $prod->_categoria = $prod->categoria->descripcion;
            $prod->_marca = $prod->marca->nombre;
            unset($prod->almacen);
            unset($prod->categoria);
            unset($prod->marca);
            return $prod;
        });
        return response()->json($productos);
    }
}
