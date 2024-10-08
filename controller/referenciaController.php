<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once(__DIR__ . '../../configuration/connect.php');
include_once(__DIR__ . '../../model/referenciaModel.php');

$referenciaModel = new referenciaModel($link);

// SALVAR pageCadastro
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["acao"])) {
    $idFuncionario = $_POST["idFuncionario"];
    $idRestaurante = $_POST["idRestaurante"];
    $data_inicio = $_POST["data_inicio"];
    $data_fim = $_POST["data_fim"];

    $acao = $_POST["acao"];

    var_dump($acao, $idFuncionario, $idRestaurante, $data_inicio, $data_fim);
    if ($acao === "salvar") {
        if (!empty($idFuncionario) && !empty($idRestaurante) && !empty($data_inicio) && !empty($data_fim)) {
            $referenciaModel->verificarExisteBanco($idFuncionario, $idRestaurante);

            // Depois de chamar a função, você pode acessar os resultados
            if (!empty($referenciaModel->verificaSim)) {
                $_SESSION["erros"] = "O registro já existe no banco de dados.";
                header("Location: ../view/pages/Restaurante/pageRestauranteCadastro.php");
                exit();
            } else {
                $_SESSION["sucesso"] = "Cadastrado com sucesso";

                // Salve os dados no banco de dados
                if ($referenciaModel->create($idFuncionario, $idRestaurante, $data_inicio, $data_fim)) {
                    // Redirecione para a página desejada
                    header("Location: ../view/pages/Restaurante/pageRestauranteCadastro.php");
                    exit();
                    $_SESSION["sucesso"] =  "Salvo com sucesso.";
                } else {
                    $_SESSION["erros"] = "Erro ao salvar no banco de dados.";
                }
            }
        } else {
            $_SESSION["erros"] = "Preenchar todos os campos.";
            header("Location: ../view/pages/Restaurante/pageRestauranteCadastro.php");
            exit();
        }
    } else {
        $_SESSION["erros"] =  "erro no acao = salva?";
    }
}

// RETORNAR DADOS SALVOS
$referencias = $referenciaModel->leitura();

$count_referencias = count($referencias);

