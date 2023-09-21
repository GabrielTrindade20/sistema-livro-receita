<?php
include_once('../controller/LoginController.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleLogin.css">
    <link rel="icon" href="css/iconsSVG/iconReceita.svg">
    <link 
        rel="stylesheet" 
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Login</title>
</head>
<body>

    <header>
            <section id="section-esquerda">
                <div id="div-logo" id="section1">
                    <img src="../view/css/logo.png" alt="logo">
                </div>
            </section>
            
            <section id="section-direita"> 
                <!-- Notificação de erro ao logar -->
                <figure class="notification" >
                    <div class="notification_body">
                        <?php if (isset($mensagem)): ?>
                            <div><?php echo $mensagem; ?></div>
                        <?php endif; ?>
                    <div class="notification_progress"></div>
                </figure>
                
                <div id="conteiner-dados">
                    <form class="my-form" action="" method="POST"> 
                        <div class="titulo-login">
                            <h2 class="titulo">LOGIN</h2>
                        </div>

                        <div class="input-text">
                            <input type="text" name="nome" id="name" placeholder="Nome" required>
                            <span class="material-symbols-outlined"> person </span>
                        </div>
                        <div class="input-text">                            
                            <input type="password" name="senha" id="senha" placeholder="Senha" required>
                            <span class="material-symbols-outlined"> lock </span>
                        </div>

                        <input type="submit" value="Entrar" class="botao">
                    </form>                          
                        
                    <div id="redefSenha">
                        <p>Esqueceu sua senha? 
                            <span>
                                <a href="">Redefinir senha</a>
                            </span>
                        </p>                
                    </div>
                </div>    
            </section>  
    </header>
</body>
</html>