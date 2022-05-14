<?php


namespace App\Utils;


class DateUtils
{

    const DATE_DAYS = 'days';
    const DATE_WEEK = 'week';
    const DATE_MONTH = 'month';
    const DATE_YEAR = 'year';
    // const DATE_FORMAT_d_m_Y = 'd-m-Y';
    const DATE_FORMAT_Y_m_d = 'Y-m-d';

    static function calcDate($date, $format, $value, $sign = '+')
    {
        $str = $sign . ' ' . $value . ' ' . $format;
        return date(self::DATE_FORMAT_Y_m_d, strtotime($date . $str));
    }

    static function sumDiaToDate($date, $value)
    {
        return self::calcDate($date, self::DATE_DAYS, $value, '+');
    }

    static function subDiaToDate($date, $value)
    {
        return self::calcDate($date, self::DATE_DAYS, $value, '-');
    }

    static function sumWeekToDate($date, $value)
    {
        return self::calcDate($date, self::DATE_WEEK, $value, '+');
    }

    static function subWeekToDate($date, $value)
    {
        return self::calcDate($date, self::DATE_WEEK, $value, '-');
    }

    static function sumMonthToDate($date, $value)
    {
        return self::calcDate($date, self::DATE_MONTH, $value, '+');
    }

    static function subMonthToDate($date, $value)
    {
        return self::calcDate($date, self::DATE_MONTH, $value, '-');
    }

    static function sumYearToDate($date, $value)
    {
        return self::calcDate($date, self::DATE_YEAR, $value, '+');
    }

    static function subYearToDate($date, $value)
    {
        return self::calcDate($date, self::DATE_YEAR, $value, '-');
    }

    /*
    // Dias
    $fecha_actual = date("d-m-Y");
    //sumo 1 día
    echo date("d-m-Y",strtotime($fecha_actual."+ 1 days"));
    //resto 1 día
    echo date("d-m-Y",strtotime($fecha_actual."- 1 days"));

    // Sumar y restar semanas
    $fecha_actual = date("d-m-Y");
    //sumo 1 semana
    echo date("d-m-Y",strtotime($fecha_actual."+ 1 week"));
    //resto 1 semana
    echo date("d-m-Y",strtotime($fecha_actual."- 1 week"));

    // Sumar y restar mese
    $fecha_actual = date("d-m-Y");
    //sumo 1 mes
    echo date("d-m-Y",strtotime($fecha_actual."+ 1 month"));
    //resto 1 mes
    echo date("d-m-Y",strtotime($fecha_actual."- 1 month"));

    // Sumar y restar años
    $fecha_actual = date("d-m-Y");
    //sumo 1 año
    echo date("d-m-Y",strtotime($fecha_actual."+ 1 year"));
    //resto 1 año
    echo date("d-m-Y",strtotime($fecha_actual."- 1 year"));
    */

}