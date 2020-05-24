<?php


namespace App\Repositories\Company;


use App\Company;
use Illuminate\Database\Eloquent\Collection;

interface CompanyRepositoryInterface
{
    /**
     * @return Company
     */
    public function getAll(): ?Object;

    /**
     * @return Company
     */
    public function findById(Int $id): ?Company;
}
