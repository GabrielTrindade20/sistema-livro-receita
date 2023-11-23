<?php
include_once(__DIR__ . '../../configuration/connect.php');
include_once(__DIR__ . '../../model/restauranteModel.php');

$restauranteModel = new restauranteModel($link);

$pesquisar_restaurante= filter_input(INPUT_GET, "restaurante", FILTER_DEFAULT);

if(!empty($pesquisar_restaurante)) {
    $resultado_restaurante = $restauranteModel->pesquisar_restaurante($pesquisar_restaurante);

    if($resultado_restaurante !== false && !empty($resultado_restaurante)) {
        $dados_restaurante = $resultado_restaurante; 
        $retorna_restaurante = ['status' => true, 'dados' => $dados_restaurante];
    } else {
        $retorna_restaurante = ['status' => false, 'msg' => "Erro: nenhum restaurante encontrado!"];
    }
}else {
    $retorna_restaurante = ['status' => false, 'msg' => "Erro: nenhum restaurante encontrado!"];
}

echo json_encode($retorna_restaurante);

?>