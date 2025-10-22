<?php

namespace App\Http\Controllers;

use App\Http\Requests\PerfilObjetivoRequest;
use App\Http\Resources\PerfilObjetivoResource;
use App\Models\PerfilObjetivo;

class PerfilObjetivoController extends Controller
{
    public function index()
    {
        return PerfilObjetivoResource::collection(PerfilObjetivo::all());
    }

    public function store(PerfilObjetivoRequest $request)
    {
        return new PerfilObjetivoResource(PerfilObjetivo::create($request->validated()));
    }

    public function show(PerfilObjetivo $perfilObjetivo)
    {
        return new PerfilObjetivoResource($perfilObjetivo);
    }

    public function update(PerfilObjetivoRequest $request, PerfilObjetivo $perfilObjetivo)
    {
        $perfilObjetivo->update($request->validated());

        return new PerfilObjetivoResource($perfilObjetivo);
    }

    public function destroy(PerfilObjetivo $perfilObjetivo)
    {
        $perfilObjetivo->delete();

        return response()->json();
    }
}
