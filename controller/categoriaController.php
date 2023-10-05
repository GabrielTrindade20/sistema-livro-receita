<?php
if(!isset($_SESSION)) {
    session_start();
}

include_once('../configuration/connect.php');
include_once('../model/categoriaModel.php');

$categoriaModel = new categoriaModel($link);

 
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["salvar"])) 
{
    $descricao = $_POST["descricao"];
    
    if(!empty($descricao)){
        $categoriaModel->validar_campos($descricao);

        if (!empty($categoriaModel->getErros())) {
            // Há erros, armazene-os na sessão
            $_SESSION["erros"] = $categoriaModel->getErros();
            header("Location: ../view/pageCategoria.php");
            exit();
        } else {
            // Não há erros, salve no banco de dados
            if ($categoriaModel->create($descricao)) {
                $_SESSION["sucesso"] = $categoriaModel->getSucesso();
            } else {
                $_SESSION["erros"] = ["Erro ao salvar no banco de dados."];
            }
            header("Location: ../view/pageCategoria.php");
            exit();
        }
    }

    mysqli_close($link);
}
else 
{
    $categorias = $categoriaModel->read();
    mysqli_close($link);

    // Contar quandas linhas tem na tabela
    $countCategorias = count($categorias); 
}

?>