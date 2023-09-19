<?php
include_once('../configuration/connect.php');
include_once('../model/categoriaModel.php');

$categoriaModel = new CategoriaModel($link);

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];
    $al = $categoriaModel->recuperaCategoria($id);
    include("../view/formAlteracao.php");
} 
elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && $_POST["action"] === "atualizar") {
    $id = $_POST["idCategoria"];
    $descricao = $_POST["descricao"];
    
    if ($categoriaModel->update($id, $descricao)) {
        $mensagem = "Alteração efetuada com sucesso";
        header("refresh: 2; url=../view/pageCategoria.php");
    } else {
        $mensagem = "Erro ao atualizar a categoria: " . mysqli_error($link);
    }
    
    mysqli_close($link);
}
else {
    $categorias = $categoriaModel->read();
    include("../view/pageCategoria.php");
    mysqli_close($link);
}

?>
