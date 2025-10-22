<?php

namespace App\Http\Controllers;

use App\Http\Requests\EvaluacionRequest;
use App\Http\Resources\EvaluacionResource;
use App\Models\Evaluacion;

class EvaluacionController extends Controller
{
    public function index()
    {
        return EvaluacionResource::collection(Evaluacion::all());
    }

    public function store(EvaluacionRequest $request)
    {
        return new EvaluacionResource(Evaluacion::create($request->validated()));
    }

    public function show(Evaluacion $evaluacion)
    {
        return new EvaluacionResource($evaluacion);
    }

    public function update(EvaluacionRequest $request, Evaluacion $evaluacion)
    {
        $evaluacion->update($request->validated());

        return new EvaluacionResource($evaluacion);
    }

    public function destroy(Evaluacion $evaluacion)
    {
        $evaluacion->delete();

        return response()->json();
    }
}
