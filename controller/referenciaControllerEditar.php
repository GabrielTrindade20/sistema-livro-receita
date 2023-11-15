<?php
include_once(__DIR__ . '../../configuration/connect.php');
include_once(__DIR__ . '../../model/referenciaModel.php');

$referenciaModel = new referenciaModel($link);

//SALVAR
if ($_SERVER["REQUEST_METHOD"] === "POST"  && isset($_POST['acao'])) {
    $idFuncionario = $_POST["idFuncionario"];
    $idRestaurante = $_POST["idRestaurante"];
    $data_inicio =  $_POST["data_inicio"];
    $data_fim =  $_POST["data_fim"];
    $acao = $_POST["acao"];

var_dump($idFuncionario, $idRestaurante, $data_inicio, $data_fim);

    if ($acao === "atualizar") {
        // Se o idRestaurante estiver presente, execute a lógica de atualização
        if (!empty($idRestaurante)) {
            if ($referenciaModel->update($idFuncionario, $idRestaurante, $data_inicio, $data_fim)) {
                $_SESSION["sucessoE"] = "Atualizado";
                header("Location: ../view/pages/Restaurante/pageRestauranteAlteracao.php?idFuncionario=$idFuncionario");
                exit(); // Certifique-se de encerrar o script após o redirecionamento
            } else {
                $_SESSION["errosE"] =  "Erro na atualização";
            }
        }
    } elseif ($acao === "salvar") {
        // Salve os dados no banco de dados
        if ($referenciaModel->create($idFuncionario, $idRestaurante, $data_inicio, $data_fim)) {
            $_SESSION["sucessoE"] = "Cadastrado";
            header("Location: ../view/pages/Restaurante/pageRestauranteAlteracao.phpidFuncionario=$idFuncionario");
            exit(); // Certifique-se de encerrar o script após o redirecionamento

        } else {
            echo " erro1";
        }
    } else {
        echo  "erro2";
    }
}

// EXCLUIR
if (isset($_GET['acao']) && $_GET['acao'] === 'delete') {
    if (isset($_GET['idFuncionario'])&&isset($_GET['idRestaurante'])) {
        $idRestaurante = $_GET['idRestaurante'];
        $idFuncionario = $_GET['idFuncionario'];

        if ($referenciaModel->delete($idFuncionario,$idRestaurante)) {
            $_SESSION["sucessoE"] = "Deletado";
        } else {
            $_SESSION["errosE"] = "Erro ao excluir no banco de dados.";
        }
    } else {
        $_SESSION["errosE"] = "ID não especificado.";
    }
}

