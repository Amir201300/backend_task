<?php

/**
 * @return string
 */
function get_baseUrl()
{
    return url('/');
}

/**
 * @param $price
 * @return string
 */

function priceFormat($price){
    return number_format((float)$price, 2, '.', '');
}

/**
 * @param $date
 * @return false|string
 */
function CustomDateFormat($date){
    return date('m/d/Y', strtotime($date));
}

/**
 * @return int
 */
function paginateNum(){
    return 10;
}
