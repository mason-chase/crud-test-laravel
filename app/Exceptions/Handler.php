<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Test\BaceManager\App\Helper\ApiController;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (AuthenticationException $e, $request) {
            if ($request->is('api/*')) {
                return (new ApiController())->errorResponse([],
                Response::HTTP_UNAUTHORIZED, 'user not login');
            }
        });

        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                return (new ApiController())->notFound();
            }
        });
        
        $this->renderable(function (Exception $e, $request) {
            if ($request->is('api/*')) {
                return (new ApiController())
                ->errorResponse([], Response::HTTP_INTERNAL_SERVER_ERROR,
                $e->getMessage());
            }
        });
    }

}
