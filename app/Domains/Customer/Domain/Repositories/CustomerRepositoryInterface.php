<?php

namespace App\Domains\Customer\Domain\Repositories;

use Illuminate\Support\Collection;

interface CustomerRepositoryInterface
{
    public function getAll(): Collection;
}
