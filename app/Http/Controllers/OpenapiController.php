<?php

namespace App\Http\Controllers;

class OpenapiController extends Controller
{
    public function __invoke()
    {
        $openapi = \OpenApi\Generator::scan([base_path('app')]);

        return response(
            $openapi->toYaml()
        )->header('Content-Type', 'application/x-yaml');
    }
}
