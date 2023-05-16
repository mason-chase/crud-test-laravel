<?php

namespace App\Domains\Customer\Domain\Repositories;

use App\Domains\Customer\Domain\Entities\CustomerEntity;
use Illuminate\Support\Collection;

interface CustomerRepositoryInterface
{
    public function getAll(): Collection;

    public function getById(int $id): CustomerEntity;
}
