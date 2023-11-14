<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once(__DIR__ . '../../configuration/connect.php');
include_once(__DIR__ . '../../model/restauranteModel.php');

$restauranteModel = new restauranteModel($link);

// SALVAR 
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["acao"])) {
    
    $idRestaurante = $_POST['idRestaurante'];
    $nome = $_POST["nome"];
    $contato = $_POST["contato"];

    $acao = $_POST["acao"];

    if (empty($nome) && empty($nome)) {
        $restauranteModel->validar_campos($nome, $contato);
    } else {
        if (!empty($restauranteModel->getErros())) {
            // Há erros, armazene-os na sessão
            $_SESSION["erros"] = $restauranteModel->getErros();
            header("Location: ../view/pages/Restaurante/cadastrarRestaurante.php");
            exit();
        } else {
            // Não há erros, salve no banco de dados
            if ($acao === "salvar") {

                if ($restauranteModel->create($nome, $contato)) {
                    $_SESSION["sucesso"] = $restauranteModel->getSucesso();
                } else {
                    $_SESSION["erros"] = ["Erro ao salvar no banco de dados."];
                }
                header("Location: ../view/pages/Restaurante/cadastrarRestaurante.php");
                exit();
            }
            elseif ($acao === "atualizar") {
                if ($atualizado = $restauranteModel->update($idRestaurante, $nome, $contato)) {
                    $_SESSION["sucesso"] = $restauranteModel->getSucesso();
                } else {
                    $_SESSION["erros"] = ["Erro ao alterar no banco de dados."];
                }
                header("Location: ../view/pages/Restaurante/cadastrarRestaurante.php");
                exit(); 
                
            }
        }
    }
    mysqli_close($link);
}

// EXCLUIR
if (isset($_GET['acao']) && $_GET['acao'] === 'delete') {
    if (isset($_GET['idRestaurante'])) {
        $idRestaurante = $_GET['idRestaurante'];

        if ($restauranteModel->delete($idRestaurante)) {
            $_SESSION["sucesso"] = $restauranteModel->getSucesso();
        } else {
            $_SESSION["erros"] = ["Erro ao excluir no banco de dados."];
        }
    } else {
        $_SESSION["erros"] = ["ID de restaurante não especificado."];
    }
}


$restaurantes = $restauranteModel->read();


