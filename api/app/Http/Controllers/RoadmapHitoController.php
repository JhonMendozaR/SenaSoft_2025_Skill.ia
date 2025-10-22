<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoadmapHitoRequest;
use App\Http\Resources\RoadmapHitoResource;
use App\Models\RoadmapHito;

class RoadmapHitoController extends Controller
{
    public function index()
    {
        return RoadmapHitoResource::collection(RoadmapHito::all());
    }

    public function store(RoadmapHitoRequest $request)
    {
        return new RoadmapHitoResource(RoadmapHito::create($request->validated()));
    }

    public function show(RoadmapHito $roadmapHito)
    {
        return new RoadmapHitoResource($roadmapHito);
    }

    public function update(RoadmapHitoRequest $request, RoadmapHito $roadmapHito)
    {
        $roadmapHito->update($request->validated());

        return new RoadmapHitoResource($roadmapHito);
    }

    public function destroy(RoadmapHito $roadmapHito)
    {
        $roadmapHito->delete();

        return response()->json();
    }
}
