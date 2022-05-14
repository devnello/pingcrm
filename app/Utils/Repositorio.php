<?php


namespace App\Utils;


class Repositorio
{

    /*
     * #---------------------------------------------------------------------------------------------
delete
from eng_des.rep_tablas;
# Inicializa sequencia
#
ALTER TABLE eng_des.rep_tablas
    AUTO_INCREMENT = 1;
#
INSERT INTO `eng_des`.`rep_tablas`
(table_name,
 created_user,
 updated_user,
 created_at,
 updated_at,
 proyecto_id)
select tab.TABLE_NAME,
       'MSP',
       'MSP',
       '2020-01-31 12:00:00',
       '2020-01-31 12:00:00',
       pro.id as project_id
from rep_proyectos pro,
     information_schema.TABLES tab
where pro.nombre = 'English DT'
  and tab.TABLE_SCHEMA = pro.project_schema
  and tab.TABLE_TYPE = 'BASE TABLE'
  and tab.TABLE_NAME like concat(pro.table_prefix, '_%');
#---------------------------------------------------------------------------------------------


# TABLAS del proyecto
select tab.id as tabla_id,
       col.COLUMN_NAME,
       #t.COLUMN_TYPE,
       #t.COLUMN_DEFAULT,
       #t.DATA_TYPE,
       tab.proyecto_id
from rep_proyectos pro,
     rep_tablas tab,
     information_schema.columns col
where pro.nombre = 'English DT'
  and tab.proyecto_id = pro.id
  #
  and col.TABLE_SCHEMA = pro.project_schema
  and col.TABLE_NAME = tab.TABLE_NAME;


#---------------------------------------------------------------------------------------------
delete
from eng_des.rep_columnas;
# Inicializa sequencia
#
ALTER TABLE eng_des.rep_columnas
    AUTO_INCREMENT = 1;
#
INSERT INTO `eng_des`.`rep_columnas`
(column_name,
 created_user,
 updated_user,
 created_at,
 updated_at,
 tabla_id,
 proyecto_id)
select col.COLUMN_NAME,
       'MSP',
       'MSP',
       '2020-01-31 12:00:00',
       '2020-01-31 12:00:00',
       tab.id as tabla_id,
       tab.proyecto_id
from rep_proyectos pro,
     rep_tablas tab,
     information_schema.columns col
where pro.nombre = 'English DT'
  and tab.proyecto_id = pro.id
  #
  and col.TABLE_SCHEMA = pro.project_schema
  and col.TABLE_NAME = tab.TABLE_NAME;
     */

}
