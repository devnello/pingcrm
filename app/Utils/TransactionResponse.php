<?php
/**
 * Created by PhpStorm.
 * User: devnello
 * Date: 12/08/2018
 * Time: 20:29
 */

namespace App\Utils;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

class TransactionResponse
{
    static function handleResponse(Array $item, $operation, $extras = null): JsonResponse
    {
        $a = null;

        if (is_null($extras)) {
            $a = ['operation' => $operation, 'item' => $item];
        } else {
            $a = ['operation' => $operation, 'item' => $item, 'extras' => $extras];
        }

        return response()->json($a, 200);
    }

    static function handleResponseItems(Array $items, $operation, $extras = null): JsonResponse
    {
        $a = null;

        if (is_null($extras)) {
            $a = ['operation' => $operation, 'items' => $items];
        } else {
            $a = ['operation' => $operation, 'items' => $items, 'extras' => $extras];
        }

        return response()->json($a, 200);
    }

    static function handleResponseProcessOk($operation, $extras = null): JsonResponse
    {
        $a = null;

        if (is_null($extras)) {
            $a = ['operation' => $operation];
        } else {
            $a = ['operation' => $operation, 'extras' => $extras];
        }

        return response()->json($a, 200);
    }

    static function handleResponseArray(Array $item, $operation, $extras = null): JsonResponse
    {
        if (is_null($extras)) {
            $a = ['operation' => $operation];

        } else {
            $a = ['operation' => $operation, 'extras' => $extras];
        }

        $m = array_merge($item, $a);

        return response()->json($m, 200);
    }

    static function handleResponseArrayDirect(Array $item, String $operation): JsonResponse
    {
        $a = $item;
        $a  ['operation'] = $operation;
        return response()->json($a, 200);
    }

    static function handleResponseArrayParam(Array $items, $total, $operacion): JsonResponse
    {
        $result = ['data' => ['items' => $items, 'total' => $total, '$operacion' => $operacion]];

        return response()->json($result, 200);
    }

    static function returnWithPagination(LengthAwarePaginator $items): array
    {
        // Return paginacion + resultado
        return ['pagination' => ['total' => $items->total(),
            'current_page' => $items->currentPage(),
            'per_page' => intval($items->perPage()),
            'last_page' => $items->lastPage(),
            'from' => $items->firstItem(),
            'to' => $items->lastItem()],
            'items' => $items];
    }

    static function convertArrayNumberToFloat(Array $arrOrigen, Array &$arrDestino)
    {
        foreach ($arrOrigen as $key => $value) {

            if (is_string($value)) {

                if (is_int($value)) {
                    $arrDestino[$key] = intval($value);
                } else if (is_float($value)) {
                    $arrDestino[$key] = floatval($value);
                } else if (is_numeric($value)) {
                    // Hay que ver si en int or float
                    // $arrDestino[$key] = floatval($value);

                    if (preg_match("/^\d{1,9}(\.\d{1,4})?$/", $value, $match)) {
                        // if (preg_match("/^\d{1,9}({.\}d{1,4})?$/", $value, $match)) {
                        // Es float
                        $arrDestino[$key] = floatval($value);
                    } else {
                        // Es int
                        $arrDestino[$key] = intval($value);
                    }
                } else {
                    // Si contiene solo numeros y coma IMPORTANTE de 1 a 9 una coma de 1 a 4 numeros!
                    // if (preg_match("/^\d{1,9}{,\}(d{1,4})?$/", $value, $match)) { // search for number that may contain '.'
                    if (preg_match("/^\d{1,9}(\,\d{1,4})?$/", $value, $match)) { // search for number that may contain '.'

                        $c = str_replace(',', '.', $match[0]);
                        if (is_numeric($c)) {
                            $arrDestino[$key] = floatval($c);
                        } else {
                            $arrDestino[$key] = $value;
                        }
                    } else {
                        $arrDestino[$key] = $value; // take some last chances with floatval
                    }
                }
            } else {
                $arrDestino[$key] = $value;
            }
        }
    }

    // Trace example
    // return TransactionResponse::handleResponseTrace($this->nombre_modelo, '300');
    static function handleResponseTrace(string $message, array $extra, int $code): JsonResponse
    {
        return response()->json(['message' => $message, 'extra' => $extra], $code);
    }

    static function handleResponseRequery(Array $json_result, Int $code): JsonResponse
    {
        return response()->json($json_result, $code);
    }

    static function handleUpdateRequery(array $items, Array $data, Array $base_data, Array $allowed, Array $disallowed, Array &$result): JsonResponse
    {
        // $_campos_leidos_bd = [];
        // $_base_data = [];

        // Compare $items con $base_data
        //-----------------------------------------------------------------------------------------------
        // IMPORTANTE !!!!!!!!!! el array $base_data tiene que tener SIEMPRE todos los campos de la tabla
        //-----------------------------------------------------------------------------------------------
        try {
            // $campos_leidos_bd = $items->toarray();
            $campos_leidos_bd = $items;
            //
            self::convertArrayNumberToFloat($campos_leidos_bd, $_campos_leidos_bd);
            self::convertArrayNumberToFloat($base_data, $_base_data);
            //
            $dif1 = array_diff($_campos_leidos_bd, $_base_data);
        } catch (Exception $e) {

            return response()
                ->json([
                    'code' => 401,
                    'error' => 'Error de Validación',
                    'errors' => ''
                ], 401);
        }
        $disallowed_dif = ['created_at', 'updated_at'];
        if ($disallowed != null) {
            $disallowed_dif = array_merge($disallowed_dif, $disallowed);
        }
        $filtered_dif = array_filter(
            $dif1,
            function ($key) use ($disallowed_dif) {
                return !in_array($key, $disallowed_dif);
            },
            ARRAY_FILTER_USE_KEY
        );
        // Solo ha cambiado create
        if ($filtered_dif != []) {
            return response()->json(array(
                'code' => 401,
                'message' => 'El valor ha cambiado en base de datos! Refresca!',
                'diff' => $dif1,
                // 'data_bd' => $items,
                'data_bd' => $_campos_leidos_bd,
                'base_data' => $_base_data
            ), 401);
        }

        // ++++++++++++++++++++ IMPLEMETAR ERROER
        // Will return a ModelNotFoundException if no user with that id


        // $items = TarifaHorarioLaboral::findOrFail($id);
        // $all = $request->only('nombre', 'precio_hora', 'flgact');
        // $allowed = array('nombre', 'precio_hora', 'flgact');
//        $allowed = [
//            'flgact',
//            'created_user',
//            'updated_user',
//            'nombre',
//            'descripcion',
//            'incremento'
//        ];
//        $filtered = array_filter(
//            $data,
//            function ($key) use ($allowed) {
//                return in_array($key, $allowed);
//            },
//            ARRAY_FILTER_USE_KEY
//        );
//        $filtered['updated_user'] = Auth::user()->email;

        $filtered = Helper::fieldsFilterForUpdate($data, $allowed);

        $result = $filtered;

        // No es la respuesta al form, se usa para gestionar el retorno.
        return response()->json([
            'code' => 200,
        ], 200);
    }

    static function handleRequeryBeforeUpdate(array $items, Array $data, Array $base_data, Array $allowed, Array $disallowed, Array &$result): array
    {
        $_campos_leidos_bd = [];
        $_base_data = [];

        // Compare $items con $base_data
        //-----------------------------------------------------------------------------------------------
        // IMPORTANTE !!!!!!!!!! el array $base_data tiene que tener SIEMPRE todos los campos de la tabla
        //-----------------------------------------------------------------------------------------------
        try {
            // $campos_leidos_bd = $items->toarray();
            $campos_leidos_bd = $items;
            //
            // return TransactionResponse::handleResponseTrace('1 convertArrayNumberToFloat',$_base_data,200);
            self::convertArrayNumberToFloat($campos_leidos_bd, $_campos_leidos_bd);
            self::convertArrayNumberToFloat($base_data, $_base_data);
            //
            $dif1 = array_diff($_campos_leidos_bd, $_base_data);
        } catch (Exception $e) {

            return [
                'code' => 401,
                'error' => 'Error de Validación',
                'errors' => ''
            ];
        }
        $disallowed_dif = ['created_at', 'updated_at'];
        if ($disallowed != null) {
            $disallowed_dif = array_merge($disallowed_dif, $disallowed);
        }
        $filtered_dif = array_filter(
            $dif1,
            function ($key) use ($disallowed_dif) {
                return !in_array($key, $disallowed_dif);
            },
            ARRAY_FILTER_USE_KEY
        );
        // Solo ha cambiado create
        if ($filtered_dif != []) {
            return [
                'code' => 401,
                'message' => 'El valor ha cambiado en base de datos! Refresca!',
                'diff' => $dif1,
                // 'data_bd' => $items,
                'data_bd' => $_campos_leidos_bd,
                'base_data' => $_base_data];
        }

        // ++++++++++++++++++++ IMPLEMETAR ERROER
        // Will return a ModelNotFoundException if no user with that id


        // $items = TarifaHorarioLaboral::findOrFail($id);
        // $all = $request->only('nombre', 'precio_hora', 'flgact');
        // $allowed = array('nombre', 'precio_hora', 'flgact');
//        $allowed = [
//            'flgact',
//            'created_user',
//            'updated_user',
//            'nombre',
//            'descripcion',
//            'incremento'
//        ];
//        $filtered = array_filter(
//            $data,
//            function ($key) use ($allowed) {
//                return in_array($key, $allowed);
//            },
//            ARRAY_FILTER_USE_KEY
//        );
//        $filtered['updated_user'] = Auth::user()->email;

        $filtered = Helper::fieldsFilterForUpdate($data, $allowed);

        $result = $filtered;

        // No es la respuesta al form, se usa para gestionar el retorno.
        return [
            'code' => 200
        ];
    }

    static function handleResponseBadInputParam(string $nombre_modelo, string $param_name): JsonResponse
    {
        // El nombre del message tiene que ser 'message' para visualizarlo en Vue!
        return response()
            ->json([
                'code' => 401,
                'error' => true,
                'message' => 'Parametro "' . $param_name . '" invalido! ' . $nombre_modelo,
            ], 401);
    }

}
