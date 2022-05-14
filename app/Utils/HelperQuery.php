<?php
/**
 * Created by PhpStorm.
 * User: devnello
 * Date: 10/03/2019
 * Time: 18:55
 */

namespace App\Utils;

use Illuminate\Http\Request;


class HelperQuery
{

    static function addParamWhereCond(Request $request, $query, $column_name)
    {
        if ($request->filled($column_name)) {
            return $query->where($column_name, '=', $request->query($column_name));
        }
        return $query;
    }

    static function addFlgactQueryCond(Request $request, $query)
    {
        if ($request->filled(Col::TC_FLGACT) && $request->query(Col::TC_FLGACT) != Cons::FLGACT_TODOS) {
            return $query->where(Col::TC_FLGACT, '=', $request->query(Col::TC_FLGACT));
        }
        return $query;
    }

    static function addWhereLikeCond(Request $request, $query, array $whereCond)
    {
        foreach ($whereCond as $columna) {
            if ($request->filled($columna)) {
                $query->where($columna, 'like', '%' . $request->query($columna) . '%');
                // $query->where($columna, 'like', $request->query($columna));
            }
        }
        return $query;
    }

    static function addWhereConstantCond(Request $request, $query, array $whereCond)
    {
        foreach ($whereCond as $columna) {
            if (isset($columna)) {
                $query->where($columna[0], $columna[1], $columna[2]);
            }
        }
        return $query;
    }

    static function addWhereEqualCond(Request $request, $query, array $whereCond)
    {
        foreach ($whereCond as $columna) {
            if ($request->filled($columna)) {
                $query->where($columna, '=', $request->query($columna));
            }
        }
        return $query;
    }

    static function addOrderByCond(Request $request, $query, array $orderByCond)
    {
        foreach ($orderByCond as $columna => $value) {
//            if ($request->filled('sort')) {
//                if ($request->query('sort') == '+id') {
//                    $query->orderBy($columna, 'ASC');
//                } else {
//                    $query->orderBy($columna, 'DESC');
//                }
//            }
            $query->orderBy($columna, $value);
        }
        return $query;
    }

    static function addOrderByWithDirectionCond(Request $request, $query, array $orderByCond, array $orderByDirectionCond)
    {
        foreach ($orderByCond as $columna) {
            $direction = $orderByDirectionCond[$columna];
            $query->orderBy($columna, $direction);
//                if ($request->query('sort') == '+id') {
//
//                    $query->orderBy($columna, 'ASC');
//                } else {
//                    $query->orderBy($columna, 'DESC');
//                }
        }
        return $query;
    }

}
