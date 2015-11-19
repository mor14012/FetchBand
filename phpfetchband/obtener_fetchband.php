<?php
/**
 * Obtiene todas las metas de la base de datos
 */

require 'fetchband.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Manejar petición GET
    $metas = fetchband::getAll();

    if ($metas) {

        $datos["estado"] = 1;
        $datos["metas"] = $metas;

        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}