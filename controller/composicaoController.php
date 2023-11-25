<?php
include_once(__DIR__ . '../../configuration/connect.php');
include_once(__DIR__ . '../../model/ingredienteModel.php');
include_once(__DIR__ . '../../model/medidaModel.php');

$ingredienteModel = new ingredienteModel($link);
$medidaModel = new medidaModel($link);

$pesquisar_ingrediente = filter_input(INPUT_GET, "ingrediente", FILTER_DEFAULT);

if(!empty($pesquisar_ingrediente)) {
    $resultado_ingredientes = $ingredienteModel->pesquisar_ingrediente($pesquisar_ingrediente);

    if($resultado_ingredientes !== false && !empty($resultado_ingredientes)) {
        $dados_ingredientes = $resultado_ingredientes; 
        $retorna_ingrediente = ['status' => true, 'dados' => $dados_ingredientes];
    } else {
        $retorna_ingrediente = ['status' => false, 'msg' => "Erro: nenhum ingrediente encontrado!"];
    }
}else {
    $retorna_ingrediente = ['status' => false, 'msg' => "Erro: nenhum ingrediente encontrado!"];
}

echo json_encode($retorna_ingrediente);


//var_dump($pesquisar_ingrediente);
?>