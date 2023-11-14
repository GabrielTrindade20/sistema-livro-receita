<?php
if(!isset($_SESSION)) {
    session_start();
}

include_once(__DIR__ .'../../configuration/connect.php');
include_once(__DIR__ .'../../model/medidaModel.php');

$medidaModel = new medidaModel($link);

// SALVAR MEDIDA
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["acaoM"])) 
{
    $idMedida = $_POST["idMedida"];
    $medida = $_POST["medida"];
    
    $acao = $_POST["acaoM"];

    if ($acao === "atualizarM") {
        if (!empty($idMedida)) {
            if ($medidaModel->update($idMedida, $medida)) {
                // Redirecione para a página desejada após a atualização
                header("Location: ../view/pages/Receitas/pageReceitaIngreMedida.php");
                exit(); // encerrar o script após o redirecionamento
            } else {
                echo "Erro na atualização";
            }
        }
    } elseif ($acao === "salvarM") {
        // Salve os dados no banco de dados
        if ($medidaModel->create($medida)) {
            // Redirecione para a página desejada
            header("Location: ../view/pages/Receitas/pageReceitaIngreMedida.php");
            exit(); 

        } else {
            echo " erro";
        }
    } else {
        echo  "erro";
    }
}


// DELETE
if (isset($_GET['acao']) && $_GET['acao'] == 'deleteM') {
    $idMedida = $_GET["idMedida"];

    $medidaModel->delete($idMedida);
}


// READ
$dados_medidas = $medidaModel->read();
?>