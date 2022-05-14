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

    const TC_ACT = 'act';
    const TC_ACT1 = 'act1';
    const TC_ACT2 = 'act2';
    const TC_ACT3 = 'act3';
    const TC_ACT4 = 'act4';
    const TC_ACT5 = 'act5';
    const TC_ACT6 = 'act6';
    const TC_ACT7 = 'act7';
    const TC_ADJ_COMPARATIVE = 'adj_comparative';
    const TC_ADJ_SUPERLATIVE = 'adj_superlative';
    const TC_ADVERB = 'adverb';
    const TC_AD_COMARCA = 'ad_comarca';
    const TC_AD_CP = 'ad_cp';
    const TC_AD_PART1 = 'ad_part1';
    const TC_AD_PART2 = 'ad_part2';
    const TC_AD_POBLACIO = 'ad_poblacio';
    const TC_AD_POBLACION = 'ad_poblacion';
    const TC_ALBARAN_VEN_ID = 'albaran_ven_id';
    const TC_ANY = 'any';
    const TC_ANYO = 'anyo';
    const TC_APARTADO_3 = 'apartado_3';
    const TC_APARTADO_5 = 'apartado_5';
    const TC_APARTADO_6 = 'apartado_6';
    const TC_APARTADO_7 = 'apartado_7';
    const TC_APARTADO_8 = 'apartado_8';
    const TC_APARTADO_9 = 'apartado_9';
    const TC_APELLIDOS = 'apellidos';
    const TC_ARTICULO = 'articulo';
    const TC_AUX = 'aux';
    const TC_BANCO = 'banco';
    const TC_BANCO_ID = 'banco_id';
    const TC_BASE_IMPONIBLE = 'base_imponible';
    const TC_BOOKLET_ID = 'booklet_id';
    const TC_CATEGORIA = 'categoria';
    const TC_CATEGORIA_EMPLEADO_ID = 'categoria_empleado_id';
    const TC_CIF = 'cif';
    const TC_CLAVE = 'clave';
    const TC_CLIENTE = 'cliente';
    const TC_CLIENTE_DIRECCION_ID = 'cliente_direccion_id';
    const TC_CLIENTE_DIRIGIDO_ID = 'cliente_dirigido_id';
    const TC_CLIENTE_ID = 'cliente_id';
    const TC_CLIENTE_RESPONSABLE_ID = 'cliente_responsable_id';
    const TC_CODI = 'codi';
    const TC_CODIADPROVEIDOR = 'codiadproveidor';
    const TC_CODICLIENT = 'codiclient';
    const TC_CODICONPROVEIDOR = 'codiconproveidor';
    const TC_CODIFABMAT = 'codifabmat';
    const TC_CODIFAMMAT = 'codifammat';
    const TC_CODIGO = 'codigo';
    const TC_CODIGO_CLI = 'codigo_cli';
    const TC_CODIGO_CLIENTE = 'codigo_cliente';
    const TC_CODIGO_EMPLEADO = 'codigo_empleado';
    const TC_CODIGO_PAIS = 'codigo_pais';
    const TC_CODIGO_PEDIDO = 'codigo_pedido';
    const TC_CODIGO_PEDIDO_CLI = 'codigo_pedido_cli';
    const TC_CODIGO_POSTAL = 'codigo_postal';
    const TC_CODIGO_PROV = 'codigo_prov';
    const TC_CODIGO_PROVEEDOR = 'codigo_proveedor';
    const TC_CODIMATERIAL = 'codimaterial';
    const TC_CODIPROV = 'codiprov';
    const TC_CODIPROVEIDOR = 'codiproveidor';
    const TC_CODITRAN = 'coditran';
    const TC_COMANDA = 'comanda';
    const TC_COMARCA = 'comarca';
    const TC_COMPLETO = 'completo';
    const TC_COMPRIMIDO = 'comprimido';
    const TC_SPA_COMPRIMIDO = 'spa_comprimido';
    const TC_ENG_COMPRIMIDO = 'eng_comprimido';
    const TC_CONCEPTO = 'concepto';
    const TC_CONCEPTO_GASTO_ID = 'concepto_gasto_id';
    const TC_CONIUGACION_ID = 'coniugacion_id';
    const TC_CONTRATO_LABORAL_ID = 'contrato_laboral_id';
    const TC_CP = 'cp';
    const TC_CREATED_AT = 'created_at';
    const TC_CREATED_USER = 'created_user';
    const TC_CUANTIDAD = 'cuantidad';
    const TC_D1 = 'd1';
    const TC_D2 = 'd2';
    const TC_D3 = 'd3';
    const TC_D4 = 'd4';
    const TC_D5 = 'd5';
    const TC_D6 = 'd6';
    const TC_D7 = 'd7';
    const TC_DEPARTAMENTO = 'departamento';
    const TC_DESCRIPCION = 'descripcion';
    const TC_DESCUENTO = 'descuento';
    const TC_DESCUENTO_ACTUAL = 'descuento_actual';
    const TC_DESC_PEDIDO_CLI = 'desc_pedido_cli';
    const TC_DIAS_VACACIONES_ANUAL = 'dias_vacaciones_anual';
    const TC_DIA_MES = 'dia_mes';
    const TC_DIA_PAGAMENTO = 'dia_pagamento';
    const TC_DIA_PAGO = 'dia_pago';
    const TC_DIA_SEMANA = 'dia_semana';
    const TC_DICCIONARIO_COLOCACION_ID = 'diccionario_colocacion_id';
    const TC_DICCIONARIO_DESTINO_ID = 'diccionario_destino_id';
    const TC_DICCIONARIO_ID = 'diccionario_id';
    const TC_DICCIONARIO_ORIGEN_ID = 'diccionario_origen_id';
    const TC_DIGITO_CONTROL = 'digito_control';
    const TC_DIRECCION = 'direccion';
    const TC_DISTANCIA_KM = 'distancia_km';
    const TC_DOCUMENTO_IDENTIDAD = 'documento_identidad';
    const TC_DTE = 'dte';
    const TC_EMAIL = 'email';
    const TC_EMPLEADO_ID = 'empleado_id';
    const TC_ENG_FRASE = 'eng_frase';
    const TC_ENG_SENTENCE = 'eng_sentence';
    const TC_EPL_FIRMA_OFERTA_ID = 'epl_firma_oferta_id';
    const TC_EPL_RESP_OFERTA_ID = 'epl_resp_oferta_id';
    const TC_ESTADO = 'estado';
    const TC_ESTADO_ANTERIOR = 'estado_anterior';
    const TC_ESTADO_OFERTA = 'estado_oferta';
    const TC_F1 = 'f1';
    const TC_F2 = 'f2';
    const TC_F3 = 'f3';
    const TC_F4 = 'f4';
    const TC_F5 = 'f5';
    const TC_F6 = 'f6';
    const TC_F7 = 'f7';
    const TC_FABRICANTE = 'fabricante';
    const TC_FABRICANTE_ID = 'fabricante_id';
    const TC_FACTURA_VEN_DET_ID = 'factura_ven_det_id';
    const TC_FACTURA_VEN_ID = 'factura_ven_id';
    const TC_FAMILIA_ID = 'familia_id';
    const TC_FAX = 'fax';
    const TC_FECHA = 'fecha';
    const TC_FECHA_ACEPTADA = 'fecha_aceptada';
    const TC_FECHA_ACT_OFERTA = 'fecha_act_oferta';
    const TC_FECHA_ACT_PRECIOS = 'fecha_act_precios';
    const TC_FECHA_ANULADA = 'fecha_anulada';
    const TC_FECHA_BLOQUEO = 'fecha_bloqueo';
    const TC_FECHA_COBRO = 'fecha_cobro';
    const TC_FECHA_ENCURSO = 'fecha_encurso';
    const TC_FECHA_ENTREGA = 'fecha_entrega';
    const TC_FECHA_ENVIO = 'fecha_envio';
    const TC_FECHA_FACTURACION = 'fecha_facturacion';
    const TC_FECHA_FIN = 'fecha_fin';
    const TC_FECHA_FINALIZADA = 'fecha_finalizada';
    const TC_FECHA_FIN_PERIDO = 'fecha_fin_perido';
    const TC_FECHA_FIN_PERIODO = 'fecha_fin_periodo';
    const TC_FECHA_FIN_PREVISTA = 'fecha_fin_prevista';
    const TC_FECHA_FIN_REAL = 'fecha_fin_real';
    const TC_FECHA_INICIO = 'fecha_inicio';
    const TC_FECHA_INICIO_PERIODO = 'fecha_inicio_periodo';
    const TC_FECHA_NACIMIENTO = 'fecha_nacimiento';
    const TC_FECHA_PREPARACION = 'fecha_preparacion';
    const TC_FECHA_RECEPCION = 'fecha_recepcion';
    const TC_FECHA_RECHAZADA = 'fecha_rechazada';
    const TC_FECHA_RESPUESTA = 'fecha_respuesta';
    const TC_FECHA_SOLICITUD = 'fecha_solicitud';
    const TC_FECHA_SUSPENDIDA = 'fecha_suspendida';
    const TC_FECHA_ULT_TEST = 'fecha_ult_test';
    const TC_FECHA_VENCIMIENTO = 'fecha_vencimiento';
    const TC_FESTIVO = 'festivo';
    const TC_FIRMA = 'firma';
    const TC_FIRMA_BLOB = 'firma_blob';
    const TC_FLGACT = 'flgact';
    const TC_FLGADRALBARAN = 'flgadralbaran';
    const TC_FLGADRFACTURA = 'flgadrfactura';
    const TC_FLGADROFERTA = 'flgadroferta';
    const TC_FLGADRPEDIDO = 'flgadrpedido';
    const TC_FLGAUSENCIA = 'flgausencia';
    const TC_FLGFIRMAOFE = 'flgfirmaofe';
    const TC_FLGHAB = 'flghab';
    const TC_FLGOBS = 'flgobs';
    const TC_FLGPROEMP = 'flgproemp';
    const TC_FLGRES = 'flgres';
    const TC_FLGRESPOFE = 'flgrespofe';
    const TC_FLGUSO = 'flguso';
    const TC_FORMA_ENVIO = 'forma_envio';
    const TC_FORMA_PAGO = 'forma_pago';
    const TC_FORMA_PAGO_ID = 'forma_pago_id';
    const TC_FOTO_BLOB = 'foto_blob';
    const TC_FRASE_DESTINO_ID = 'frase_destino_id';
    const TC_FRASE_ID = 'frase_id';
    const TC_FRASE_ORIGEN_ID = 'frase_origen_id';
    const TC_FRASE_PAL_BKL_ID = 'frase_pal_bkl_id';
    const TC_GASTO_ANUAL_ID = 'gasto_anual_id';
    const TC_GASTO_PREVISTO_ID = 'gasto_previsto_id';
    const TC_GASTO_PREVISTO_REALIZADO_ID = 'gasto_previsto_realizado_id';
    const TC_GASTO_REALIZADO_ID = 'gasto_realizado_id';
    const TC_GRUPO = 'grupo';
    const TC_GRUPO_COLLOCACION_ID = 'grupo_collocacion_id';
    const TC_GRUPO_FRASE_DET_ID = 'grupo_frase_det_id';
    const TC_GRUPO_FRASE_ID = 'grupo_frase_id';
    const TC_GRUPO_MATERIAL_PREVISTO_ID = 'grupo_material_previsto_id';
    const TC_HORAS = 'horas';
    const TC_HORAS_ANUALES_EMPLEADO = 'horas_anuales_empleado';
    const TC_HORAS_PREPARACION = 'horas_preparacion';
    const TC_HORAS_SEMANALES = 'horas_semanales';
    const TC_IBAN = 'iban';
    const TC_ID = 'id';
    const TC_IDIOMA_DESTINO_ID = 'idioma_destino_id';
    const TC_IDIOMA_ESTUDIO_ID = 'idioma_estudio_id';
    const TC_IDIOMA_ID = 'idioma_id';
    const TC_IDIOMA_NATIVO_ID = 'idioma_nativo_id';
    const TC_IDIOMA_ORIGEN_ID = 'idioma_origen_id';
    const TC_ID_CLIENTE = 'id_cliente';
    const TC_ID_EMPLEADO = 'id_empleado';
    const TC_ID_OFERTA = 'id_oferta';
    const TC_ID_REQUERIMIENTO = 'id_requerimiento';
    const TC_ID_TIPO_TAREA = 'id_tipo_tarea';
    const TC_IMPORTE = 'importe';
    const TC_IMPORTE_ACEPTACION = 'importe_aceptacion';
    const TC_IMPORTE_FINAL = 'importe_final';
    const TC_IMPORTE_INCREMENTO = 'importe_incremento';
    const TC_IMPORTE_TOT_PEDIDO_VEN = 'importe_tot_pedido_ven';
    const TC_INCREMENTO = 'incremento';
    const TC_INFINITIVE = 'infinitive';
    const TC_ITEM = 'item';
    const TC_IVA = 'iva';
    const TC_LINGUISTICA_DESTINO_ID = 'linguistica_destino_id';
    const TC_LINGUISTICA_ID = 'linguistica_id';
    const TC_LINGUISTICA_ORIGEN_ID = 'linguistica_origen_id';
    const TC_LINGUISTICA_TITULO_ID = 'linguistica_titulo_id';
    const TC_LISTA = 'lista';
    const TC_LISTA_ESTUDIO_ID = 'lista_estudio_id';
    const TC_LISTA_FRA_DIC_LIN_ID = 'lista_fra_dic_lin_id';
    const TC_LISTA_TEST_ID = 'lista_test_id';
    const TC_LISTA_TEST_PAL_FRA_ID = 'lista_test_pal_fra_id';
    const TC_LIST_LUGAR = 'list_lugar';
    const TC_LIST_PIE_DE_PAGINA = 'list_pie_de_pagina';
    const TC_LOGO = 'logo';
    const TC_LOGO_BLOB = 'logo_blob';
    const TC_LSTORI = 'lstori';
    const TC_LSTTIP = 'lsttip';
    const TC_MARGEN = 'margen';
    const TC_MATERIAL_ENTREGADO_ID = 'material_entregado_id';
    const TC_MATERIAL_ID = 'material_id';
    const TC_MATERIAL_PREVISTO_ENTREGADO_ID = 'material_previsto_entregado_id';
    const TC_MATERIAL_PREVISTO_ID = 'material_previsto_id';
    const TC_MES = 'mes';
    const TC_MIN_BOOKLET_ID = 'min_booklet_id';
    const TC_MIN_BOOKLET_SITUACION_ID = 'min_booklet_situacion_id';
    const TC_MIN_PALABRA_ID = 'min_palabra_id';
    const TC_MIN_PALABRA_SITUACION_ID = 'min_palabra_situacion_id';
    const TC_MIN_TRADUCCION_ID = 'min_traduccion_id';
    const TC_MIN_VARIO_ID = 'min_vario_id';
    const TC_MOBIL = 'mobil';
    const TC_MOTIVO_ANULACION = 'motivo_anulacion';
    const TC_MOTIVO_RECHAZO = 'motivo_rechazo';
    const TC_MOTIVO_SUSPENSION = 'motivo_suspension';
    const TC_MOVIL = 'movil';
    const TC_NAME = 'name';
    const TC_NIVEL = 'nivel';
    const TC_NOMBRE = 'nombre';
    const TC_NOMBRE_CLIENTE = 'nombre_cliente';
    const TC_NOMBRE_CORTO = 'nombre_corto';
    const TC_NOMBRE_EMPRESA = 'nombre_empresa';
    const TC_NOMBRE_FORMA_PAGO = 'nombre_forma_pago';
    const TC_NOMBRE_PROVEEDOR = 'nombre_proveedor';
    const TC_NOMBRE_RESPONSABLE = 'nombre_responsable';
    const TC_NOMBRE_USUARIO = 'nombre_usuario';
    const TC_NOTA = 'nota';
    const TC_NOTAS_INTERNAS = 'notas_internas';
    const TC_NOTAS_OFERTA = 'notas_oferta';
    const TC_NUMERO = 'numero';
    const TC_NUMERO_OFERTA = 'numero_oferta';
    const TC_NUMPROVEIDOR = 'numproveidor';
    const TC_NUM_ACIERTOS_CONSECUTIVOS = 'num_aciertos_consecutivos';
    const TC_NUM_ALBARAN = 'num_albaran';
    const TC_NUM_ERRORES_CONSECUTIVOS = 'num_errores_consecutivos';
    const TC_NUM_FRASE = 'num_frase';
    const TC_NUM_LIBRO = 'num_libro';
    const TC_NUM_LISTA = 'num_lista';
    const TC_NUM_SERIE = 'num_serie';
    const TC_OBSERVACIONES = 'observaciones';
    const TC_OFERTA = 'oferta';
    const TC_OFERTA_ID = 'oferta_id';
    const TC_OFERTA_ORIGEN_ID = 'oferta_origen_id';
    const TC_OFERTA_PROVEEDOR = 'oferta_proveedor';
    const TC_OFERTA_SIGUIENTE_ID = 'oferta_siguiente_id';
    const TC_ORD = 'ord';
    const TC_PAGA_A = 'paga_a';
    const TC_PAGA_A_DIAS = 'paga_a_dias';
    const TC_PAIS = 'pais';
    const TC_PALABRA_ID = 'palabra_id';
    const TC_PARABLA_DST_ID = 'parabla_dst_id';
    const TC_PARABLA_ID = 'parabla_id';
    const TC_PARABRA_ORI_ID = 'parabra_ori_id';
    const TC_PART1 = 'part1';
    const TC_PART2 = 'part2';
    const TC_PART_1 = 'part_1';
    const TC_PART_2 = 'part_2';
    const TC_PASSWORD = 'password';
    const TC_PEDIDO_CMP_DET_ID = 'pedido_cmp_det_id';
    const TC_PEDIDO_CMP_ID = 'pedido_cmp_id';
    const TC_PEDIDO_ID = 'pedido_id';
    const TC_PHRASAL_VERB_ID = 'phrasal_verb_id';
    const TC_PHRASAL_VERB_TOPIC_ID = 'phrasal_verb_topic_id';
    const TC_PLAZO_ENTREGA_ID = 'plazo_entrega_id';
    const TC_POBLACION = 'poblacion';
    const TC_PORCENTAJE = 'porcentaje';
    const TC_PRECIO = 'precio';
    const TC_PRECIO_ACTUAL = 'precio_actual';
    const TC_PRECIO_COSTE = 'precio_coste';
    const TC_PRECIO_COSTE_NETO = 'precio_coste_neto';
    const TC_PRECIO_FACTURACION = 'precio_facturacion';
    const TC_PRECIO_HORA = 'precio_hora';
    const TC_PRECIO_INCREMENTADO = 'precio_incrementado';
    const TC_PRECIO_TOTAL = 'precio_total';
    const TC_PRECIO_UNITARIO = 'precio_unitario';
    const TC_PRECIO_VENTA_NETO = 'precio_venta_neto';
    const TC_PREPOSITION_1_ID = 'preposition_1_id';
    const TC_PREPOSITION_2_ID = 'preposition_2_id';
    const TC_PREPOSITION_ID = 'preposition_id';
    const TC_PRONOMBRE_PERSONAL_ID = 'pronombre_personal_id';
    const TC_PROVEEDOR_ID = 'proveedor_id';
    const TC_PROVINCIA = 'provincia';
    const TC_QTY = 'qty';
    const TC_REFERENCIA = 'referencia';
    const TC_REF_FABRICANTE = 'ref_fabricante';
    const TC_RESET_PASS = 'reset_pass';
    const TC_RESPONSABLE = 'responsable';
    const TC_RESULTADO = 'resultado';
    const TC_RESULTADO_DET_ID = 'resultado_det_id';
    const TC_RESULTADO_ID = 'resultado_id';
    const TC_ROLE = 'role';
    const TC_ROOT = 'root';
    const TC_SECTOR_ID = 'sector_id';
    const TC_SEMANA = 'semana';
    const TC_SITO_WEB = 'sito_web';
    const TC_SOLICITUDES_MATERIALES_PRO_ID = 'solicitudes_materiales_pro_id';
    const TC_SPA_ENG = 'spa_eng';
    const TC_SPA_FRASE = 'spa_frase';
    const TC_SPA_SENTENCE = 'spa_sentence';
    const TC_SUB_OFERTA_ID = 'sub_oferta_id';
    const TC_SUELDO_BRUTO_ANUAL = 'sueldo_bruto_anual';
    const TC_TAREA_PREVISTA_ID = 'tarea_prevista_id';
    const TC_TAREA_PREVISTA_REALIZADA_ID = 'tarea_prevista_realizada_id';
    const TC_TAREA_REALIZADA_HORA_DIA_ID = 'tarea_realizada_hora_dia_id';
    const TC_TARIFA_FESTIVO = 'tarifa_festivo';
    const TC_TARIFA_FESTIVO_NOCTURNO = 'tarifa_festivo_nocturno';
    const TC_TARIFA_HORARIO_LABORAL_ID = 'tarifa_horario_laboral_id';
    const TC_TARIFA_LABORAL = 'tarifa_laboral';
    const TC_TARIFA_LABORAL_NOCTURNO = 'tarifa_laboral_nocturno';
    const TC_TELEFONO = 'telefono';
    const TC_TELEFONO_1 = 'telefono_1';
    const TC_TELEFONO_2 = 'telefono_2';
    const TC_TEXTO = 'texto';
    const TC_TEXTO_COMPRIMIDO = 'texto_comprimido';
    const TC_TFIRMA = 'tfirma';
    const TC_TFOTO = 'tfoto';
    const TC_TIEMPO_ID = 'tiempo_id';
    const TC_TIPO = 'tipo';
    const TC_TIPOS_AUSENCIA_ID = 'tipos_ausencia_id';
    const TC_TIPO_ARTICULO = 'tipo_articulo';
    const TC_TIPO_CONTENIDO = 'tipo_contenido';
    const TC_TIPO_EMPLEADO = 'tipo_empleado';
    const TC_TIPO_NODO = 'tipo_nodo';
    const TC_TIPO_OFERTA = 'tipo_oferta';
    const TC_TIPO_ORACION_ID = 'tipo_oracion_id';
    const TC_TIPO_PALABRA_ID = 'tipo_palabra_id';
    const TC_TIPO_REL_PALABRA_ID = 'tipo_rel_palabra_id';
    const TC_TIPO_TAREA_ID = 'tipo_tarea_id';
    const TC_TITULO = 'titulo';
    const TC_TITULO_OFERTA = 'titulo_oferta';
    const TC_TMSINS = 'tmsins';
    const TC_TMSUPD = 'tmsupd';
    const TC_TOTAL = 'total';
    const TC_TOT_ACIERTOS = 'tot_aciertos';
    const TC_TOT_ERRORES = 'tot_errores';
    const TC_TRADUCCION = 'traduccion';
    const TC_TRANSPORTISTA = 'transportista';
    const TC_TRANSPORTISTA_ID = 'transportista_id';
    const TC_ULT_RESULTADO = 'ult_resultado';
    const TC_UNIDADES = 'unidades';
    const TC_UNIDADES_EMBALAJE = 'unidades_embalaje';
    const TC_UNIDADES_FABRICANTE = 'unidades_fabricante';
    const TC_UNIDADES_MESURA = 'unidades_mesura';
    const TC_UNIDAD_MESURA = 'unidad_mesura';
    const TC_UPDATED_AT = 'updated_at';
    const TC_UPDATED_USER = 'updated_user';
    const TC_USER_ID = 'user_id';
    const TC_USUARIO = 'usuario';
    const TC_USUARIO_ID = 'usuario_id';
    const TC_VALOR = 'valor';
    const TC_VERB_ID = 'verb_id';
    const TC_VERSION = 'version';
    const TC_VERSION_OFERTA = 'version_oferta';
    const TC_V_GERUND = 'v_gerund';
    const TC_V_PAST = 'v_past';
    const TC_V_PAST_PARTICIPLE = 'v_past_participle';
    const TC_V_REGULAR = 'v_regular';
    const TC_V_SIMPLE_PARTICIPLE = 'v_simple_participle';


    static function setArrayFromArray(array &$destino_arr, Model $origen_arr, string $key)
    {
        $destino_arr[$key] = $origen_arr[$key];
    }

    static function setArrayFromValue(array &$destino_arr, string $key, $valor)
    {
        $destino_arr[$key] = $valor;
    }

}
