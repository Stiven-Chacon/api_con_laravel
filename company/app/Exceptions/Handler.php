<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
        $this->renderable(function (NotFoundHttpException $e,$request) {
            //validamos y enviamos mensaje para que no le muestre error al usuario al momento
            //de colocar un departamento que no exista 
            if ($request->is('api/departments/*')) {
                return response()->json([
                    'status' => false,
                    'message' => 'El departamento que deseas buscar no existe'
                ], 404);
            }
            //validamos y enviamos mensaje para que no le muestre error al usuario al momento
            //de colocar un empleado que no exista 
            if ($request->is('api/empleados/*')) {
                return response()->json([
                    'status' => false,
                    'message' => 'El empleado que deseas buscar no existe'
                ], 404);
            }
        });
    }
}
