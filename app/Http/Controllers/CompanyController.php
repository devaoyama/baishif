<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\CompanyRequest;
use App\Repositories\Company\CompanyRepositoryInterface;
use Illuminate\Http\JsonResponse;

class CompanyController extends Controller
{
    private $companyRepository;

    public function __construct(CompanyRepositoryInterface $repository)
    {
        $this->companyRepository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index(): JsonResponse
    {
        return new JsonResponse($this->companyRepository->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(CompanyRequest $request): JsonResponse
    {
        $company = new Company();
        $company->fill($request->all());
        $company = auth()->user()->companies()->save($company);
        return new JsonResponse($company);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id): JsonResponse
    {
        return new JsonResponse($this->companyRepository->findById($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id): JsonResponse
    {
        return new JsonResponse($this->companyRepository->findById($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(CompanyRequest $request, $id): JsonResponse
    {
        /** @var Company $company */
        $company = $this->companyRepository->findById($id);
        $company->fill($request->all());
        $company->save();
        return new JsonResponse($company);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        /** @var Company $company */
        $company = $this->companyRepository->findById($id);
        $company->delete();
        return new JsonResponse($company);
    }
}
