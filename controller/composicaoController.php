<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once(__DIR__ . '../../configuration/connect.php');
include_once(__DIR__ . '../../model/ingredienteModel.php');
include_once(__DIR__ . '../../model/medidaModel.php');

$ingredienteModel = new ingredienteModel($link);
$medidaModel = new medidaModel($link);

// SALVAR pageCadastro
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["salvar_composicao"])) {
    $idIngrediente = $_POST["idIngrediente"];
    $idMedida = $_POST["idMedida"];
    $novoIngrediente = $_POST["novoIngrediente"];
    $novoMedida = $_POST["novoMedida"];
    $quantidade = $_POST["quantidade"];

    if (!empty($idIngrediente) || !empty($idMedida) && !empty($quantidade)) {

    }
    elseif (!empty($novoIngrediente) || !empty($novoMedida) && !empty($quantidade)) {
        $ingredienteModel->verificarExisteBanco($novoIngrediente);
        $medidaModel->verificarExisteBanco($novoMedida);

        if (!empty($ingredienteModel->verificaSim) || !empty($medidaModel->verificaSim)) {
            $_SESSION["errosC"] = ["O registro já existe."];
            header("Location: ../view/pages/Receitas/pageReceitaCadastro.php");
            exit();
        } else {
            if (!empty($novoMedida) && !empty($quantidade)) {
                if ($ingredienteModel->create($novoIngrediente, NULL) && $medidaModel->create($novoMedida)) {
                    // Redirecione para a página desejada
                    header("Location: ../view/pages/Receitas/pageReceitaCadastro.php");
                    exit();
                    $_SESSION["sucessoC"] =  ["Salvo com sucesso."];
                } else {
                    $_SESSION["errosC"] = ["Erro ao salvar no banco de dados."];
                }
            }
        }
    }
else {
        $_SESSION["errosC"] = ["Preenchar todos os campos."];
        header("Location: ../view/pages/Receitas/pageReceitaCadastro.php");
        exit();
    }
}

// RETORNAR DADOS SALVOS
// $referencias = $referenciaModel->leitura();

// $count_referencias = count($referencias);
