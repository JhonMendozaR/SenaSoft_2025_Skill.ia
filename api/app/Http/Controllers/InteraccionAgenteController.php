<?php

namespace App\Http\Controllers;

use App\Http\Requests\InteraccionAgenteRequest;
use App\Http\Resources\InteraccionAgenteResource;
use App\Models\InteraccionAgente;

class InteraccionAgenteController extends Controller
{
    public function index()
    {
        return InteraccionAgenteResource::collection(InteraccionAgente::all());
    }

    public function store(InteraccionAgenteRequest $request)
    {
        return new InteraccionAgenteResource(InteraccionAgente::create($request->validated()));
    }

    public function show(InteraccionAgente $interaccionAgente)
    {
        return new InteraccionAgenteResource($interaccionAgente);
    }

    public function update(InteraccionAgenteRequest $request, InteraccionAgente $interaccionAgente)
    {
        $interaccionAgente->update($request->validated());

        return new InteraccionAgenteResource($interaccionAgente);
    }

    public function destroy(InteraccionAgente $interaccionAgente)
    {
        $interaccionAgente->delete();

        return response()->json();
    }
}
