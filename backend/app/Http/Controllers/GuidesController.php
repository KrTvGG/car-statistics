<?php

namespace App\Http\Controllers;

use App\DTOs\CreateGuideDto;
use App\Http\Requests\StoreGuideRequest;
use App\Models\Guides;
use App\Repositories\Interfaces\GuidesRepositoryInterface;
use Illuminate\Http\Request;

class GuidesController extends Controller
{
    public function __construct(private GuidesRepositoryInterface $repository) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = $this->repository->list();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Create guide.
     */
    public function store(StoreGuideRequest $request)
    {
        $dto = CreateGuideDto::fromRequest($request);
        $guide = $this->repository->create($dto);

        return response()->json($guide, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Guides $guides)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guides $guides)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guides $guides)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guides $guides)
    {
        //
    }
}
