<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResultadoEvaluacionRequest;
use App\Http\Resources\ResultadoEvaluacionResource;
use App\Models\ResultadoEvaluacion;

class ResultadoEvaluacionController extends Controller
{
    public function index()
    {
        return ResultadoEvaluacionResource::collection(ResultadoEvaluacion::all());
    }

    public function store(ResultadoEvaluacionRequest $request)
    {
        return new ResultadoEvaluacionResource(ResultadoEvaluacion::create($request->validated()));
    }

    public function show(ResultadoEvaluacion $resultadoEvaluacion)
    {
        return new ResultadoEvaluacionResource($resultadoEvaluacion);
    }

    public function update(ResultadoEvaluacionRequest $request, ResultadoEvaluacion $resultadoEvaluacion)
    {
        $resultadoEvaluacion->update($request->validated());

        return new ResultadoEvaluacionResource($resultadoEvaluacion);
    }

    public function destroy(ResultadoEvaluacion $resultadoEvaluacion)
    {
        $resultadoEvaluacion->delete();

        return response()->json();
    }
}
