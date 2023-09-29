<?php
include_once('../../configuration/connect.php');
include_once('cargoModel.php');

$mensagem = ''; // Inicialize a variável de mensagem

// Verifique se o formulário foi enviado
if (isset($_POST['editar'])) {
    // Obtenha o ID do cargo do formulário
    $idCargo = $_POST['idCargo'];

    // Obtenha o novo nome do cargo do formulário
    $novaDescricao = $_POST['descricao']; // Corrigido de 'nome' para 'descricao'

    // Crie uma instância do modelo CargoModel
    $cargoModel = new CargoModel($link);

    // Verifique se a descrição do cargo não está vazia
    if (empty($novaDescricao)) {
        $mensagem = 'Por favor, preencha a descrição do cargo.';
    } else {
        // Tente atualizar o cargo
        $atualizado = $cargoModel->atualizarCargo($idCargo, $novaDescricao);

        if ($atualizado) {
            $mensagem = 'Cargo atualizado com sucesso!';
            header("Location: ../../view/pageCargo.php?mensagem=" . urlencode($mensagem));
            exit();
        } else {
            $mensagem = 'Erro ao atualizar o cargo.';
        }
    }
}

?>