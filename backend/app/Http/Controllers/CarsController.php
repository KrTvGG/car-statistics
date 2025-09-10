<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarsRequest;
use App\Http\Resources\CarsResource;
use App\Models\Cars;

class CarsController
{
    public function __construct() {}

    /**
     * Display a listing of the resource.
     * GET /api/v1/cars
     */
    public function index()
    {
        $query = Cars::filter(request()->all());
        return CarsResource::collection($query->get());
    }

    /**
     * Store a newly created resource in storage.
     * POST /api/v1/cars
     */
    public function store(CarsRequest $request)
    {
        $event = Cars::create($request->validated());
        return (new CarsResource($event))
            ->additional([
                'status' => 'success',
                'message' => 'Автомобиль успешно создан.'
                ])
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     * GET /api/v1/cars/{id}
     */
    public function show(Cars $car)
    {
        return new CarsResource($car);
    }

    /**
     * Update the specified resource in storage.
     * PUT /api/v1/cars/{id}
     */
    public function update(CarsRequest $request, Cars $car)
    {
        $car->update($request->validated());
        return (new CarsResource($car))
            ->additional([
                'status' => 'success',
                'message' => 'Данные автомобиля успешно обновлены.'
                ])
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /api/v1/cars/{id}
     */
    public function destroy(Cars $car)
    {
        $car->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Автомобиль успешно удален.'
        ], 200);
    }
}
