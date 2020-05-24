<?php

namespace App\Repositories\Company;

use App\Company;

interface CompanyRepositoryInterface
{
    public function getAll();

    public function find(Int $id);

    public function create(Company $company, array $data);

    public function update(Company $company, array $data);

    public function delete(Company $company);
}
