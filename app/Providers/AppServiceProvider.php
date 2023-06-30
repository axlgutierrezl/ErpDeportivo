<?php

namespace App\Providers;

use App\Models\User;
use Inertia\Inertia;
use Spatie\Multitenancy\Models\Tenant;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (parse_url(config("app.url"),PHP_URL_HOST) === request()->getHost()) {
            config(['database.default' => 'landlord']);
        }

        Inertia::share('flash', function () {
            return [
                'message' => Session::get('message'),
                'success' => Session::get('success'),
                'error'=>Session::get("error")
            ];
        });

        Inertia::share('tenant',function(){
            return  Tenant::checkCurrent() ? app('currentTenant') : null;
        });

        /** Obtenemos los modulos del inquilo actual por su usuario por default*/
        Inertia::share("modules",function(){
            if(Tenant::checkCurrent()){
                $modules = User::with(['modules','modules.levels','moduleLevel'])
                ->where("id",1)
                ->get()
                ->each(function($user){
                    foreach($user->modules as $module){
                        $array_level = [];
                        foreach($user->moduleLevel as $item){
                            foreach($module->levels as $level){
                                if($item->module_level_id == $level->id ){
                                    array_push($array_level,$level);
                                }
                            }
                        }
                        unset($module->levels);
                        unset($module->moduleLevel);
                        $module->levels = $array_level;
                    }
                    return $user;
                });
                return $modules;
            }else{
                return [];
            }
        });
    }
}