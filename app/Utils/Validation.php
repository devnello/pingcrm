<?php
/**
 * Created by PhpStorm.
 * User: devnello
 * Date: 16/03/2019
 * Time: 9:46
 */

namespace App\Utils;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Validation
{

    static function validateFormData(Request $request, array &$data, array &$base_data, string &$func)
    {
        if (!$request->filled(Cons::FORM_DATA) || !$request->filled(Cons::FORM_BASE_DATA)) {
            Helper::raiseGeneralException('Datos invalidos! data/base_data');
        }
        if (!$request->filled(Cons::FORM_FUNC)) {
            Helper::raiseGeneralException('Datos invalidos! func');
        } else {
            $func = $request->input(Cons::FORM_FUNC);
        }
        $data = $request->input(Cons::FORM_DATA);
        $base_data = $request->input(Cons::FORM_BASE_DATA);

        // if (is_null($data) || is_null($base_data)) {
        //   Helper::raiseGeneralException('Datos invalidos! data/base_data');
        // }
    }

    static function validateTableId(string $tableName, int $id)
    {
        $result = DB::table($tableName)->find($id);
        return Helper::convertStdClassToArray($result);
    }

    static function validateTableIdFromRequest(Request $request, string $tableName)
    {
        if ($request->filled(Col::TC_ID)) {
            // Valida Existencia Oferta
            return self::validateTableId($tableName, $request->input(Col::TC_ID));

        } else {
            // Indefificador nulo
            Helper::raiseGeneralException('Parametro identificador invalido!');
        }
    }

    static function validateInputRequest(Request $request, string $paramName)
    {
        if ($request->filled($paramName)) {
            // Valida Existencia Oferta
            return $request->input($paramName);
        } else {
            // Indefificador nulo
            Helper::raiseGeneralException('Parametro [' . $paramName . '] invalido!');
        }
    }

    static function validateInputRequestFromData(Request $request, string $paramName)
    {
        if ($request->filled('data')) {

            $data = $request->input('data');

            if (!is_null($data[$paramName])) {
                return $data[$paramName];
            }
        }
        Helper::raiseGeneralException('Parametro [' . $paramName . '] invalido!');
    }

    static function validateQueryRequest(Request $request, string $paramName)
    {
        if ($request->filled($paramName)) {
            // Valida Existencia Oferta
            return $request->query($paramName);
        } else {
            // Indefificador nulo
            Helper::raiseGeneralException('Parametro [' . $paramName . '] invalido!');
        }
    }

    // Parametro fks en formato: Array of Array [['status', '=', '1'],]
    static function checkIFOnlyOneValue(string $tableName, string $columName, string $value, array $fks, int $id = -1)
    {
        $result = false;

        $query = DB::table($tableName);
        if ($fks != null) {
            $query->where($fks);
        }
        $items = $query->where($columName, '=', $value)->get();

        if ($id == -1) {
            // Insert
            if ($items->count() == 0) {
                $result = true;
            }
        } else {
            // Update
            if ($items->count() == 0 || ($items->count() == 1 && $id == $items[0]->id)) {
                $result = true;
            }
        }
        return $result;
    }

    static function checkIFOnlyOneValueRequest(array $data, string $tableName, string $columName, string $value, array $fks, int $id = -1)
    {
        // Si se está intentando modificar el registro con la column = value
        return !(isset($data[$columName]) && $data[$columName] == $value && !self::checkIFOnlyOneValue($tableName, $columName, $value, $fks, $id));
    }

    static function checkIFOnlyOneValueReqFlgHab(array $data, string $tableName, array $fks, int $id = -1)
    {
        if (!self::checkIFOnlyOneValueRequest($data, $tableName, Col::TC_FLGHAB, Cons::SI, $fks, $id)) {
            Helper::raiseGeneralException('Ya existe un registro Habitual!');
        }
    }

    static function checkIFOnlyOneValueReqFlgXXX(array $data, string $tableName, string $column, string $value, string $columnMsg, array $fks, int $id = -1)
    {
        if (!self::checkIFOnlyOneValueRequest($data, $tableName, $column, $value, $fks, $id)) {
            Helper::raiseGeneralException('Ya existe un registro ' . $columnMsg . '!');
        }
    }

    /*
      // ***
        if ($cmd == 'report') {
            $res = false;
            $arr_direcciones_cliente = $direcciones_cliente->toArray();
            foreach ($arr_direcciones_cliente as $elem) {
                $el = Helper::convertStdClassToArray($elem);
                if ($el['flgadroferta'] === 'S') {
                    $res = true;
                    break;
                }
            }

            if ($res == false) {
                // Error
                Helper::raiseGeneralException('El cliente no tiene una dirección habitual para la oferta.');
            }
        }
        // ***
    */
    // Collection Illuminate\Support\Collection
    static function validateFieldStdClassOfCollection($collection, $nombre_campo, $valor_valido, $message)
    {
        $res = false;
        $arr_collection = $collection->toArray();
        foreach ($arr_collection as $elem) {
            $el = Helper::convertStdClassToArray($elem);
            if ($el[$nombre_campo] === $valor_valido) {
                $res = true;
                break;
            }
        }

        if ($res == false) {
            // Error
            Helper::raiseGeneralException($message);
        }
    }

    static function validateInputRequestID(Request $request)
    {
        if ($request->filled(Col::TC_ID)) {
            return $request->input(Col::TC_ID);
        } else {
            Helper::raiseGeneralException('Invalid ID!');
        }
    }

    static function validateIdFromDataArray($data)
    {
        if (array_key_exists(Col::TC_ID, $data) && !is_null($data[Col::TC_ID])) {
            return $data[Col::TC_ID];
        } else {
            Helper::raiseGeneralException('Invalid ID!');
        }
    }

    static function validateKeyNotNullArray($array, $key, &$val)
    {
        if (array_key_exists($key, $array) && !is_null($array[$key])) {
            $val = $array[$key];
            return true;
        }
        return false;
    }

    static function validateQueryRequestID(Request $request)
    {
        if ($request->filled(Col::TC_ID)) {
            return $request->query(Col::TC_ID);
        } else {
            Helper::raiseGeneralException('Invalid ID!');
        }
    }

    static function validateLimitRequest(Request $request)
    {
        if ($request->filled(Cons::LIMIT)) {
            return $request->query(Cons::LIMIT);
        } else {
            Helper::raiseGeneralException('Invalid Limit!');
        }
    }

    static function validatePageRequest(Request $request)
    {
        if ($request->filled(Cons::PAGE)) {
            return $request->query(Cons::PAGE);
        } else {
            Helper::raiseGeneralException('Invalid Page!');
        }
    }

    static function validator($validator)
    {
        if ($validator->fails()) {
            return response(['message' => $validator->errors()->first()], 433);
        }
    }

    static function validateAll(Request $request, Array $options, string &$func)
    {
        // Valida obligatorios
        $allowed = $request->all();
        if (!$request->filled(Cons::FORM_FUNC)) {
            Helper::raiseGeneralException('Datos invalidos! func');
        } else {
            $func = $request->input(Cons::FORM_FUNC);
        }
        return $allowed;
    }

    static function validateForInsert(Request $request, array &$data, array &$extras, string &$func)
    {
        if (!$request->filled(Cons::FORM_DATA)) {
            Helper::raiseGeneralException('Datos invalidos! data/base_data');
        } else {
            $data = $request->input(Cons::FORM_DATA);

            if (is_null($data)) {
                Helper::raiseGeneralException('Datos invalidos! data/base_data');
            }
        }

        if (!$request->filled(Cons::FORM_FUNC)) {
            Helper::raiseGeneralException('Datos invalidos! func');
        } else {
            $func = $request->input(Cons::FORM_FUNC);
        }

        if ($request->filled(Cons::FORM_EXTRAS)) {
            $extras = $request->input(Cons::FORM_EXTRAS);
        }
    }

    static function validateForUpdate(Request $request, array &$data, array &$base_data, array &$extras, int &$id, string &$func)
    {
        if (!$request->filled(Cons::FORM_DATA) || !$request->filled(Cons::FORM_BASE_DATA)) {
            Helper::raiseGeneralException('Datos invalidos! data/base_data');
        } else {
            $data = $request->input(Cons::FORM_DATA);
            $base_data = $request->input(Cons::FORM_BASE_DATA);

            if (is_null($data) || is_null($base_data)) {
                Helper::raiseGeneralException('Datos invalidos! data/base_data');
            }

            if ($data[Col::TC_ID] == null) {
                Helper::raiseGeneralException('Invalid ID!');
            } else {
                $id = $data[Col::TC_ID];
            }
        }

        if (!$request->filled(Cons::FORM_FUNC)) {
            Helper::raiseGeneralException('Datos invalidos! func');
        } else {
            $func = $request->input(Cons::FORM_FUNC);
        }

        if ($request->filled(Cons::FORM_EXTRAS)) {
            $extras = $request->input(Cons::FORM_EXTRAS);
        }
    }

    static function validateForDelete(Request $request, array &$data, array &$base_data, array &$extras, int &$id, string &$func)
    {
        if (!$request->filled(Cons::FORM_DATA) || !$request->filled(Cons::FORM_BASE_DATA)) {
            Helper::raiseGeneralException('Datos invalidos! data/base_data');
        } else {
            $data = $request->input(Cons::FORM_DATA);
            $base_data = $request->input(Cons::FORM_BASE_DATA);

            if (is_null($data) || is_null($base_data)) {
                Helper::raiseGeneralException('Datos invalidos! data/base_data');
            }

            if ($data[Col::TC_ID] == null) {
                Helper::raiseGeneralException('Invalid ID!');
            } else {
                $id = $data[Col::TC_ID];
            }
        }

        if (!$request->filled(Cons::FORM_FUNC)) {
            Helper::raiseGeneralException('Datos invalidos! func');
        } else {
            $func = $request->input(Cons::FORM_FUNC);
        }

        if ($request->filled(Cons::FORM_EXTRAS)) {
            $extras = $request->input(Cons::FORM_EXTRAS);
        }
    }

    static function validateForGetItem(Request $request, array &$id, array &$extras, string &$func)
    {
        if ($request->filled(Col::TC_ID)) {
            $id = $request->query(Col::TC_ID);
        } else {
            Helper::raiseGeneralException('Invalid ID!');
        }

        if (!$request->filled(Cons::FORM_FUNC)) {
            Helper::raiseGeneralException('Datos invalidos! func');
        } else {
            $func = $request->query(Cons::FORM_FUNC);
        }

        if ($request->filled(Cons::FORM_EXTRAS)) {
            $extras = $request->query(Cons::FORM_EXTRAS);
        }
    }


    static function validateForGetList(Request $request, array &$extras, string &$func)
    {
        if (!$request->filled(Cons::FORM_FUNC)) {
            // Helper::raiseGeneralException('Datos invalidos! func');
            $func = '#';
        } else {
            $func = $request->query(Cons::FORM_FUNC);
        }

        if ($request->filled(Cons::FORM_EXTRAS)) {
            $extras = $request->query(Cons::FORM_EXTRAS);
        }
    }

}
