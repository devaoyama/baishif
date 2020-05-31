<?php

namespace App\Http\Controllers;

use App\Repositories\Shift\ShiftRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShareController extends Controller
{
    private $shiftRepository;

    public function __construct(ShiftRepositoryInterface $shiftRepository)
    {
        $this->shiftRepository = $shiftRepository;
    }

    public function getByShareId(Request $request): JsonResponse
    {
        $shifts = $this->shiftRepository->getByShareId($request->query('shareId'));
        return new JsonResponse($shifts);
    }

    public function setShareId(Request $request): JsonResponse
    {
        $id = $this->shiftRepository->setShareId($request->query('year'), $request->query('month'));
        return new JsonResponse($id);
    }

    public function deleteShareId(Request $request): JsonResponse
    {
        $shifts = $this->shiftRepository->deleteShareId($request->query('shareId'));
        return new JsonResponse($shifts);
    }
}
