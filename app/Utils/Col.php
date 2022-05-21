<?php
/**
 * Created by PhpStorm.
 * User: marcello.spedicato
 * Date: 07/03/2019
 * Time: 7:55
 */

namespace App\Utils;

/*
select distinct CONCAT('const TC_', upper(c.COLUMN_NAME), ' = ', '''', lower(c.COLUMN_NAME), '''', ';') col
                # t.TABLE_NAME
FROM INFORMATION_SCHEMA.COLUMNS c,
     information_schema.tables t
where t.TABLE_SCHEMA = c.table_schema
and t.TABLE_NAME = c.table_name
and t.table_schema = 'gpc_des'
and t.table_type = 'BASE TABLE' # 'VIEW'
AND t.TABLE_NAME like 'gpc_%'
AND t.TABLE_NAME not like '%old%'
AND t.TABLE_NAME not like '%bck%'
AND t.TABLE_NAME not like '%original%'
AND t.TABLE_NAME not like '%temp%'
  #and c.COLUMN_NAME like '%apelli%';
ORDER BY c.COLUMN_NAME;

select distinct CONCAT('const VC_', upper(c.COLUMN_NAME), ' = ', '''', lower(c.COLUMN_NAME), '''', ';') col
                # t.TABLE_NAME
FROM INFORMATION_SCHEMA.COLUMNS c,
     information_schema.tables t
where t.TABLE_SCHEMA = c.table_schema
  and t.TABLE_NAME = c.table_name
  and t.table_schema = 'gpc_des'
  and t.table_type = 'VIEW'
  AND t.TABLE_NAME like 'v_gpc_%'
  AND t.TABLE_NAME not like '%old%'
  AND t.TABLE_NAME not like '%bck%'
  AND t.TABLE_NAME not like '%original%'
  AND t.TABLE_NAME not like '%temp%'
  #and c.COLUMN_NAME like '%apelli%';
ORDER BY c.COLUMN_NAME;
*/

use Illuminate\Database\Eloquent\Model;

class Col
{

    const TC_CAPITULO_ID = 'capitulo_id';
    const TC_CODIGO = 'codigo';
    const TC_CREATED_AT = 'created_at';
    const TC_CREATED_USER = 'created_user';
    const TC_DELETED_AT = 'deleted_at';
    const TC_DESCRIPCION = 'descripcion';
    const TC_DOCUMENTO_ID = 'documento_id';
    const TC_FLGACT = 'flgact';
    const TC_FLG_PREF = 'flg_pref';
    const TC_ID = 'id';
    const TC_IMAGEN = 'imagen';
    const TC_ORDEN = 'orden';
    const TC_PUBLICADO = 'publicado';
    const TC_UPDATED_AT = 'updated_at';
    const TC_UPDATED_USER = 'updated_user';
    const TC_USER_ID = 'user_id';

    const VC_CAPITULO_ID = 'capitulo_id';
    const VC_CAP_DESCRIPCION = 'cap_descripcion';
    const VC_CAP_FLGACT = 'cap_flgact';
    const VC_CAP_ORDEN = 'cap_orden';
    const VC_CAP_PUBLICADO = 'cap_publicado';
    const VC_DELETED_AT = 'deleted_at';
    const VC_DOCUMENTO_ID = 'documento_id';
    const VC_DOCUMENT_ID = 'document_id';
    const VC_DOC_DESCRIPCION = 'doc_descripcion';
    const VC_DOC_FLGACT = 'doc_flgact';
    const VC_DOC_ORDEN = 'doc_orden';
    const VC_DOC_PUBLICADO = 'doc_publicado';
    const VC_ID = 'id';
    const VC_PAR_DESCRIPCION = 'par_descripcion';
    const VC_PAR_FLGACT = 'par_flgact';
    const VC_PAR_ORDEN = 'par_orden';
    const VC_USER_ID = 'user_id';



    static function setArrayFromArray(array &$destino_arr, Model $origen_arr, string $key)
    {
        $destino_arr[$key] = $origen_arr[$key];
    }

    static function setArrayFromValue(array &$destino_arr, string $key, $valor)
    {
        $destino_arr[$key] = $valor;
    }

}
