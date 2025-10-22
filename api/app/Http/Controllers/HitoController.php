<?php

namespace App\Http\Controllers;

use App\Http\Requests\HitoRequest;
use App\Http\Resources\HitoResource;
use App\Models\Hito;

class HitoController extends Controller
{
    public function index()
    {
        return HitoResource::collection(Hito::all());
    }

    public function store(HitoRequest $request)
    {
        return new HitoResource(Hito::create($request->validated()));
    }

    public function show(Hito $hito)
    {
        return new HitoResource($hito);
    }

    public function update(HitoRequest $request, Hito $hito)
    {
        $hito->update($request->validated());

        return new HitoResource($hito);
    }

    public function destroy(Hito $hito)
    {
        $hito->delete();

        return response()->json();
    }
}
