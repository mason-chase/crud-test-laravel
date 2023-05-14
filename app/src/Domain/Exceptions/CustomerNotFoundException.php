<?php
namespace Ddd\Domain\Exceptions;

use Exception;

class CustomerNotFoundException extends Exception
{
    protected $message = 'Customer not found.';
}