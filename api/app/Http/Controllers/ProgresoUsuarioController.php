<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProgresoUsuarioRequest;
use App\Http\Resources\ProgresoUsuarioResource;
use App\Models\ProgresoUsuario;

class ProgresoUsuarioController extends Controller
{
    public function index()
    {
        return ProgresoUsuarioResource::collection(ProgresoUsuario::all());
    }

    public function store(ProgresoUsuarioRequest $request)
    {
        return new ProgresoUsuarioResource(ProgresoUsuario::create($request->validated()));
    }

    public function show(ProgresoUsuario $progresoUsuario)
    {
        return new ProgresoUsuarioResource($progresoUsuario);
    }

    public function update(ProgresoUsuarioRequest $request, ProgresoUsuario $progresoUsuario)
    {
        $progresoUsuario->update($request->validated());

        return new ProgresoUsuarioResource($progresoUsuario);
    }

    public function destroy(ProgresoUsuario $progresoUsuario)
    {
        $progresoUsuario->delete();

        return response()->json();
    }
}
