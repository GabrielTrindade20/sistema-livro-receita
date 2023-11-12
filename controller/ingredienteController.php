<?php
if(!isset($_SESSION)) {
    session_start();
}

include_once(__DIR__ .'../../configuration/connect.php');
include_once(__DIR__ .'../../model/ingredienteModel.php');

$ingredienteModel = new ingredienteModel($link);

// SALVAR INGREDIENTE
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["salvar"])) 
{
    $descricao = $_POST["descricao"];
    
    if(empty($descricao)){
        $ingredienteModel->validar_campos($descricao);
    }
    else {
        if (!empty($ingredienteModel->getErros())) {
            // Há erros, armazene-os na sessão
            $_SESSION["erros"] = $ingredienteModel->getErros();
            header("Location: ../view/pages/Receitas/receitaCadastro.php");
            exit();
        } else {
            // Não há erros, salve no banco de dados
            if ($ingredienteModel->create($descricao)) {
                $_SESSION["sucesso"] = $ingredienteModel->getSucesso();
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