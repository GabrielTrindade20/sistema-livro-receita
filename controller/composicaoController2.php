<?php
if(!isset($_SESSION)) {
    session_start();
}

include_once(__DIR__ .'../../configuration/connect.php');
include_once(__DIR__ .'../../model/medidaModel.php');

$medidaModel = new medidaModel($link);

// pesquisar medida na receita
$pesquisar_medida = filter_input(INPUT_GET, "medida", FILTER_DEFAULT);

if(!empty($pesquisar_medida)) {
    $resultado_medida = $medidaModel->pesquisar_medida($pesquisar_medida);

    if($resultado_medida !== false && !empty($resultado_medida)) {
        $dados_medida = $resultado_medida; 
        $retorna_medida = ['statusM' => true, 'dadosM' => $dados_medida];
    } else {
        $retorna_medida = ['statusM' => false, 'msgM' => "Erro: nenhuma medida encontrado!"];
    }
}else {
    $retorna_medida = ['statusM' => false, 'msgM' => "Erro: nenhuma medida encontrado!"];
}

echo json_encode($retorna_medida);

?>