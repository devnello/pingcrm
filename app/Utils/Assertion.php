<?php
/**
 * Created by PhpStorm.
 * User: devnello
 * Date: 10/03/2019
 * Time: 20:26
 */

namespace App\Utils;

use Illuminate\Http\Request;


class Assertion
{

    static function assertIDFilled(Request $request)
    {
        if ($request->filled(Col::TC_ID)) {
            return $request->input(Col::TC_ID);
        } else {
            Helper::raiseGeneralException('Parametro invalido!');
            // return response()->json(['code' => 404, 'message' => 'ID is null'], 404);
        }
    }

    static function assertInputFilled(Request $request, $input)
    {
        if ($request->filled($input)) {
            return $request->input($input);
        } else {
            Helper::raiseGeneralException('Input invalido!');
            // return response()->json(['code' => 404, 'message' => 'ID is null'], 404);
        }
    }

}