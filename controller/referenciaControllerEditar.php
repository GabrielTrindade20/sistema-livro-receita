<?php
include_once(__DIR__ . '../../configuration/connect.php');
include_once(__DIR__ . '../../model/referenciaModel.php');

$referenciaModel = new referenciaModel($link);

//SALVAR
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idFuncionario = $_POST["idFuncionario"];
    $idRestaurante = $_POST["idRestaurante"];
    $data_inicio =  $_POST["data_inicio"];
    $data_fim =  $_POST["data_fim"];

    // Salve os dados no banco de dados
    if ($referenciaModel->create($idFuncionario, $idRestaurante, $data_fim, $data_inicio)) {
           // Redirecione para a página desejada
           header("Location: ../view/pages/Funcionario/pageFuncionarioAlteracao.php?idFuncionario=$idFuncionario&acao=alteracao");
           exit(); // Certifique-se de encerrar o script após o redirecionamento
      
    } else {
        echo " erro";
    }
}

// DELETE
if(isset($_GET['acao']) && $_GET['acao'] == 'delete'){
    $idFuncionario = $_GET["idFuncionario"];
    $idRestaurante = $_GET["idRestaurante"];

    $referenciaModel->delete($idFuncionario, $idRestaurante);
}

// EDITAR
if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["acaoForm"] === "editar") {
    $idFuncionario = $_POST["idFuncionario"];
    $idRestaurante = $_POST["idRestaurante"];
    $data_inicio = $_POST["data_inicio"];
    $data_fim = $_POST["data_fim"];

    // Atualize os dados no banco de dados
    if ($referenciaModel->update($idFuncionario, $idRestaurante, $data_fim, $data_inicio)) {
        // Redirecione para a página desejada após a edição
        header("Location: ../view/pages/Funcionario/pageFuncionarioAlteracao.php?idFuncionario=$idFuncionario&acao=alteracao");
        exit();
    } else {
        echo "Erro na edição";
    }
}


// READ
$idFuncionario = $_GET["idFuncionario"];
$dados_referencia = $referenciaModel->recuperaReferencia($idFuncionario);
