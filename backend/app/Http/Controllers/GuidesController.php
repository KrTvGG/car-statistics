<?php

namespace App\Http\Controllers;

use App\Models\Guides;
use Illuminate\Http\Request;
use App\Services\GuidesService;

class GuidesController extends Controller
{
    private $guidesService;

    public function __construct(GuidesService $guidesService)
    {
        $this->guidesService = $guidesService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = $this->guidesService->list();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
