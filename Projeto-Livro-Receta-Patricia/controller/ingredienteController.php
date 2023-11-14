<?php
if(!isset($_SESSION)) {
    session_start();
}

include_once(__DIR__ .'../../configuration/connect.php');
include_once(__DIR__ .'../../model/ingredienteModel.php');

$ingredienteModel = new ingredienteModel($link);

// SALVAR INGREDIENTE
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["acao"])) 
{
    $idIngrediente = $_POST["idIngrediente"];
    $nome_ingrediente = $_POST["nome_ingrediente"];
    $descricao = $_POST["descricao"];
    
    $acao = $_POST["acao"];

    var_dump($acao, $idIngrediente, $nome_ingrediente,$descricao) ;
    if ($acao === "atualizar") {
        if (!empty($idIngrediente)) {
            if ($ingredienteModel->update($idIngrediente, $nome_ingrediente, $descricao)) {
                // Redirecione para a página desejada após a atualização
                header("Location: ../view/pages/Receitas/pageReceitaIngreMedida.php");
                exit(); // encerrar o script após o redirecionamento
                echo " atualizando";
            } else {
                echo "Erro na atualização";
            }
        }
    } elseif ($acao === "salvar") {
        // Salve os dados no banco de dados
        if ($ingredienteModel->create($nome_ingrediente, $descricao )) {
            // Redirecione para a página desejada
            header("Location: ../view/pages/Receitas/pageReceitaIngreMedida.php");
            exit(); 
            echo " salvo";

        } else {
            echo " erro";
        }
    } else {
        echo  "erro";
    }
}


// DELETE
if (isset($_GET['acao']) && $_GET['acao'] == 'delete') {
    $idIngrediente = $_GET["idIngrediente"];

    $ingredienteModel->delete($idIngrediente);
}


// READ
$dados_ingredientes = $ingredienteModel->read();

?>