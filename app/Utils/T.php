<?php
/**
 * Created by PhpStorm.
 * User: marcello.spedicato
 * Date: 30/11/2018
 * Time: 11:38
 */

namespace App\Utils;

/*
SELECT concat('const ', upper(TABLE_NAME), ' = ', '\'', lower(TABLE_NAME), '\'', ';') res
FROM INFORMATION_SCHEMA.TABLES t
WHERE TABLE_NAME like 'pto_%'
  AND TABLE_NAME not like '%old%'
  AND TABLE_NAME not like '%bck%'
  AND TABLE_SCHEMA = 'ping-crm-inertia'
  AND TABLE_TYPE = 'BASE TABLE'
order by table_name;
*/

class T
{
    const PTO_CAPITULOS = 'pto_capitulos';
    const PTO_DOCUMENTOS = 'pto_documentos';
    const PTO_GENERALES = 'pto_generales';
    const PTO_PARRAFOS = 'pto_parrafos';
}
