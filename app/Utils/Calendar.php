<?php

namespace App\Utils;

class Calendar
{
    function __construct() {
        // print "En el constructor BaseClass\n";
    }

    private function calcMes($anyo, $mes) {
    
        $fechaPrimerDiaMes = mktime(0, 0 , 0, $mes, 1, $anyo);
        
        $primerDiaSemana = date("N", $fechaPrimerDiaMes);
        
        $fechaPrimerElemento = mktime(0, 0, 0, $mes, date("j", $fechaPrimerDiaMes) - $primerDiaSemana + 1, $anyo);
        
        $diaPrimerElemento = date("j", $fechaPrimerElemento); 
        
        #Dias en el mes.
        $diasEnMes = cal_days_in_month(CAL_GREGORIAN, $mes, $anyo); // 31
        
        $totSemanas = ($diasEnMes + $primerDiaSemana - 1) / 7;
        
        // Ajuste para las semanas
        if ( $totSemanas > intVal($totSemanas) ) {
            $totSemanas = intVal($totSemanas) + 1;
        }
        
        $a_mes = array();
        #para todas las semanas
        $contadorDia = 0;
        for ($i = 0; $i < $totSemanas; $i++) {
            // 7 dias
            $a_semana = array();
            $a_festivos = array();
            $a_activos = array(1,1,1,1,1,1,1);

            for ($d = 0; $d < 7; $d++) {
                $fPE = mktime(0, 0, 0, date("m", $fechaPrimerElemento), date("j", $fechaPrimerElemento) + $contadorDia++, $anyo);
                $diaPrimerElemento = date("j", $fPE); 
                $a_semana[$d] = intVal($diaPrimerElemento);
                $numSemanaAnyio = intVal(date("W", $fPE));
                
                $diaSemana = intVal(date("N", $fPE));
                if ( $diaSemana == 6 || $diaSemana == 7) {
                    $a_festivos[$d] = 1;
                } else {
                    $a_festivos[$d] = 0;    
                }
                
                if ($i == 0) {
                    // Primera Semana - Arreglo dias que no son del mes en curso
                    // Eliminamos los dias residuos de la ultima semana de lmes anterior
                    if (intVal($diaPrimerElemento) > 7) {
                        $a_activos[$d] = 0;
                    } 
                }
    
                if ($i == ($totSemanas - 1)) {
                    // Ultima Semana - Arreglo dias que no son del mes en curso
                    if ($diasEnMes - intVal($diaPrimerElemento) > 7 ) {
                        $a_activos[$d] = 0;
                    }
                }
            }
            $a_mes[$i] = array('num_semana' => $i + 1,
                               'num_semana_anyo' => $numSemanaAnyio,  
                               'dias' => $a_semana,
                               'festivo' => $a_festivos,
                               'activos' => $a_activos);
        }
        #$fechaElemento = mktime(0, 0, 0, $mes, date("j", $diaPrimerElemento) + 1, $anyo);
        return (array('num_mes' => $mes, 
                      'semanas' => $a_mes));
    }
    
    public function calcAnyo($anyo) {
        
        $an = array();
        # Todos los meses
        for($i = 1; $i < 13; $i++) {
            $m = $this->calcMes($anyo, $i);
            array_push($an, $m);
        }
        return array( 'num_anyo' => $anyo, 'meses' => $an);
    }
    
    // $a = calcAnyo(2018);
    
    // $json = json_encode ($a);
    // echo $json;
}
