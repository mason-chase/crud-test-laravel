<?php

namespace Test\CustomerManager\App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Test\BaceManager\App\Http\Resources\PaginationResource;

class CustomerCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'customers' => $this->collection,
            'links' => PaginationResource::make($this),
        ];
    }
}
