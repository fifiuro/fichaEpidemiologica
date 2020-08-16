<?php

function formato_fecha($fecha) {
    if($fecha != ''){
        $f = explode("-",$fecha);
        $nuevo = $f[2]."/".$f[1]."/".$f[0];
    } else {
        $nuevo = '';
    }
    return $nuevo;
}