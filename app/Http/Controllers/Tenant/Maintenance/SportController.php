<?php

namespace App\Http\Controllers\Tenant\Maintenance;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\Maintenance\Sport\SportRequest;
use App\Models\Tenant\Maintenance\Sport\Sport;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request;

// CC1: CAMPOS
class SportController extends Controller
{
    public function index()
    {
        return Inertia::render("Tenant/Maintenance/Sport/SportIndex", [
            'sports' => Inertia::lazy(fn () => $this->List()),
            'filters' => Request::only(['size', 'search', 'page'])
        ]);
    }

    private function List()
    {
        $size = Request::input('size');
        $sports = Sport::when(Request::input('search'), function ($query, $search) {
            $query->where("name", "LIKE", "%$search%")
                ->OrWhere("description", "LIKE", "%$search%");
        })
            ->orderBy("state", "asc")
            ->orderBy('id', 'desc')
            ->paginate($size);
        return $sports;
    }

    public function store(SportRequest $request)
    {
        try {
            $sport = new Sport();
            $sport->name = $request->get('name');
            $sport->description = $request->get("description");
            $sport->state = "1";
            $sport->save();

            return new JsonResponse([
                "success" => true,
                "message" => "Deporte " . $sport->name . " registrado correctamente.",
            ]);
        } catch (\Exception $ex) {
            return new JsonResponse([
                "success" => false,
                "message" => $ex->getMessage(),
            ]);
        }
    }
    public function update(SportRequest $request)
    {
        try {
            $sport = Sport::findOrFail($request->get("id"));
            $sport->name = $request->get('name');
            $sport->description = $request->get("description");
            $sport->save();
            return new JsonResponse([
                "success" => true,
                "message" => "Deporte " . $sport->name . " actualizado correctamente.",
            ]);
        } catch (\Exception $ex) {
            return new JsonResponse([
                "success" => false,
                "message" => $ex->getMessage(),
            ]);
        }
    }
    public function delete($id)
    {
        try {
            $sport = Sport::findOrFail($id);
            $sport->state = "0";
            $sport->save();
            return new JsonResponse([
                "success" => true,
                "message" => "Deporte " . $sport->name . " inhabilitado correctamente.",
            ]);
        } catch (\Exception $ex) {
            return new JsonResponse([
                "success" => false,
                "message" => $ex->getMessage(),
            ]);
        }
    }
}
