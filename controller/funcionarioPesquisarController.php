<?php
include_once(__DIR__ . '../../configuration/connect.php');
include_once(__DIR__ . '../../model/funcionarioModel.php');

$funcionarioModel = new funcionarioModel($link);

$pesquisar_funcionario= filter_input(INPUT_GET, "funcionario", FILTER_DEFAULT);

if(!empty($pesquisar_funcionario)) {
    $resultado_funcionario = $funcionarioModel->pesquisar_funcionario($pesquisar_funcionario);

    if($resultado_funcionario !== false && !empty($resultado_funcionario)) {
        $dados_funcionario = $resultado_funcionario; 
        $retorna_funcionario = ['status' => true, 'dados' => $dados_funcionario];
    } else {
        $retorna_funcionario = ['status' => false, 'msg' => "Erro: nenhum funcionario encontrado!"];
    }
}else {
    $retorna_funcionario = ['status' => false, 'msg' => "Erro: nenhum funcionario encontrado!"];
}

echo json_encode($retorna_funcionario);

?>