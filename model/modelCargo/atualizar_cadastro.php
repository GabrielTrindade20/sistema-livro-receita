<?php
include_once('../../configuration/connect.php');
include_once('../modelCargo/cargoModel.php');

$mensagem = ''; // Inicialize a variável de mensagem

// Verifique se o formulário foi enviado
if (isset($_POST['salvar'])) {
    // Obtenha o ID do cargo do formulário
    $idCargo = $_POST['idCargo'];

    // Obtenha a nova descrição do cargo do formulário
    $novaDescricaoCargo = $_POST['nome'];

    // Crie uma instância do modelo CargoModel
    $cargoModel = new CargoModel($link);

    // Verifique se a descrição do cargo não está vazia
    if (empty($novaDescricaoCargo)) {
        $mensagem = 'Por favor, preencha a descrição do cargo.';
    } else {
        // Tente atualizar o cargo
        $atualizado = $cargoModel->atualizarCargo($idCargo, $novaDescricaoCargo);

        if ($atualizado) {
            echo '<script>window.setTimeout(function(){ window.location.href = "../../view/pageCargo.php"; }, 1000);</script>';
            echo "Cargo atualizado com sucesso! Redirecionando...";
        } else {
            $mensagem = 'Erro ao atualizar o cargo.';
        }
    }
}

?>
