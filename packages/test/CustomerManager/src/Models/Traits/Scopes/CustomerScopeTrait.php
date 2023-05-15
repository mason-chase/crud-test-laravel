<?php

namespace Test\CustomerManager\Models\Traits\Scopes;

trait CustomerScopeTrait
{
    public function inBankAccountListScope($query, Array $list)
    {
        $query->whereIn('bank_account_number', $list);
    }

    public function inEmailList($query, Array $list)
    {
        $query->whereIn('email', $list);
    }
    
}
