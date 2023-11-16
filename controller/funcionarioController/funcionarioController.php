<?php
include_once('../../configuration/connect.php');
include_once('../../model/modelFuncionario/funcionarioModel.php');

$funcionarioModel = new funcionarioModel($conexao);

if (isset($_POST['salvar'])) {
    $nome = $_POST['rg'];
    $nome = $_POST['nome'];
    $dataIngresso = $_POST['data_ingresso'];
    $salario = $_POST['salario'];
    $nomeFantasia = $_POST['nome_fantasia'];
    $cargo = $_POST['cargo'];
    $resultado = $funcionarioModel->criarFuncionario($rg, $nome, $dataIngresso, $salario, $nome_fantasia, $idCargo);

    if ($resultado) {
        $mensagem = 'Funcionário cadastrado com sucesso!';
        header("Location: pageFuncionario.php?mensagem=" . urlencode($mensagem));
    } else {
        $mensagem = 'Erro ao cadastrar o funcionário.';
    }

    exit();
}
?>