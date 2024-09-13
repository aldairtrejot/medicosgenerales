<?php

$password = "pg2024";
$username = "postgres";
$dbname = "medicosgenerales_produccion";
$host = "localhost";
$port = "5432";
$options = "--client_encoding=UTF8";
$connectionDB = "host=$host port=$port dbname=$dbname user=$username password=$password options=$options";
$connectionDBsPro = pg_pconnect($connectionDB);


include '../../../Controllers/Catalogos/CatSelectC/CatSelectC.php';
include '../../../Controllers/Hrae/GlobalC/ArrayC.php';
//include '../../../../conexion.php';
include 'queryM.php';

$postulantesM = new PostulantesM();
$catSelectC = new CatSelectC();
$row = new Row();

$idPostulante = $_POST['id_postulantes'];
$result = $row->returnArray($postulantesM->getDataUpdate($idPostulante));
$estados = $catSelectC->selectByAllCatalogo($postulantesM->getDataEstates());
$clue = $catSelectC->selectByAllCatalogo($postulantesM->getDataCluesAll($result['id_cat_entidad']));
$entidad = 'Entidad de CLUE';
$nombre = 'Nombre de CLUE';


if ($result['id_cat_entidad_nacimiento'] != '') {
    $estados = $catSelectC->selectByEditCatalogo($postulantesM->getDataEstates(), $row->returnArrayById($postulantesM->getDataEditEstates($result['id_cat_entidad_nacimiento'])));
}

if ($result['id_clues'] != '') {
    $clue = $catSelectC->selectByEditCatalogo($postulantesM->getDataCluesAll($result['id_cat_entidad']), $row->returnArrayById($postulantesM->getDataCluesEdit($result['id_clues'])));
    $result_ = $row->returnArrayById($postulantesM->getDataForClue($result['id_clues']));
    $entidad = $result_[1];
    $nombre = $result_[0];
}




$var = [
    'result' => $result,
    'estados' => $estados,
    'clue' => $clue,
    'entidad' => $entidad,
    'nombre' => $nombre,
];

echo json_encode($var);