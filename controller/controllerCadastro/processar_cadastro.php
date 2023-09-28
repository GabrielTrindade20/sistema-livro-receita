<?php
include_once('../../configuration/connect.php');

// Inicialize a variável de mensagem
$mensagem = 'Cargo cadastrado com sucesso!';

// Verifique se o formulário foi enviado
if (isset($_POST['salvar'])) {
    // Obtenha a descrição do cargo do formulário
    $descricaoCargo = $_POST['nome'];

    // Verifique se a descrição do cargo não está vazia
    if (empty($descricaoCargo)) {
        $mensagem = 'Por favor, preencha a descrição do cargo.';
    } else {
        // Prepare e execute a consulta SQL para inserir o novo cargo
        $sql = "INSERT INTO cargo (descricao) VALUES ('$descricaoCargo')";
        $resultado = mysqli_query($link, $sql);

        if ($resultado) {
            header("Location: ../../view/pageCargo.php?mensagem=" . urlencode($mensagem));
            exit();
        } else {
            $mensagem = 'Erro ao cadastrar o cargo.';
        }
    }
}
?>