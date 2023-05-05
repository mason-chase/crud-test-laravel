<?php

namespace Src\Customer\Application\Common\Interfaces;

interface CustomerServiceInterface
{
    public function checkExistenceByFields(array $fields);
}
