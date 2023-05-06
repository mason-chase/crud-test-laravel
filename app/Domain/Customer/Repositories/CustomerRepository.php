<?php

namespace App\Domain\Customer\Repositories;

use App\Domain\Customer\Models\Customer;
use Prettus\Repository\Eloquent\BaseRepository;

class CustomerRepository extends BaseRepository
{
    public function model()
    {
        return Customer::class;
    }
}
