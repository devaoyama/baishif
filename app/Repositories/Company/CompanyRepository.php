<?php

namespace App\Repositories\Company;

use App\Company;

class CompanyRepository implements CompanyRepositoryInterface
{
    public function getAll(): ?Object
    {
        return auth()->user()->companies;
    }

    public function find(int $id): ?Company
    {
        return Company::find($id);
    }

    public function create(Company $company, array $data)
    {
        $company->fill($data);
        auth()->user()->companies()->save($company);
        return $company;
    }

    public function update(Company $company, array $data)
    {
        $company->fill($data)->save();
        return $company;
    }

    public function delete(Company $company)
    {
        return $company->delete();
    }
}
