<?php 
include_once('../controller/loginController.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleLogin.css">
    <link rel="stylesheet" href="css/styleNoti.css">
    <link rel="icon" href="css/iconsSVG/iconReceita.svg">
    <link 
        rel="stylesheet" 
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" 
    />
    <title>Login</title>
</head>
<body>
    <main class="main-login">
        <section id="section-esquerda">
            <div class="div-logo">
                <img src="../view/css/img/logo.png" alt="logo site livro de receitas"> 
            </div>
        </section>
            
        <section id="section-direita"> 
            <!-- Notificação de erro ao logar -->
            <?php if (isset($mensagem)): ?>
<<<<<<< HEAD
                <figure class="notification" >
                    <div class="notification_body">
                        <div><?php echo $mensagem; ?></div>
                    <div class="notification_progress"></div>
                </figure>
=======
            <figure class="notification" >
                <div class="notification_body">
                    <?php if (isset($mensagem)): ?>
                        <div><?php echo $mensagem; ?></div>
                    <?php endif; ?>
                <div class="notification_progress"></div>
            </figure>

                <figure class="notification" >
                    <div class="notification_body">
                        <div><?php echo $mensagem; ?></div>
                    <div class="notification_progress"></div>
                </figure>

            <?php endif; ?>
            <!-- ---------------------------- -->

            <div id="conteiner-form">
                <form class="my-form" action="" method="POST"> 
                    <div class="titulo-login">
                        <h1>LOGIN</h1>
                    </div>

                    <div class="input-text">
                        <span class="material-symbols-outlined"> person </span>
                        <input type="text" name="nome" id="name" placeholder="Nome" required>                        
                    </div>
                    <div class="input-text">    
                        <span class="material-symbols-outlined"> lock </span>                        
                        <input type="password" name="senha" id="senha" placeholder="Senha" required>
                    </div>

                    <input type="submit" value="Entrar" class="botao-login">
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
    </main>
</body>
</html>