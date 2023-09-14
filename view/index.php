<?php
include_once('../controller/LoginController.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css"> 
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
</head>
<body>

    <header>
            <section id="section-esquerda">
                <div id="div-logo" id="section1">
                    <a href="">
                        <img src="css/imagens/logo.png" alt="logo">
                    </a>
                </div>
            </section>
            
            <section id="section-direita">  
                <div id="erro-login">
                    <?php if (isset($mensagem)): ?>
                        <div><?php echo $mensagem; ?></div>
                    <?php endif; ?>
                </div>
         
                <div id="conteiner-formulario">
                    <div id="conteiner-dados">
                            <h2 class="titulo"><a href="">Login</a></h2>

                        <form action="" method="POST">                        
                            <input type="text" name="nome" id="name" placeholder="nome" required>

                            <input type="password" name="senha" id="senha" placeholder="senha" required>

                            <input type="submit" value="Entrar" id="botao">
                        </form>
                                
                        <div id="redefSenha">
                            <p>Esqueceu sua senha? <span><a href="">Redefinir senha</a></span></p>                
                        </div>
                    </div>    
                </div>
            </section>  
    </header>
</body>
</html>