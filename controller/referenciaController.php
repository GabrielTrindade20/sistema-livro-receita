<?php
if(!isset($_SESSION)) {
    session_start();
}

include_once(__DIR__ .'../../configuration/connect.php');
include_once(__DIR__ .'../../model/referenciaModel.php');

$referenciaModel = new referenciaModel($link);

// SALVAR 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    $idFuncionario = $referenciaModel->pegarUltimoIdFuncionario();
    
    $sucessos = [];
    $erros = [];

    foreach ($data as $item) {
        $idRestaurante = $item["idRestaurante"];
        $dataInicio = $item["data_inicio"];
        $dataFim = $item["data_fim"];

        // Valide os campos
        if (empty($idRestaurante) || empty($dataInicio) || empty($dataFim)) {
            $erros[] = "Campos obrigatórios não preenchidos.";
        } else {
            // Salve os dados no banco de dados
            if ($referenciaModel->create($idFuncionario, $idRestaurante, $dataInicio, $dataFim)) {
                $sucessos[] = "Dados salvos com sucesso.";
            } else {
                $erros[] = "Erro ao salvar no banco de dados.";
            }
        }
    }

    $resposta = [
        "sucessos" => $sucessos,
        "erros" => $erros,
    ];

    header("Content-Type: application/json");
    echo json_encode($resposta);
    exit;
}
// RECUPERA OS DADOS E MOSTRA NA TABELA 
elseif (isset($_GET['acao']) && $_GET['acao'] === 'alteracao' && $_SERVER["REQUEST_METHOD"] === "GET") {
    $idFuncionario = $_GET["idFuncionario"];
    
    // recuperar dados para a alteração 
    $recuperar_referencia = $referenciaModel->recuperaReferencia($idFuncionario);
}
// EXCLUIR
elseif (isset($_GET['acao']) && $_GET['acao'] === 'excluir') {
    if (isset($_GET['idRestaurante']) && isset($_GET['idFuncionario'])) {
        $idRestaurante = $_GET['idRestaurante'];
        $idFuncionario = $_GET['idFuncionario'];

        if ($referenciaModel->delete( $idFuncionario, $idRestaurante)) {
            $_SESSION["sucesso"] = $referenciaModel->getSucesso();
        } else {
            $_SESSION["erros"] = ["Erro ao excluir no banco de dados."];
        }
    } else {
        $_SESSION["erros"] = ["ID de restaurante não especificado."];
    }

    header("Location: ../view/pages/pageFuncionarioAlteracao.php");
    exit();
}
// EXCLUIR SELECIONADOS
elseif(isset($_GET['acao']) && $_GET['acao'] === 'excluirSelecionados'){ 
    if(isset($_POST['checkbox']) && is_array($_POST['checkbox'])) {
        // Loop através dos IDs das categorias selecionadas
        foreach ($_POST['checkbox'] as $idRestaurante) {
            // Verificar se o ID da categoria é válido (por exemplo, um número inteiro positivo)
            if (is_numeric($idRestaurante) && $idRestaurante > 0) {
                if ($referenciaModel->delete( $idFuncionario, $idRestaurante )) {
                    $_SESSION["sucesso"] = ["Restaurantes excluidos com sucesso."];
                } else {
                    $_SESSION["erros"] = ["Erro ao excluir a restaurante com ID $idRestaurante."];
                }
            } else {
                // O ID da categoria não é válido
                $_SESSION["erros"] = ["ID de restaurante inválido: $idRestaurante."];
            }
        }
        header("Location: ../view/pages/pageFuncionarioAlteracao.php");
        exit();
    }
}
// RETORNAR DADOS SALVOS
else 
{

}


?>