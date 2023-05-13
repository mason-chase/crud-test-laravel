<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocsController extends Controller
{
    public function __invoke()
    {
        return view('swagger');
    }
}
