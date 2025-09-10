<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventsRequest;
use App\Http\Resources\EventsResource;
use App\Models\Events;

class EventsController
{
    public function __construct() {}

    /**
     * Display a listing of the resource.
     * GET /api/v1/events
     */
    public function index()
    {
        $query = Events::filter(request()->all());
        return EventsResource::collection($query->get());
    }

    /**
     * Store a newly created resource in storage.
     * POST /api/v1/events
     */
    public function store(EventsRequest $request)
    {
        $event = Events::create($request->validated());
        return (new EventsResource($event))
            ->additional([
                'status' => 'success',
                'message' => 'Событие успешно создано.'
                ])
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     * GET /api/v1/events/{id}
     */
    public function show(Events $event)
    {
        return new EventsResource($event);
    }

    /**
     * Update the specified resource in storage.
     * PUT /api/v1/events/{id}
     */
    public function update(EventsRequest $request, Events $event)
    {
        $event->update($request->validated());
        return (new EventsResource($event))
            ->additional([
                'status' => 'success',
                'message' => 'Данные события успешно обновлены.'
                ])
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /api/v1/events/{id}
     */
    public function destroy(Events $event)
    {
        $event->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Событие успешно удалено.'
        ], 200);
    }
}
