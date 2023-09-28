<?php
include_once('../configuration/connect.php');
include_once('../model/cargoModel.php');

$cargoModel = new $cargoModel($link);

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];
    $al = $cargoModel->recuperaCargo($id);
} 
elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && $_POST["action"] === "atualizar") {
    $id = $_POST["idCargo"];
    $descricao = $_POST["descricao"];
    
    if ($cargoModel->update($id, $descricao)) {
        $mensagem = "Alteração efetuada com sucesso";
        include("../view/formAlteracao.php"); // Inclua a página de alteração novamente para exibir a mensagem
        //header("refresh: 2; url=../view/pageCargo.php"); // Redireciona para a lista de cargos após 2 segundos
    } else {
        $mensagem = "Erro ao atualizar a cargo: " . mysqli_error($link);
    }
    
    mysqli_close($link);
}
else {
    $cargo = $cargoModel->read();
    mysqli_close($link);
}

?>