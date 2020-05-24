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
        $company->fill($request->all());
        $company->save();
        return new JsonResponse($company);
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Company $company): JsonResponse
    {
        $company->delete();
        return new JsonResponse($company);
    }
}
