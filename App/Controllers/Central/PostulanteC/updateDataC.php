<?php

$password = "pg2024";
$username = "postgres";
$dbname = "medicosgenerales_produccion";
$host = "localhost";
$port = "5432";
$options = "--client_encoding=UTF8";
$connectionDB = "host=$host port=$port dbname=$dbname user=$username password=$password options=$options";
$connectionDBsPro = pg_pconnect($connectionDB);


//include '../../../../conexion.php';
include 'queryM.php';

$postulantesM = new PostulantesM();
$now = 'NOW()';

$condicion = [
    'id_postulantes' => $_POST['id_postulantes']
];

$datos = [
    'desc_cedula_sep' => $_POST['desc_cedula_sep'],
    'cedula_sep' => $_POST['cedula_sep'],
    'nombre' => $_POST['nombre'],
    'primer_apellido' => $_POST['primer_apellido'],
    'segundo_apellido' => $_POST['segundo_apellido'],
    'curp' => $_POST['curp'],
    'email' => $_POST['email'],
    'telefono' => $_POST['telefono'],
    'id_cat_entidad_nacimiento' => $_POST['id_cat_entidad_nacimiento'],
    'id_clues' => $_POST['id_clues'],
    'fecha_actualizacion' => $now,
];



if ($postulantesM->editarByArray($connectionDBsPro, $datos, $condicion)) {
    echo true;
} else {
    echo false;
}

