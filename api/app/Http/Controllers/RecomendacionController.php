<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecomendacionRequest;
use App\Http\Resources\RecomendacionResource;
use App\Models\Recomendacion;

class RecomendacionController extends Controller
{
    public function index()
    {
        return RecomendacionResource::collection(Recomendacion::all());
    }

    public function store(RecomendacionRequest $request)
    {
        return new RecomendacionResource(Recomendacion::create($request->validated()));
    }

    public function show(Recomendacion $recomendacion)
    {
        return new RecomendacionResource($recomendacion);
    }

    public function update(RecomendacionRequest $request, Recomendacion $recomendacion)
    {
        $recomendacion->update($request->validated());

        return new RecomendacionResource($recomendacion);
    }

    public function destroy(Recomendacion $recomendacion)
    {
        $recomendacion->delete();

        return response()->json();
    }
}
