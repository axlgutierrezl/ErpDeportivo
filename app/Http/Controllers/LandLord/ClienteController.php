<?php

namespace App\Http\Controllers\LandLord;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Models\LandLord\Module;
use App\Models\LandLord\Cliente;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class ClienteController extends Controller
{
    public function index()
    {
        return Inertia::render("LandLord/Clients/Cliente",[
            "clientes"=>Inertia::lazy(fn()=> $this->Lista())
        ]);
    }
    private function Lista(){
        $clientes = Cliente::with(['tenant'])->get()->each(function(){

        });
        return $clientes;
    }
    public function create()
    {
       
        return Inertia::render("LandLord/Clients/Partials/Create", [
            'dominio' => parse_url(config("app.url"), PHP_URL_HOST),
            'tablas' => Inertia::lazy(fn() => $this->Tables())
        ]);
    }

    public function edit($id)
    {
        return Inertia::render("LandLord/Clients/Partials/Edit", [

        ]);
    }
    private function prepararModulos(Module $module): Module
    {
        $levels = collect();
        foreach ($module->levels as $level) {
            $levels->push([
                "id" => $level->id,
                "descripcion" => $level->descripcion,
                "module_id" => $level->module_id,
                "is_parent" => false,
                "checked" => true,
            ]);
        }
        unset($module->levels);
        unset($module->created_at);
        unset($module->updated_at);

        $module->is_parent = true;
        $module->checked = true;
        $module->childrens = $levels;
        return $module;
    }
    private function Tables()
    {
        $modules = Module::with("levels")
            ->orderBy("orden")
            ->get()
            ->each(function ($module) {
                return $this->prepararModulos($module);
            });

        return compact("modules");
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $domain = strtolower($request->get("domain"));
            $tenant = Tenant::create([
                "name" => $request->input('razon_social'),
                "domain" => $domain . "." . parse_url(config("app.url"), PHP_URL_HOST),
            ]);
            $fecha = new Carbon(now());
            $fecha_pago = $fecha->addMonths(1);
            //** registrar cliente */
            $cliente = new Cliente();
            $cliente->tenant_id = $tenant->id;
            $cliente->ruc = $request->get("ruc");
            $cliente->razon_social = $request->get("razon_social");
            $cliente->email = $request->get("email");
            $cliente->password= $request->get("password");
            $cliente->soap_envio = $request->get("soap_envio");
            $cliente->soap_tipo = $request->get("soap_tipo");
            $cliente->fecha_pago = $fecha_pago;
            $cliente->save();
            DB::commit();

            $this->InsertDataTenant($tenant->database,$request);

            return redirect()->route("landlord.cliente.index")->with("success","Creado correctamente");

        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with("error", $ex->getMessage());
        }
    }
    private function InsertDataTenant($database,$request){
        $array_modules = [];
        $array_levels = [];
        //seleccionamos la base de datos actual
        DB::statement("use $database");
        //registramos un usuario para el inquilino actual
        $user_id = DB::table('users')->insert([
            "name" => "Administrador",
            "email" => $request->get("email"),
            "password" => bcrypt($request->get("password")),
        ]);

        /** registramos en la tabla empresa */
        $empresa = DB::table("empresas")->insert([
            'ruc'=>$request->get("ruc"),
            'razon_social'=>$request->get("razon_social"),
            'razon_social_abreviada'=>$request->get("razon_social"),
            'direccion_fiscal'=>$request->get("direccion_fiscal"),
            'ubigeo'=>$request->get("ubigeo"),
            'mail_mailer'=>$request->get("mail_mailer"),
            'mail_host'=>$request->get("mail_host"),
            'mail_port'=>$request->get("mail_port"),
            'mail_username'=>$request->get("mail_username"),
            'mail_password'=>$request->get("mail_password"),
            'mail_encryption'=>$request->get("mail_encryption"),
            'soap_envio'=>$request->get("soap_envio"),
            'soap_tipo'=>$request->get("soap_tipo"),
        ]);

        /** registramos en la tabla serializacion */
        $serie = DB::table("serializacions")->insert([
            ['empresa_id'=>1,'tipo_documento_id'=>'01','serie'=>'F001','cantidad_numeros'=>8,'destino'=>'VENTAS','por_defecto'=>'NO','numero_fin'=>0],
            ['empresa_id'=>1,'tipo_documento_id'=>'03','serie'=>'B001','cantidad_numeros'=>8,'destino'=>'VENTAS','por_defecto'=>'NO','numero_fin'=>0],
            ['empresa_id'=>1,'tipo_documento_id'=>'07','serie'=>'FC01','cantidad_numeros'=>8,'destino'=>'FNC','por_defecto'=>'NO','numero_fin'=>0],
            ['empresa_id'=>1,'tipo_documento_id'=>'08','serie'=>'FD01','cantidad_numeros'=>8,'destino'=>'FND','por_defecto'=>'NO','numero_fin'=>0],
            ['empresa_id'=>1,'tipo_documento_id'=>'09','serie'=>'T001','cantidad_numeros'=>8,'destino'=>'GUIAS','por_defecto'=>'NO','numero_fin'=>0],
            ['empresa_id'=>1,'tipo_documento_id'=>'80','serie'=>'NV01','cantidad_numeros'=>8,'destino'=>'VENTAS','por_defecto'=>'NO','numero_fin'=>0],
            ['empresa_id'=>1,'tipo_documento_id'=>'50','serie'=>'TV01','cantidad_numeros'=>8,'destino'=>'VENTAS','por_defecto'=>'SI','numero_fin'=>0],
            ['empresa_id'=>1,'tipo_documento_id'=>'52','serie'=>'NI01','cantidad_numeros'=>8,'destino'=>'NOTAS','por_defecto'=>'NO','numero_fin'=>0],
            ['empresa_id'=>1,'tipo_documento_id'=>'53','serie'=>'NS01','cantidad_numeros'=>8,'destino'=>'NOTAS','por_defecto'=>'NO','numero_fin'=>0],
        ]);

        foreach($request->modules as $module){
            array_push($array_modules,[
                "module_id"=>$module,
                "user_id"=>$user_id
            ]);
        }
       
        foreach($request->levels as $level){
            array_push($array_levels,[
                "module_level_id"=>$level,
                "user_id"=>$user_id
            ]);
        }

        DB::table("module_user")->insert($array_modules);
        DB::table("module_level_user")->insert($array_levels);

    }
}