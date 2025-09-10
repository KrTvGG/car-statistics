<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuidesRequest;
use App\Http\Resources\GuideResource;
use App\Models\Guides;

class GuidesController extends Controller
{
    public function __construct() {}

    /**
     * Display a listing of the resource.
     * GET /api/v1/guides
     */
    public function index()
    {
        $query = Guides::filter(request()->all());
        return GuideResource::collection($query->get());
    }

    /**
     * Store a newly created resource in storage.
     * POST /api/v1/guides
     */
    public function store(GuidesRequest $request)
    {
        $guide = Guides::create($request->validated());
        return (new GuideResource($guide))
            ->additional([
                'status' => 'success',
                'message' => 'Справочник успешно создан.'
                ])
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     * GET /api/v1/guides/{id}
     */
    public function show(Guides $guide)
    {
        return new GuideResource($guide);
    }

    /**
     * Update the specified resource in storage.
     * PUT /api/v1/guides/{id}
     */
    public function update(GuidesRequest $request, Guides $guide)
    {
        $guide->update($request->validated());
        return (new GuideResource($guide))
            ->additional([
                'status' => 'success',
                'message' => 'Данные в справочнике успешно обновлены.'
                ])
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /api/v1/guides/{id}
     */
    public function destroy(Guides $guide)
    {
        $guide->delete();
                return response()->json([
            'status' => 'success',
            'message' => 'Справочник успешно удален.'
        ], 200);
    }
}
