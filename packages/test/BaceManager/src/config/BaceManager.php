<?php


return [

    "bace_api_route" => [
        'prefix' => 'api/v1',
        'middleware' => 'api',
        "as" => 'api.'
    ],
    
    "bace_web_route" => [
        'middleware' => 'web',
        "as" => 'web.'
    ]

];