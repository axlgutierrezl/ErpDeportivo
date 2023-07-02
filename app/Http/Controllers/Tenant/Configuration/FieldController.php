<?php

namespace App\Http\Controllers\Tenant\Configuration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\Configuration\Field\FieldRequest;
use App\Models\Tenant\Configuration\Field\Field;
use App\Models\Tenant\Maintenance\Sport\Sport;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request;

// CC1: CAMPOS
class FieldController extends Controller
{
    public function index()
    {
        return Inertia::render("Tenant/Configuration/Field/FieldIndex", [
            'fields' => Inertia::lazy(fn () => $this->List()),
            'filters' => Request::only(['size', 'search', 'page'])
        ]);
    }

    private function List()
    {
        $size = Request::input('size');
        $fields = Field::select('fields.*')
            ->when(Request::input('search'), function ($query, $search) {
                $query->join('sports', 'sports.id', '=', 'fields.sport_id')
                    ->where("fields.name", "LIKE", "%$search%")
                    ->OrWhere("fields.description", "LIKE", "%$search%")
                    ->OrWhere("sports.name", "LIKE", "%$search%");
            })
            ->orderBy("fields.state", "asc")
            ->orderBy('fields.id', 'desc')
            ->with('sport')
            ->paginate($size);
        return $fields;
    }

    public function store(FieldRequest $request)
    {
        try {
            $sport = Sport::findOrFail($request->get("sport_id"));
            $field = new Field();
            $field->name = $request->get('name');
            $field->description = $request->get('description');
            $field->sport_id = $sport->id;
            $field->state = "1";
            $field->save();

            return new JsonResponse([
                "success" => true,
                "message" => "Campo con el nombre " . $field->name . " registrado correctamente.",
            ]);
        } catch (\Exception $ex) {
            return new JsonResponse([
                "success" => false,
                "message" => $ex->getMessage(),
            ]);
        }
    }
    public function update(FieldRequest $request)
    {
        try {
            $sport = Sport::findOrFail($request->get("sport_id"));
            $field = Field::findOrFail($request->get("id"));
            $field->name = $request->get('name');
            $field->description = $request->get("description");
            $field->sport_id = $sport->id;
            $field->save();
            return new JsonResponse([
                "success" => true,
                "message" => "Campo con el nombre " . $field->name . " actualizado correctamente.",
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
            $field = Field::findOrFail($id);
            $field->state = "0";
            $field->save();
            return new JsonResponse([
                "success" => true,
                "message" => "Campo con el nombre " . $field->name . " inhabilitado correctamente.",
            ]);
        } catch (\Exception $ex) {
            return new JsonResponse([
                "success" => false,
                "message" => $ex->getMessage(),
            ]);
        }
    }
}
