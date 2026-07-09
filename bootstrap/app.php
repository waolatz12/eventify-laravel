<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Http\Middleware\CheckPermission;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        $middleware->redirectGuestsTo(function () {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        });

        $middleware->alias([
            'permission' => CheckPermission::class,
        ]);
    })
    // ->withExceptions(function (Exceptions $exceptions): void {})->create();
    ->withExceptions(function (Exceptions $exceptions) {

        $exceptions->render(function (NotFoundHttpException $e, $request) {

            if ($request->expectsJson()) {

                return response()->json([
                    'success' => false,
                    'message' => 'Resource not found.'
                ], 404);
            }
        });
    })
    ->create();
