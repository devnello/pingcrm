<?php

namespace App\Utils;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SqlError
{
    function __construct()
    {
        // print "En el constructor BaseClass\n";
    }

    static public function saveSqlError($exception)
    {
        $sql = $exception->getSql();
        $bindings = $exception->getBindings();

        // Process the query's SQL and parameters and create the exact query
        foreach ($bindings as $i => $binding) {
            if ($binding instanceof \DateTime) {
                $bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
            } else {
                if (is_string($binding)) {
                    $bindings[$i] = "'$binding'";
                }
            }
        }
        $query = str_replace(array('%', '?'), array('%%', '%s'), $sql);
        $query = vsprintf($query, $bindings);

        // Here's the part you need
        $errorInfo = $exception->errorInfo;

        $data = [
            'sql' => $query,
            'message' => isset($errorInfo[2]) ? $errorInfo[2] : '',
            'sql_state' => $errorInfo[0],
            'error_code' => $errorInfo[1],
            'bindings' => $bindings
        ];

        // Now store the error into database, if you want..
        // ....
        return $data;
    }


    static function handleQueryException($ex, $modelName)
    {

        $data = SqlError::saveSqlError($ex);

        $sql = $data['sql'];
        $message = $data['message'];
        $sql_state = $data['sql_state'];
        $error_code = $data['error_code'];
        $bindings = $data['bindings'];

        // Duplicate Key
        if ($error_code == 1062) {
            return response()
                ->json([
                    'code' => 404,
                    'sql' => $sql,
                    'message' => 'Un registro igual ya existe en el sistema! ' . $modelName,
                    'sql_state' => $sql_state,
                    'error_code' => $error_code,
                    'bindings' => $bindings
                ], 404);
        }

        // 1451 Cannot delete or update a parent row: a foreign key constraint fails
        if ($error_code == 1451) {
            return response()
                ->json([
                    'code' => 404,
                    'sql' => $sql,
                    'message' => 'El registro que se quiere eliminar, se usa en otro sitio! No se puede eliminar',
                    'info_message' => $message,
                    'sql_state' => $sql_state,
                    'error_code' => $error_code,
                    'bindings' => $bindings
                ], 404);
        }

        // ... Añadir más errores

        // Si no se ha tratado la exception raise
        // throw $ex;
        return response()->json(['code' => 404, 'message' => $ex->getMessage()], 404);
    }


    static function handleException($exception)
    {
        if ($exception instanceof ValidationException) {
            //return $this->convertValidationExceptionToResponse($exception, $request);
        }

        if ($exception instanceof ModelNotFoundException) {
            $modelo = strtolower(class_basename($exception->getModel()));
            $code = $exception->getCode();
            // return $this->errorResponse("No existe ninguna instancia de {$modelo} con el id especificado", 404);
        }

        if ($exception instanceof AuthenticationException) {
            // return $this->unauthenticated($request, $exception);
        }

        if ($exception instanceof AuthorizationException) {
            // return $this->errorResponse('No posee permisos para ejecutar esta acción', 403);
        }

        if ($exception instanceof NotFoundHttpException) {
            // return $this->errorResponse('No se encontró la URL especificada', 404);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            // return $this->errorResponse('El método especificado en la petición no es válido', 405);
        }

        if ($exception instanceof HttpException) {
            // return $this->errorResponse($exception->getMessage(), $exception->getStatusCode());
        }

        if ($exception instanceof QueryException) {
            $codigo = $exception->errorInfo[1];

            if ($codigo == 1451) {
                // return $this->errorResponse('No se puede eliminar de forma permamente el recurso porque está relacionado con algún otro.', 409);
            }
        }

        if ($exception instanceof TokenMismatchException) {
            // return redirect()->back()->withInput($request->input());
        }

        if (config('app.debug')) {
            // return parent::render($request, $exception);
        }

        // return $this->errorResponse('Falla inesperada. Intente luego', 500);

        // Gestionar la exception d emanera controlada
        return response()
            ->json([
                'code' => 404, 'message' => $exception->getMessage()
            ], 404);
    }

}
