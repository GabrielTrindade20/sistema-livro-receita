<?php
include_once('../configuration/connect.php');
include_once('../model/categoriaModel.php');

$categoriaModel = new categoriaModel($link);
/*
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];
    $al = $categoriaModel->recuperaCategoria($id);
} */
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["salvar"])) {
    $descricao = $_POST["descricao"];
    
    if ($categoriaModel->create($descricao)) {
        $mensagens = "Cadastro efetuada com sucesso.";
        //include("../view/pageCategoria.php"); // Inclua a página de alteração novamente para exibir a mensagem
        header('Location: ../view/pageCategoria.php');
    } else {
        $mensagens = "Erro ao cadastrar a categoria: " . mysqli_error($link);
        header('Location: ../view/pageCategoria.php');
    }
    mysqli_close($link);
}
else {
    $categorias = $categoriaModel->read();
    mysqli_close($link);
}

?>