<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShiftRequest;
use App\Shift;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Shift::class, 'shift');
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index(): JsonResponse
    {
        return new JsonResponse(auth()->user()->shifts);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(ShiftRequest $request, Shift $shift)
    {
        $shift->fill($request->all());
        $shift = auth()->user()->shifts()->save($shift);

        return new JsonResponse($shift);
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(Shift $shift)
    {
        return new JsonResponse($shift);
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(Shift $shift)
    {
        return new JsonResponse($shift);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, Shift $shift)
    {
        $shift->fill($request->all());
        $shift->update();
        return new JsonResponse($shift);
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Shift $shift)
    {
        $shift->delete();
        return new JsonResponse($shift);
    }
}
