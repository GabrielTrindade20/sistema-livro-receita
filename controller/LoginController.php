<?php
include_once('../configuration/connect.php');
include_once('../model/LoginModel.php');

$userModel = new LoginModel();

if (isset($_POST['nome']) && isset($_POST['senha'])) {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];

    if (strlen($nome) == 0) {
        $mensagem = "Preencha seu nome.";
    } elseif (strlen($senha) == 0) {
        $mensagem = "Preencha sua senha.";
    } else {
        $usuario = $userModel->validarLogin($nome, $senha);
        
        if ($usuario !== null)  {
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['id'] = $usuario['idLogin'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: ../view/homePage.php");
            //exit(); // interromper o script após o redirecionamento.
        } else {
            $mensagem = "Falha ao logar! Nome ou Senha incorretos.";
        }
    }
}


?>