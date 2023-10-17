<?php
include_once('../../configuration/connect.php');
include_once('../../model/modelFuncionario/funcionarioModel.php');

$funcionarioModel = new FuncionarioModel($conexao);

if (isset($_POST['atualizar'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $cargo = $_POST['cargo'];
    $dataIngresso = $_POST['dataIngresso'];
    $status = $_POST['status'];

    $resultado = $funcionarioModel->atualizarFuncionario($id, $nome, $cargo, $dataIngresso, $status);

    if ($resultado) {
        $mensagem = 'Funcionário atualizado com sucesso!';
        header("Location: pageFuncionario.php?mensagem=" . urlencode($mensagem));
    } else {
        $mensagem = 'Erro ao atualizar o funcionário.';
    }

    exit();
}
?>