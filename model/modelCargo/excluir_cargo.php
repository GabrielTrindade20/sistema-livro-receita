<?php
include_once('../../configuration/connect.php');
include_once('../modelCargo/cargoModel.php');

// Verifique se o ID do cargo foi enviado via POST
if (isset($_POST['id'])) {
    $cargoID = $_POST['id'];

    // Crie uma instância do modelo CargoModel
    $cargoModel = new CargoModel($link);

    // Tente excluir o cargo
    $excluido = $cargoModel->excluirCargo($cargoID);

    if ($excluido) {
        // A exclusão foi bem-sucedida
        // Redirecione de volta para a página atual após 2 segundos
        echo '<script>window.setTimeout(function(){ window.location.href = "../../view/pageCargo.php"; }, 1000);</script>';
        echo "Cargo excluído com sucesso! Redirecionando...";
    } else {
        // Ocorreu um erro durante a exclusão
        echo "Erro ao excluir o cargo.";
    }
} else {
    // O ID do cargo não foi enviado via POST
    echo "ID do cargo não fornecido.";
}
?>