<?php
/**
 * Created by PhpStorm.
 * User: devnello
 * Date: 12/10/2018
 * Time: 11:49
 */

namespace App\Utils;


class Cons
{

    /*
Instalación de Laravel 5.7
Encryption keys generated successfully.
Personal access client created successfully.
Client ID: 1
Client Secret: zYtwBixnUuPxQybXPHoBwMOXaYNACnKIZPJ2glWt
Password grant client created successfully.
Client ID: 2
Client Secret: 2U6DCACWry0fwjoZp1cC6JqHNcR3U162psfUnd5U

     */

    /*
    const MESSAGE_TOPIC = 'topic_name';
    const MESSAGE_BODY = 'body';
    const MESSAGE_ID = 'message_id';
    const MESSAGE_STATUS = 'status';
    const MESSAGE_UPDATED_AT = 'updated_at';
    const MESSAGE_QUEUE_ID = 'queue_id';
    const MESSAGE_QUEUE_NAME = 'queue_name';
    const MESSAGE_QUEUE_RELATION_ID = 'relation_id';
    const MESSAGE_NUMBER_OF_TRIALS = 'retries';
    */
    const SI = 'S';
    const NO = 'N';

    const CONTEXT = 'context';

    const ORDER_BY_ASC = 'asc';
    const ORDER_BY_DESC = 'desc';

    const LIMIT = 'limit';
    const PAGE = 'page';

    const CMD = 'cmd';
    const CMD_REPORT = 'report';

    const FORM_DATA = 'data';
    const FORM_BASE_DATA = 'base_data';
    const FORM_EXTRAS = 'extras';
    const FORM_FUNC = 'func';

    //
    const MIN_PALABRAS_UPD_FUNC_BASIC = '#';
    const MIN_PALABRAS_UPD_FUNC_ACTUALIZA_LISTA = 'CL';


    const AGRUPACION = 'agrupacion';

    const DIA_LABORABLES_POR_SEMANA = 5;
    const DIA_FESTIVOS_POR_SEMANA = 2;

    // Nemeradores Oferta
    const ROLE_ADMIN = 'admin';
    const ROLE_RESPONSABLE = 'responsable';
    const ROLE_EMPLEADO = 'empleado';

    // Nemeradores Oferta
    const NUM_OFERTA_ESTADO_USO = 'uso';
    const NUM_OFERTA_ESTADO_BLOQ = 'bloqueado';
    const NUM_OFERTA_ESTADO_DISP = 'disponible';

    // Estado Oferta
    // // ENUM('preparacion', 'enviada', 'rechazada', 'curso', 'finalizada', 'anulada', 'suspendida', 'aceptada', 'facturada', 'cobro')
    const ESTADO_OFERTA_PREPARACION = 'preparacion';
    const ESTADO_OFERTA_ENVIADA = 'enviada';
    const ESTADO_OFERTA_RECHAZADA = 'rechazada';
    const ESTADO_OFERTA_CURSO = 'curso';
    const ESTADO_OFERTA_FINALIZADA = 'finalizada';
    const ESTADO_OFERTA_ANULADA = 'anulada';
    const ESTADO_OFERTA_SUSPENDIDA = 'suspendida';
    const ESTADO_OFERTA_ACEPTADA = 'aceptada';
    const ESTADO_OFERTA_FACTURADA = 'facturada';
    const ESTADO_OFERTA_COBRO = 'cobro';

    // Tipo Oferta
    const TIPO_OFERTA_ADM = 'ADM';
    const TIPO_OFERTA_OFE = 'OFE';
    const TIPO_OFERTA_INT = 'INT';
    const TIPO_OFERTA_PAR = 'PAR'; // Oferta particcionada.
    const TIPO_OFERTA_SUB = 'SUB'; // Sub-Oferta de una oferta particcionada.

    // Tipo Albarán
    const TIPO_ALBARAN_PER = 'per';
    const TIPO_ALBARAN_OFE = 'ofe';
    const TIPO_ALBARAN_MAN = 'man';

    // Tipo Titulo Albarán
    const TIPO_TITULO_ALBARAN_TITULO = 'Tab';
    const TIPO_TITULO_ALBARAN_DESCR = 'D';
    const TIPO_TITULO_ALBARAN_PEDIDO = 'P';

    // Tipo Articulo
    const TIPO_ARTICULO_TAREA = 'Tab';
    const TIPO_ARTICULO_MATERIAL = 'M';
    const TIPO_ARTICULO_GASTO = 'G';
    const TIPO_ARTICULO_VARIO = 'View';

    // Unidades mesura
    const UNIDAD_MESURA_HORA = 'H';
    const UNIDAD_MESURA_UNI = 'UN';
    const UNIDAD_MESURA_MT = 'MT';

    // Estados Albaran Ven
    const ALBARAN_ESTADO_PREPARACION = 'preparacion';
    const ALBARAN_ESTADO_FACTURADO = 'facturado';
    const ALBARAN_ESTADO_ANULADO = 'anulado';

    // Estados TMG_PREVISTO
    const TMG_PREVISTO_ESTADO_NUEVO = 'nuevo';
    const TMG_PREVISTO_ESTADO_CURSO = 'curso';
    const TMG_PREVISTO_ESTADO_ALBARANADO = 'albaranado';
    const TMG_PREVISTO_ESTADO_FACTURADO = 'facturado';

    // Estados TMG_REALIZADO
    const TMG_REALIZADO_ESTADO_PENDIENTE = 'pendiente';
    const TMG_REALIZADO_ESTADO_RECHAZADO = 'rechazado';
    const TMG_REALIZADO_ESTADO_APROBADO = 'aprobado';
    const TMG_REALIZADO_ESTADO_ENVIADO = 'enviado';
    const TMG_REALIZADO_ESTADO_ALBARANADO = 'albaranado';
    const TMG_REALIZADO_ESTADO_FACTRURADO = 'facturado';

    // Valores flgact
    const FLGACT_TODOS = 'Tab';
    const FLGACT_ACTIVOS = 'A';
    const FLGACT_INACTIVOS = 'I';

    // Tipo Operaciones
    const OPE_QUERY = 'query';
    const OPE_DELETE = 'delete';
    const OPE_STORE = 'store';
    const OPE_UPDATE = 'update';

    // Commands
    const CMD_STORE = 'store';


    const C_MESSAGE = 'message';


    // ESTADOS: OFERTA
    // estado_oferta     enum ('preparacion', 'enviada', 'rechazada', 'curso', 'finalizada', 'anulada', 'suspendida', 'aceptada', 'facturada', 'cobro') not null,

    const exceptionMessage = [
        'command' => 'Comando indefinido',
        'id' => 'Identificador nulo!',
        'oferta_id' => 'Identificador de Oferta nulo!',
        'tipo_oferta' => 'Tipo de Oferta nulo!',
        'fecha_inicio' => 'Fecha de fin es inexistente!',
        'fecha_fin' => 'Fecha de fin es inexistente!',
        'flg_tarea' => 'Flg tarea es inexistente!',
        'flg_material' => 'Flg material es inexistente!',
        'flg_gasto' => 'Flg gasto es inexistente!'];

    static $dateFormatForQuery = 'Y-m-d H:i:s';


    // Direcciones de Envio
    //
    const DIR_ENV_ALB = 'alb';
    const DIR_ENV_FAC = 'fac';
    const DIR_ENV_PED = 'ped';
    const DIR_ENV_OFE = 'ofe';

    // Tipo de Contacto
    //
    const TIP_CONT_RES = 'res';
    const TIP_CONT_HAB = 'hab';

    // Listas
    const LISTA_INICIO = 0;
    const LISTA_PRIMER_INTENTO = 1;
    const LISTA_ANTES_DEFINITIVA = 2;
    const LISTA_1_INTENTO_OK = 4;
    const LISTA_1_INTENTO_NOT = 5;

    const LISTA_DEFINITIVA = 100;

    const RESP_OK = 1;
    const RESP_NOT_OK = 0;
    const RESP_AUT = 2;

    const CODE = 'code';

    // define( 'KB_IN_BYTES', 1024 ); Define una constante con nombre en tiempo de ejecución.

    static function getSelectListForSelFunc($p_id_sel_alias, $p_id_sel, $p_label_sel_alias, $p_label_sel, $p_alias)
    {
        $v_id_sel_alias = '';
        if (isset($p_id_sel_alias) && $p_id_sel_alias != '') {
            $v_id_sel_alias = $p_id_sel_alias . '.';
        }

        $v_label_sel_alias = '';
        if (isset($p_label_sel_alias) && $p_label_sel_alias != '') {
            $v_label_sel_alias = $p_label_sel_alias . '.';
        }

        return $v_id_sel_alias . $p_id_sel . ' as value, ' . $v_label_sel_alias . $p_label_sel . ' as label,' . self::getSelectListForSelFuncOnlyFlgAct($p_alias);
    }

    static function getSelectListForSelFuncOnlyFlgAct($p_alias)
    {
        $v_alias = '';
        if (isset($p_alias) && $p_alias != '') {
            $v_alias = $p_alias . '.';
        }

        return ' IF(' . $v_alias . 'flgact=' . '\'' . 'A' . '\'' . ', ' . '\'' . 'S' . '\'' . ', ' . '\'' . 'N' . '\'' . ') as activo';
    }
}
