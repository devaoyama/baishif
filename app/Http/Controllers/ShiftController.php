<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShiftRequest;
use App\Repositories\Shift\ShiftRepositoryInterface;
use App\Services\Shift\ShiftSalary\ShiftSalaryCalculatorInterface;
use App\Shift;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    private $shiftRepository;

    public function __construct(ShiftRepositoryInterface $shiftRepository)
    {
        $this->authorizeResource(Shift::class, 'shift');
        $this->shiftRepository = $shiftRepository;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index(): JsonResponse
    {
        return new JsonResponse($this->shiftRepository->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(ShiftRequest $request, Shift $shift, ShiftSalaryCalculatorInterface $calculator)
    {
        $shift = $this->shiftRepository->create($shift, $request->all());
        $calculator->calculate($shift);
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
    public function update(Request $request, Shift $shift, ShiftSalaryCalculatorInterface $calculator)
    {
        $shift = $this->shiftRepository->update($shift, $request->all());
        $calculator->calculate($shift);
        return new JsonResponse($shift);
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Shift $shift)
    {
        $this->shiftRepository->delete($shift);
        return new JsonResponse($shift);
    }
}
