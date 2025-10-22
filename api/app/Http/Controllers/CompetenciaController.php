<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompetenciaRequest;
use App\Http\Resources\CompetenciaResource;
use App\Models\Competencia;

class CompetenciaController extends Controller
{
    public function index()
    {
        return CompetenciaResource::collection(Competencia::all());
    }

    public function store(CompetenciaRequest $request)
    {
        return new CompetenciaResource(Competencia::create($request->validated()));
    }

    public function show(Competencia $competencia)
    {
        return new CompetenciaResource($competencia);
    }

    public function update(CompetenciaRequest $request, Competencia $competencia)
    {
        $competencia->update($request->validated());

        return new CompetenciaResource($competencia);
    }

    public function destroy(Competencia $competencia)
    {
        $competencia->delete();

        return response()->json();
    }
}
