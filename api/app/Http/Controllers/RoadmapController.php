<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoadmapRequest;
use App\Http\Resources\RoadmapResource;
use App\Models\Roadmap;

class RoadmapController extends Controller
{
    public function index()
    {
        return RoadmapResource::collection(Roadmap::all());
    }

    public function store(RoadmapRequest $request)
    {
        return new RoadmapResource(Roadmap::create($request->validated()));
    }

    public function show(Roadmap $roadmap)
    {
        return new RoadmapResource($roadmap);
    }

    public function update(RoadmapRequest $request, Roadmap $roadmap)
    {
        $roadmap->update($request->validated());

        return new RoadmapResource($roadmap);
    }

    public function destroy(Roadmap $roadmap)
    {
        $roadmap->delete();

        return response()->json();
    }
}
