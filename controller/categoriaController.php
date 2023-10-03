<?php
include_once('../configuration/connect.php');
include_once('../model/categoriaModel.php');

$categoriaModel = new categoriaModel($link);

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];
    $al = $categoriaModel->recuperaCategoria($id);
} 
elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && $_POST["action"] === "atualizar") {
    $id = $_POST["idCategoria"];
    $descricao = $_POST["descricao"];
    
    if ($categoriaModel->update($id, $descricao)) {
        $mensagem = "Alteração efetuada com sucesso";
        include("../view/pageCategoria.php"); // Inclua a página de alteração novamente para exibir a mensagem
        //header("refresh: 2; url=../view/pageCategoria.php"); // Redireciona para a lista de categorias após 2 segundos
    } else {
        $mensagem = "Erro ao atualizar a categoria: " . mysqli_error($link);
    }
    
    mysqli_close($link);
}
else {
    $categorias = $categoriaModel->read();
    mysqli_close($link);
}

?>