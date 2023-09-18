<?php
include_once('../configuration/connect.php');
include_once('../model/categoriaModel.php');

$categoriaModel = new categoriaModel($link);
$categorias = $categoriaModel->read();

include('../view/pageCategoria.php');
mysqli_close($link);
?>
