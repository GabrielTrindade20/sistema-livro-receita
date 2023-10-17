<?php
include_once('../../configuration/connect.php');
include_once('../../model/modelFuncionario/funcionarioModel.php');

$funcionarioModel = new FuncionarioModel($conexao);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $funcionario = $funcionarioModel->lerFuncionarioPorId($id);

    // Aqui você pode preencher um formulário com as informações do funcionário para serem editadas
}
?>
