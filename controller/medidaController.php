<?php
if(!isset($_SESSION)) {
    session_start();
}

include_once(__DIR__ .'../../configuration/connect.php');
include_once(__DIR__ .'../../model/medidaModel.php');

$medidaModel = new medidaModel($link);

// PESQUISAR
//$sendPesqCategria = filter_input( )

// SALVAR MEDIDA
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["salvar"])) 
{
    $descricao = $_POST["descricao"];
    
    if(empty($descricao)){
        $medidaModel->validar_campos($descricao);
    }
    else {
        if (!empty($medidaModel->getErros())) {
            // Há erros, armazene-os na sessão
            $_SESSION["erros"] = $medidaModel->getErros();
            header("Location: ../view/pages/Receitas/receitaCadastro.php");
            exit();
        } else {
            // Não há erros, salve no banco de dados
            if ($medidaModel->create($descricao)) {
                $_SESSION["sucesso"] = $medidaModel->getSucesso();
            } else {
                $_SESSION["erros"] = ["Erro ao salvar no banco de dados."];
            }
            header("Location: ../view/pages/Receitas/receitaCadastro.php");
            exit();
        }
    }
    mysqli_close($link);
}


?>