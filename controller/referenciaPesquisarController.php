<?php
if(!isset($_SESSION)) {
    session_start();
}

include_once(__DIR__ .'../../configuration/connect.php');
include_once(__DIR__ .'../../model/referenciaModel.php');
include_once(__DIR__ .'../../model/restauranteModel.php');

$referenciaModel = new referenciaModel($link);
$restauranteModel = new restauranteModel($link);

if (!empty($_GET['search'])) {
    $termo = $_GET['search'];

    $restaurantes = $restauranteModel->pesquisarRestaurantesPorNome($termo);
}
else {
    $restaurantes = $restauranteModel->read();
}