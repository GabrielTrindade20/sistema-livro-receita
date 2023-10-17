<?php
include_once('../../configuration/connect.php');
include_once('../../model/modelFuncionarios/funcionariosModel.php'); 

$funcionarioModel = new funcionariosModel($conexao);

if (isset($_POST['salvar'])) {
    $nome = $_POST['nome'];
    $cargo = $_POST['cargo']; 
    $dataIngresso = $_POST['dataIngresso'];
    $status = $_POST['status']; 
    $resultado = $funcionarioModel->criarFuncionario($nome, $cargo, $dataIngresso, $status);

    if ($resultado) {
        $mensagem = 'Funcionário cadastrado com sucesso!';
        header("Location: pageFuncionario.php?mensagem=" . urlencode($mensagem));
    } else {
        $mensagem = 'Erro ao cadastrar o funcionário.';
    }

    exit();
}
?>