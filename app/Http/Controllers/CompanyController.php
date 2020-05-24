<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\CompanyRequest;
use App\Repositories\Company\CompanyRepositoryInterface;
use Illuminate\Http\JsonResponse;

class CompanyController extends Controller
{
    private $companyRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
        $this->authorizeResource(Company::class, 'company');
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
     */
    public function store(CompanyRequest $request, Company $company): JsonResponse
    {
        $company = $this->companyRepository->create($company, $request->all());
        return new JsonResponse($company);
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(Company $company): JsonResponse
    {
        return new JsonResponse($company);
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(Company $company): JsonResponse
    {
        return new JsonResponse($company);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(CompanyRequest $request, Company $company): JsonResponse
    {
        $company = $this->companyRepository->update($company, $request->all());
        return new JsonResponse($company);
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Company $company): JsonResponse
    {
        $this->companyRepository->delete($company);
        return new JsonResponse($company);
    }
}
