<?php

if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['id'])) {
    die("Você não pode acessar esta página por não está logado.
    <p><a href=\"../view/index.php\">Entrar</a></p>");
}

?>