<?php
include_once('../../configuration/connect.php');
include_once('../../model/modelCargo/cargoModel.php');// Inclua o modelo de cargo

$cargoModel = new CargoModel($conexao); // Crie uma instância do modelo de cargo

if (isset($_POST['salvar'])) {
    $nome = $_POST['nome']; // Obtenha o nome do cargo do formulário
    $resultado = $cargoModel->criarCargo($nome); // Chame a função para criar um cargo

    if ($resultado) {
        $mensagem = 'Cargo cadastrado com sucesso!';
        header("Location: pageCargo.php?mensagem=" . urlencode($mensagem)); // Redirecione de volta para a página de cadastro com a mensagem
    } else {
        $mensagem = 'Erro ao cadastrar o cargo.';
    }

    exit();
}
?>
