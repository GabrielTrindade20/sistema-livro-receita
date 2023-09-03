<?php

if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['id'])) {
    die("Você nao pode acessar esta página por não está logando.
    <p><a href=\"../view/login.php\">Entrar</a></p>");
}

?>