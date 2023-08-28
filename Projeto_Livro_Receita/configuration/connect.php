<!-- Conexão com o banco de dados --->
<?php

// Conexão local, usuario, senha, banco de dados
$host = 'localhost';
$usuario = 'adm_LivroReceitas';
$senha = 'livro123';
$banco = 'livro_receita_dev';

global $link;
$link = mysqli_connect($host, $usuario, $senha, $banco);
  
// mysqli_connect_errno - devolve o código do erro
if (mysqli_connect_errno()) {
    // mysqli_connect_error - devolve a mensagem de erro
    printf("Erro ao conectar ao banco de dados: %s<br> ", mysqli_connect_error() );
    exit();
}

?>