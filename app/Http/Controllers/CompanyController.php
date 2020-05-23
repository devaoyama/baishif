<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\CompanyRequest;
use Illuminate\Http\JsonResponse;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return new JsonResponse(auth()->user()->companies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(CompanyRequest $request)
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
    public function show($id)
    {
        return new JsonResponse(Company::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        return new JsonResponse(Company::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(CompanyRequest $request, $id)
    {
        /** @var Company $company */
        $company = Company::find($id);
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
    public function destroy($id)
    {
        /** @var Company $company */
        $company = Company::find($id);
        $company->delete();
        return new JsonResponse($company);
    }
}
