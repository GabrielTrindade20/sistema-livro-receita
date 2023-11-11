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

    if ($acao === "atualizar") {
        // Se o idRestaurante estiver presente, execute a lógica de atualização
        if (!empty($idRestaurante)) {
            if ($referenciaModel->update($idFuncionario, $idRestaurante, $data_inicio, $data_fim)) {
                // Redirecione para a página desejada após a atualização
                header("Location: ../view/pages/Funcionario/pageFuncionarioAlteracao.php?idFuncionario=$idFuncionario&acao=alteracao");
                exit(); // Certifique-se de encerrar o script após o redirecionamento
            } else {
                echo "Erro na atualização";
            }
        }
    } elseif ($acao === "salvar") {
        // Salve os dados no banco de dados
        if ($referenciaModel->create($idFuncionario, $idRestaurante, $data_inicio, $data_fim)) {
            // Redirecione para a página desejada
            header("Location: ../view/pages/Funcionario/pageFuncionarioAlteracao.php?idFuncionario=$idFuncionario&acao=alteracao");
            exit(); // Certifique-se de encerrar o script após o redirecionamento

        } else {
            echo " erro";
        }
    } else {
        echo  "erro";
    }
}

// DELETE
if (isset($_GET['acao']) && $_GET['acao'] == 'delete') {
    $idFuncionario = $_GET["idFuncionario"];
    $idRestaurante = $_GET["idRestaurante"];

    $referenciaModel->delete($idFuncionario, $idRestaurante);
}

// ATUALIZAR
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idFuncionario = $_POST["idFuncionario"];
    $idRestaurante = $_POST["idRestaurante"];
    $data_inicio = $_POST["data_inicio"];
    $data_fim = $_POST["data_fim"];
}


// READ
$idFuncionario = $_GET["idFuncionario"];
$dados_referencia = $referenciaModel->recuperaReferencia($idFuncionario);
