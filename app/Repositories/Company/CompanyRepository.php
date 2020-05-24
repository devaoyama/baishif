<?php


namespace App\Repositories\Company;


use App\Company;
use Illuminate\Database\Eloquent\Collection;

class CompanyRepository implements CompanyRepositoryInterface
{
    public function getAll(): ?Object
    {
        return auth()->user()->companies;
    }

    public function findById(int $id): ?Company
    {
        return Company::find($id);
    }
}
