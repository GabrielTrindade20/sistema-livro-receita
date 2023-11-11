<?php
if(!isset($_SESSION)) {
    session_start();
}

include_once(__DIR__ .'../../configuration/connect.php');
include_once(__DIR__ .'../../model/referenciaModel.php');

$referenciaModel = new referenciaModel($link);

// SALVAR pageCadastro
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
}
// RETORNAR DADOS SALVOS
else 
{

}
