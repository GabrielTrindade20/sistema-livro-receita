<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleMenu.css">
    <link rel="icon" href="css/iconsSVG/iconReceita.svg">
    <link 
        rel="stylesheet" 
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" 
    />
    <link rel="stylesheet" href="css/estiloCards.css">
    <title>Página de Receitas</title>
</head>
<body>
    <header class="header">
        <div class="usuario">
            <div id="usuario">
                <a href="">
                    <span class="material-symbols-outlined"> person </span>
                    Gabriel Rocha
                </a>
            </div>
        </div>
    </header>

    <nav class="menu-lateral">
        <div class="logo">
            <a href="homePage.php"><img src="../view/css/img/logoIcon.png" alt="logo site livro de receitas"> </a> 
        </div>

        <div class="links-menu">
            <div class="icone-menu">
                <a href="homePage.php">
                    <span class="material-symbols-outlined"> Home </span>
                    <span>Home</span>
                </a>             
            </div>
            <div class="icone-menu">
                <a href="pageReceitas.php">
                    <span class="material-symbols-outlined"> restaurant </span>
                    <span>Receitas</span>
                </a>           
            </div>
            <div class="icone-menu">
                <a href="pageLivroReceitas.php">
                    <span class="material-symbols-outlined"> menu_book </span>
                    <span>Livro de Receitas</span>
                </a>        
            </div>
            <div class="icone-menu">
                <a href="pageCategoria.php">
                    <span class="material-symbols-outlined"> category </span>
                    <span>Categoria</span>
                </a>           
            </div>
            <div class="icone-menu">
                <a href="pageDegustacao.php">
                    <span><img src="../view/css/iconsSVG/iconDegustação.svg" alt=""></span>
                    <span>Degustação</span>
                </a>          
            </div>
            <div class="icone-menu">
                <a href="pageCargo.php">
                    <span class="material-symbols-outlined"> patient_list </span>
                    <span>Cargo</span>
                </a>         
            </div>
            <div class="icone-menu">                
                <a href="pageFuncionario.php">
                    <span class="material-symbols-outlined"> group </span>
                    <span>Funcionários</span>
                </a>         
            </div>
            <div class="icone-menu">              
                <a href="pageRestaurante.php">
                    <span class="material-symbols-outlined"> restaurant_menu </span>
                    <span>Restaurantes</span>
                </a>         
            </div>            
        </div>

        <div class="perfil">
            <div class="icon-usuario">
                <a href="pagePerfil.php">
                    <span class="material-symbols-outlined"> person </span>
                    Gabriel Rocha
                </a>
            </div>
            <div class="icon-logout">
                <a href="../controller/logoutController.php">
                    <span class="material-symbols-outlined"> logout </span>
                </a>
            </div>
        </div>   
    </nav>

        <div id="sub-titulo">
            <a href="">links paginas</a>
        </div>

    <section class="conteiner-conteudo">
        
        <div class="titulos" id="titulo">
            <div>
                <h1>Livro de Receitas</h1>
            </div>

            <div>
                <a href=""><img src="css\imagens\Vector.png" alt=""></a>
            </div>
        </div>
        <hr>


        <div class="conteiner-cards">
        <?php include('../configuration/generate_cards.php');?>



    
        

            <!-- <div class="card">
                <div><img src="https://static.itdg.com.br/images/1200-630/901f400bf4dd4e6e9e2ab65bcec454d8/354055-original.jpg" alt=""></div>
                <div class="conteudo-card">
                    <div class="nomeReceita">
                        <a href="pageReceitas.php">Receitas de Milho</a>
                    </div>
                    <div class="edicaoReceita">
                        <div><a href=""><img src="css\imagens\editar.png" alt=""></a></div>
                        <div><a href=""><img src="css\imagens\delete.png" alt=""></a></div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div><img src="https://cdn.aquelareceita.com.br/recipes/image-1641392334286-1641924644344.png" alt=""></div>
                <div class="conteudo-card">
                    <div class="nomeReceita">
                        <a href="pageReceitas.php">Receitas de Cenoura</a>
                    </div>
                    <div class="edicaoReceita">
                        <div><a href=""><img src="css\imagens\editar.png" alt=""></a></div>
                        <div><a href=""><img src="css\imagens\delete.png" alt=""></a></div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div><img src="" alt=""></div>
                <div class="conteudo-card">
                    <div class="nomeReceita">
                        <a href="pageReceitas.php">Receitas de Limão</a>
                    </div>
                    <div class="edicaoReceita">
                        <div><a href=""><img src="css\imagens\editar.png" alt=""></a></div>
                        <div><a href=""><img src="css\imagens\delete.png" alt=""></a></div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div><img src="https://static.itdg.com.br/images/1200-630/901f400bf4dd4e6e9e2ab65bcec454d8/354055-original.jpg" alt=""></div>
                <div class="conteudo-card">
                    <div class="nomeReceita">
                        <a href="pageReceitas.php">Receitas de Milho</a>
                    </div>
                    <div class="edicaoReceita">
                        <div><a href=""><img src="css\imagens\editar.png" alt=""></a></div>
                        <div><a href=""><img src="css\imagens\delete.png" alt=""></a></div>
                    </div>
                </div>
            </div> -->
        </div>
    </section>
</body>
</html>