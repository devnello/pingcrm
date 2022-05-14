<?php
/**
 * Created by PhpStorm.
 * User: marcello.spedicato
 * Date: 13/08/2018
 * Time: 14:30
 */

namespace App\Utils;


use App\Exceptions\GeneralException;
use App\Models\Account;
use App\Models\Capitulo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use stdClass;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

use App\Utils\Tab;

class Helper
{
    static function getTimeStamp()
    {

        date_default_timezone_set('Europe/Madrid');
        return date('Y-m-d H:i:s');
    }

    static function getDate()
    {
        date_default_timezone_set('Europe/Madrid');
        return date('Y-m-d');
    }

    static function getYear()
    {
        $hoy = getdate();
        return $hoy['year'];
    }

    static function setInsertAudit(&$allowed_attributes)
    {
        $user = self::getUserName();
        $allowed_attributes[Col::TC_CREATED_USER] = $user;
        $allowed_attributes[Col::TC_UPDATED_USER] = $user;
    }

    static function updateAudit(&$allowed_attributes)
    {
        $user = self::getUserName();
        $allowed_attributes[Col::TC_UPDATED_AT] = Helper::getTimeStamp();
        $allowed_attributes[Col::TC_UPDATED_USER] = $user;
    }

    static function getSumaTabla($tabla, $where_array_conditions, $nombre_campo_sum)
    {
        // Where array condition
        //        [
        //            ['status', '=', '1'],
        //            ['subscribed', '<>', '1'],
        //        ]
        $query = DB::table($tabla)
            ->where($where_array_conditions)
            ->select(DB::raw('round(ifnull(sum(' . $nombre_campo_sum . '),0),2) as result '));

        $importe_total = $query->first();
        return $importe_total->result;
    }

    /*
     * getRecordCountByPedId('gpc_albaranes_ven', 'oferta_id', 92);
     */
    static function getSelectCountByFk($table_name, $fk_field_name, $fk_field_value)
    {
        $q = DB::table($table_name)
            ->where($fk_field_name, $fk_field_value)
            ->select(DB::raw('count(1) as result '))
            ->first();
        return $q->result;
    }

    static function getSelectSumByFk($table_name, $fk_field_name, $fk_field_value, $sum_field_name)
    {
        $q = DB::table($table_name)
            ->where($fk_field_name, $fk_field_value)
            ->select(DB::raw('round(ifnull(sum(' . $sum_field_name . '),0),2) as result '))
            ->first();
        return $q->result;
    }

    static function getMax($tabla, $nombre_campo_max, $where_array_conditions)
    {
        // Where array condition
        //        [
        //            ['status', '=', '1'],
        //            ['subscribed', '<>', '1'],
        //        ]
        $query = DB::table($tabla);

        if ($where_array_conditions != null) {
            $query->where($where_array_conditions);
        }
        $query->select(DB::raw('ifnull(max(' . $nombre_campo_max . '),0) as result '));

        $importe_total = $query->first();
        return $importe_total->result;
    }

    static function selView($tabla, $list_select_clause, $where_array_conditions)
    {
        $capitulo = DB::table($tabla);
        $capitulo = $capitulo->select(DB::raw($list_select_clause));
        foreach ($where_array_conditions as $item) {
                    $capitulo->where($item[0], $item[1], $item[2]);
                }
        return $capitulo->paginate(10);
    }

    // tiene que devolver una sola fila
    // Ejemplo de uso:
    //  $min_booklet_situacion = Helper::selTabla(Tab::ENG_MIN_BOOKLETS_SITUACION, '*', [[Col::TC_ID, '=', $booklet->min_booklet_situacion_id],[...]);

    static function selTabla($tabla, $list_select_clause, $where_array_conditions): StdClass
    {
        // Where array condition
        //        [
        //            ['status', '=', '1'],
        //            ['subscribed', '<>', '1'],
        //        ]
        $query = DB::table($tabla);

        $query->where($where_array_conditions);

        $query->select(DB::raw($list_select_clause));

        return $query->first();
    }

    static function checkIfExistsById($tabla, $id): bool
    {
        $query = DB::table($tabla)->where(Col::TC_ID, '=', $id);
        $record = $query->first();
        if ($record == null) {
            return false;
        } else {
            return true;
        }
    }

    static function getMaxMoreOne($tabla, $nombre_campo_max, $where_array_conditions)
    {
        return self::getMax($tabla, $nombre_campo_max, $where_array_conditions) + 1;
    }

    static function updTabla($tabla, $where_array_conditions, $set_array_values)
    {
        $timestamp = Helper::getTimeStamp();
        $user = Helper::getUserName();
        $arr = $set_array_values;

        // Añade user
        $arr[Col::TC_UPDATED_USER] = $user;
        $arr[Col::TC_UPDATED_AT] = $timestamp;
        // Todo: Añadir auditoria de user, created_user, updated_user
        if ($where_array_conditions != null) {
            return DB::table($tabla)->where($where_array_conditions)->update($arr);
        } else {
            return DB::table($tabla)->update($arr);
        }

    }

    static function delTabla($tabla, $where_array_conditions)
    {
        return DB::Table($tabla)->where($where_array_conditions)->delete();
    }

    static function insTabla($tabla, $array_values): int
    {
        $user = Helper::getUserName();
        $timestamp = date('Y-m-d H:i:s');
        $arr = $array_values;

        // Añade user
        $arr['created_user'] = $user;
        $arr['updated_user'] = $user;
        $arr['created_at'] = $timestamp;
        $arr['updated_at'] = $timestamp;
        // Todo: Añadir auditoria de user, created_user, updated_user
        // DB::table($tabla)->where($where_array_conditions)->update($arr);
        return DB::table($tabla)->insertGetId($arr);
    }


    // Convierte Año, mes en fechas de inicio y fin de mes
    static function convAnyoMesToFecIniFin($anyo, $mes, &$fecha_inicio, &$fecha_fin)
    {

        $d = cal_days_in_month(CAL_GREGORIAN, $mes, $anyo);
        $primerDiaMes = mktime(00, 00, 00, $mes, 1, $anyo);
        $ultimoDiaMes = mktime(23, 59, 59, $mes, $d, $anyo);

        $fecha_inicio = date(Cons::$dateFormatForQuery, $primerDiaMes);
        $fecha_fin = date(Cons::$dateFormatForQuery, $ultimoDiaMes);

    }

    static function getUserName()
    {
        $user = null;
        try {
            $user = Auth::user()->email;
        } catch (\Exception $e) {
            $user = 'JPT';
        }
        return $user;
    }

    static function fieldsFilterForUpdate($data, $allowed)
    {
        $filtered = array_filter(
            $data,
            function ($key) use ($allowed) {
                return in_array($key, $allowed);
            },
            ARRAY_FILTER_USE_KEY
        );
        $filtered['updated_user'] = self::getUserName();
        // Eliminar 'created_user' desde el update
        unset($filtered['created_user']);

        return $filtered;
    }


    static function getFillable($table_name)
    {
        $sql = "SELECT COLUMN_NAME column_name " .
            " FROM INFORMATION_SCHEMA.COLUMNS" .
            " WHERE table_name = " . '\'' . $table_name . '\'' .
            " AND table_schema = 'gpc_des' " .
            " AND COLUMN_NAME not in ('id', 'created_at', 'updated_at')" .
            " ORDER BY ORDINAL_POSITION";

        $result = DB::select(DB::raw($sql));

        // Convert array of stdClass to Array
        $arr_result = array();
        $index = 0;
        foreach ($result as $r) {
            $arr_result[$index++] = $r->column_name;
        }
        return $arr_result;
    }


    static function getModels(/*path*/)
    {

        // $path = app_path() . "/Models";
        $path = app_path() . "/";

        $out = [];
        $results = scandir($path);
        foreach ($results as $result) {
            if ($result === '.' || $result === '..') {
                continue;
            }
            $filename = $path . '/' . $result;
            if (is_dir($filename)) {
                $out = array_merge($out, getModels($filename));
            } else {
                $out[] = substr($filename, 0, -4);
            }
        }
        return $out;
    }

    static function calcValorDescontado($val, $porcentaje_descuento)
    {
        return $val - ($val * $porcentaje_descuento / 100);
    }

    static function calcIncrementoPercentual($val, $incremento)
    {
        return $val + ($val * $incremento / 100);
    }

    public function getMaxItem($table_name, $id, $parent_id)
    {

        $q = DB::table($table_name)
            ->where($parent_id, $id)
            ->select(DB::raw('ifnull(max(item),0) as result '));
        $importe_total = $q->first();

        return $importe_total->result;
    }

    static function single_quoted($v)
    {
        return '\'' . $v . '\'';
    }

    static function double_quoted($v)
    {
        return '\"' . $v . '\"';
    }


    // Para update
//    static function checkFlgHabHasDuplicateWithRaise($sourceTableName, $tableNameForMessage, $flghab, $parentFieldName, $parentFieldValue, $pkFieldName, $pkFieldValue)
//    {
//        $_pkFieldName = 'id';
//        if ($pkFieldName != null) {
//            $_pkFieldName = $pkFieldName;
//        }
//
//        if (isset($flghab)) {
//            if ($flghab == 'S') {
//                $result = DB::table($sourceTableName)->where($parentFieldName, $parentFieldValue)->where('flghab', 'S')->select($_pkFieldName . ' as pkFieldName')->first();
//                if ($result != null) {
//                    $message = 'Ya existe un ' . $tableNameForMessage . ' habitual!';
//                    if ($_pkFieldName != null) {
//                        // *Update* comprueba que no se el mismo
//                        if ($result->pkFieldName != $pkFieldValue) {
//                            throw (new GeneralException($message))->withData(['key' => 'value']);
//                        }
//                    } else {
//                        // *Insert*
//                        throw (new GeneralException($message))->withData(['key' => 'value']);
//                    }
//                }
//            }
//        }
//    }

    // VALIDACIONES

    static function validateIsNotNull($variable, $messageIfRaise)
    {
        if (isset($variable)) {
            return $variable;
        } else {
            throw (new GeneralException($messageIfRaise))->withData(['key' => 'value']);
        }
    }

    static function raiseExceptionForNull($field)
    {
        $msg = null;
        if (isset(Cons::exceptionMessage[$field])) {
            $msg = Cons::exceptionMessage[$field];
        } else {
            $msg = 'Identificador nulo: ' . $field;
        }
        throw (new GeneralException($msg))->withData(['key' => 'value']);
    }

    static function raiseGeneralException($message)
    {
        throw (new GeneralException($message))->withData(['key' => 'value']);
    }

    static function convertArrayToStdClass($array)
    {
        return json_decode(json_encode($array));
    }

    static function convertStdClassToArray($stdClass)
    {
        return json_decode(json_encode($stdClass), true);
    }

//$stdClass = json_decode(json_encode($booking));
//Converting an array/stdClass -> array
//The manual specifies the second argument of json_decode as:
//
//assoc
//When TRUE, returned objects will be converted into associative arrays.
//
//Hence the following line will convert your entire object into an array:
//


    static function arrayToObject($d)
    {
        if (is_array($d)) {
            /*
            * Return array converted to object
            * Using __FUNCTION__ (Magic constant)
            * for recursive call
            */
            // return (object)array_map(__FUNCTION__, $d);
            return (object)$d;
        } else {
            // Return object
            return $d;
        }
    }


    static function updateTableOrdByFactor($table_name, $fk_name, $fk_value, $factor)
    {
        $sql_statement = 'update ' . $table_name . ' set ord = ord * ' . $factor . ' where ' . $fk_name . ' = ' . $fk_value;
        DB::statement($sql_statement);
        // DB::Update(DB::raw($sql_statement), array('fk_name' => $fk_name, 'fk_value' => $fk_value, 'factor' => $factor));
    }

    static function orderOrd($table_name, $fk_name, $fk_value)
    {
        $items = DB::table($table_name)
            ->where($fk_name, $fk_value)
            //->where('flgact', 'A')
            //->whereNull('albaran_ven_id')
            // ->whereNotNull('albaran_ven_id')
            ->orderBy(Col::TC_ORD, Cons::ORDER_BY_ASC)
            ->get();

        $index = 1;
        foreach ($items as $elem) {
            Helper::updTabla($table_name, [[Col::TC_ID, '=', $elem->id]], [Col::TC_ORD => $index++]);
        }
    }

    static function stripOutAllSpaces($text)
    {
        // $string = str_replace(' ', '', $text);
        $string = preg_replace('/\s+/', '', $text);
        return strtolower($string);
    }

    /*
    static function insertIntoTrace($query)
    {
        $arr['texto'] = $query->tosql();
        Helper::insTabla(Tab::ENG_MIN_TRACES, $arr);
    }

    static function deleteTrace()
    {
        Helper::delTabla(Tab::ENG_MIN_TRACES, []);
    }
    */
}
