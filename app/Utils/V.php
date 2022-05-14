<?php
/**
 * Created by PhpStorm.
 * User: marcello.spedicato
 * Date: 30/11/2018
 * Time: 11:55
 */

namespace App\Utils;

/*
SELECT concat('const ', upper(TABLE_NAME), ' = ', '\'', lower(TABLE_NAME), '\'', ';') res
FROM INFORMATION_SCHEMA.TABLES t
WHERE TABLE_NAME like 'v_gpc_%'
AND TABLE_NAME not like '%old%'
AND TABLE_NAME not like '%bck%'
AND TABLE_SCHEMA = 'gpc_des'
AND TABLE_TYPE = 'VIEW'
order by table_name;
*/

class V
{
    const V_PTO_CAPITULOS_00 = 'v_pto_capitulos_00';
    const V_PTO_DOCUMENTOS_00 = 'v_pto_documentos_00';
    const V_PTO_PARRAFOS_00 = 'v_pto_parrafos_00';
}
