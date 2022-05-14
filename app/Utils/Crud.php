<?php


namespace App\Utils;

use App\Http\Controllers\ApiController;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Crud
{
    static function basicStore(Request $request, ApiController $object): JsonResponse
    {
        $func = '';
        $data = [];
        $extras = [];

        Validation::validateForInsert($request, $data, $extras, $func);

        try {
            DB::beginTransaction();

            $item = $object->getModelObject()->insertItem($data, $extras, $func);

            // More actions

            DB::commit();

            $item = $object->getModelObject()->getItem($item->id, $extras, $func);

            return TransactionResponse::handleResponseArrayDirect($item, Cons::OPE_STORE);

        } catch (QueryException $ex) {

            try {
                DB::rollBack();
            } catch (Exception $e) {
            }
            return SqlError::handleQueryException($ex, $object->getModelObject());

        } catch (Exception $ex) {

            try {
                DB::rollBack();
            } catch (Exception $e) {
            }
            return SqlError::handleException($ex);
        }
    }

    static function basicUpdate(Request $request, ApiController $object): JsonResponse
    {
        $json_result = [];
        $data = [];
        $base_data = [];
        $extras = [];
        $id = 0;
        $func = '';
        Validation::validateForUpdate($request, $data, $base_data, $extras, $id, $func);

        try {
            DB::beginTransaction();

            //
            $code = $object->getModelObject()->updateItem($id, $data, $base_data, $extras, $func, $json_result);
            if ($code !== 200) {
                DB::rollBack();
                // return TransactionResponse::handleResponseTrace('1', $json_result, 200);

                return TransactionResponse::handleResponseRequery($json_result, $code);
            }

            // More actions

            DB::commit();

            $r = $object->getModelObject()->getItem($id, $extras, $func);

            return TransactionResponse::handleResponseArrayDirect($r, Cons::OPE_UPDATE);

        } catch
        (QueryException $ex) {

            try {
                DB::rollBack();
            } catch (Exception $e) {
            }
            return SqlError::handleQueryException($ex, $object->getNombreModelo());

        } catch (Exception $ex) {

            try {
                DB::rollBack();
            } catch (Exception $e) {
            }
            return SqlError::handleException($ex);
        }
    }

    static function basicDestroy(Request $request, ApiController $object): JsonResponse
    {
        $data = [];
        $base_data = [];
        $extras = [];
        $id = 0;
        $func = '';
        Validation::validateForDelete($request, $data, $base_data, $extras, $id, $func);

        try {
            DB::beginTransaction();

            $item = $object->getModelObject()->deleteItem($id, $data, $base_data, $extras, $func);

            // More actions

            DB::commit();

            return TransactionResponse::handleResponse($item, Cons::OPE_DELETE);

        } catch (QueryException $ex) {

            try {
                DB::rollBack();
            } catch (Exception $e) {
            }
            return SqlError::handleQueryException($ex, $object->getNombreModelo());

        } catch (Exception $ex) {

            try {
                DB::rollBack();
            } catch (Exception $e) {
            }
            return SqlError::handleException($ex);
        }
    }

    static function basicGetItem(Request $request, ApiController $object): array
    {
        $func = '';
        $id = [];
        $extras = [];

        Validation::validateForGetItem($request, $id, $extras, $func);

        $item = $object->getModelObject()->getItem($id, $extras, $func);

        return $item;
    }

    static function basicGetList(Request $request, ApiController $object): array
    {
        $func = '';
        $extras = [];

        Validation::validateForGetList($request, $extras, $func);

        $items = $object->getModelObject()->getList($request, $extras, $func);

        return TransactionResponse::returnWithPagination($items);
    }

}
