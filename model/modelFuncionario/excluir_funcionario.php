<?php
include_once('../../configuration/connect.php');
include_once('../../model/modelFuncionario/funcionarioModel.php');

$funcionarioModel = new FuncionarioModel($conexao);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $resultado = $funcionarioModel->deletarFuncionario($id);

    if ($resultado) {
        $mensagem = 'Funcionário excluído com sucesso!';
        header("Location: pageFuncionario.php?mensagem=" . urlencode($mensagem));
    } else {
        $mensagem = 'Erro ao excluir o funcionário.';
    }

    exit();
}
?>