<?php 
if(!isset($_SESSION)) {
    session_start();
}

include_once(__DIR__ .'../../configuration/connect.php');
include_once(__DIR__ .'../../model/referenciaModel.php');

$referenciaModel = new referenciaModel($link);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idRestaurante = $_POST['idRestaurante'];
    $idFuncionario = $_POST['idFuncionario'];
    $data_inicio = $_POST['data_inicio'];
    $data_fim = $_POST['data_fim'];

    // Consulta SQL para inserir na tabela de referência
    $sql = "INSERT INTO referencia (idFuncionario, idRestaurante, data_inicio, data_fim) VALUES ($idFuncionario, $idRestaurante, '$data_inicio', '$data_fim')";

    if ($conn->query($sql) === TRUE) {
        echo "Restaurante associado ao funcionário com sucesso.";
    } else {
        echo "Erro ao associar restaurante ao funcionário: " . $conn->error;
    }
}
?>


?>