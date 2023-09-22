<?php
include_once('../controller/protect.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/generalStyles.css">
    <link rel="stylesheet" href="css/styleHomePage.css">
    <link 
        rel="stylesheet" 
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" 
    />
    <title>Página Principal</title>
</head>
<body>
    
    <header class="header">
        <div class="usuario">
            <div id="usuario"><p>Gabriel Rocha</p></div>
            <div class="icon-usuario">
                <span class="material-symbols-outlined"> person </span>
            </div>
        </div>
    </header>

    <nav class="menu-lateral">
        <div class="logo">
            <!-- <a href="homePage.php"><img src="./css/imagens/logo.png" alt=""></a> -->
        </div>

        <div class="links-menu">
            <div class="conteiner-menu">
                <div class="icone-menu">
                    <img src="./css/imagens/editarAzul.png" alt="">
                </div>

                <div class="menu">
                    <a href="homePage.php">Home</a>
                </div>
            </div>

            <div class="conteiner-menu">
                <div class="icone-menu">
                    <img src="./css/imagens/editarAzul.png" alt="">
                </div>

                <div class="menu">
                    <a href="pageReceitas.php">Receitas</a>
                </div>
            </div>

            <div class="conteiner-menu">
                <div class="icone-menu">
                    <img src="./css/imagens/editarAzul.png" alt="">
                </div>

                <div class="menu">
                    <a href="pageLivroReceitas.php">Livro de Receitas</a>
                </div>
            </div>

            <div class="conteiner-menu">
                <div class="icone-menu">
                    <img src="./css/imagens/editarAzul.png" alt="">
                </div>

                <div class="menu">
                    <a href="pageCategoria.php">Categoria</a>
                </div>
            </div>

            <div class="conteiner-menu">
                <div class="icone-menu">
                    <img src="./css/imagens/editarAzul.png" alt="">
                </div>

                <div class="menu">
                    <a href="pageDegustacao.php">Degustação</a>
                </div>
            </div>

            <div class="conteiner-menu">
                <div class="icone-menu">
                    <img src="./css/imagens/editarAzul.png" alt="">
                </div>

                <div class="menu">
                    <a href="pageCargo.php">Cargo</a>
                </div>
            </div>
            
            <div class="conteiner-menu">
                <div class="icone-menu">
                    <img src="./css/imagens/editarAzul.png" alt="">
                </div>

                <div class="menu">
                    <a href="pageFuncionario.php">Funcionários</a>
                </div>
            </div>

            <div class="conteiner-menu">
                <div class="icone-menu">
                    <img src="./css/imagens/editarAzul.png" alt="">
                </div>

                <div class="menu">
                    <a href="pageRestaurante.php">Restaurantes</a>
                </div>
            </div>
            
        </div>
        
        <div class="conteiner-perfil">
            <div class="perfil">
                <div class="icon-usuario">
                    <span class="material-symbols-outlined"> person </span>
                </div>
                
                <div>
                    <a href="">Gabriel Rocha</a>
                </div>
                
                <div>
                    <a href="../controller/logoutController.php">
                        <img id="logout" src="css/iconsSVG/iconLogoout.svg" alt="logout">
                    </a>
                </div>
            </div>
        </div>

        <hr class="linha-separadora-menu">
        
    </nav>

    <section class="conteiner-conteudo">

        <div class="titulos" id="titulo">
            <h1>Bem-Vindo</h1>
        </div>

        <div class="box-busca">
            <div class="search-box">
                <form method="post" action="#">
                    <input type="text" class="search-box-input" name="busca" placeholder="Faça sua Pesquisa">
                    <button class="search-box-button"><i class="search-box-icone icon icon-search"></i></button>
                    
                </form>
            </div><!-- Search -->
        </div><!--Box Busca-->
        
        <div id="sub-titulo">
            <span><hr></span>
            <h2>Acesso Rápido</h2>
            <span><hr></span>
        </div>

        <div class="cards-conteiner">
            
            
            <div id="cards-conteiner-1">
                <div>
                    <a href="pageReceitas.php">
                        <div class="card">
                            <div><img src="css\imagens\Cookbook.png" alt=""></div>
                            <div><a href="pageReceitas.php">Receitas</a></div>
                        </div>
                    </a>
                </div>
                    

                <div>
                    <a href="pageLivroReceitas.php">
                            <div class="card">
                                <div><img src="css\imagens\Cookbook.png" alt=""></div>
                                <div><a href="pageLivroReceitas.php">Livros de Receitas</a></div>
                            </div>
                    </a>
                </div>

                <div>
                    <a href="pageCategoria.php">
                        <div class="card">
                            <div><img src="css\imagens\Cookbook.png" alt=""></div>
                            <div><a href="pageCategoria.php">Categorias</a></div>
                        </div>
                    </a>
                </div>

                
                <div>
                    <a href="pageDegustacao.php">
                        <div class="card">
                            <div><img src="css\imagens\Cookbook.png" alt=""></div>
                            <div><a href="pageDegustacao.php">Categorias</a></div>
                        </div>
                    </a>
                </div>
            </div>
           

            <div id="cards-conteiner-2">
                <div>
                    <a href="pageCargo.php">
                        <div class="card">
                            <div><img src="css\imagens\Restaurant.png" alt=""></div>
                            <div><a href="pageCargo.php">Cargo</a></div>
                        </div>
                    </a>
                </div>

                <div>
                    <a href="pageFuncionario.php">
                        <div class="card">
                            <div><img src="css\imagens\Management.png" alt=""></div>
                            <div><a href="pageFuncionario.php">Funcionários</a></div>
                        </div>
                    </a>
                </div>

                <div>
                    <a href="ageRestaurante.php">
                        <div class="card">
                            <div><img src="css\imagens\Restaurant.png" alt=""></div>
                            <div><a href="pageRestaurante.php">Restaurantes</a></div>
                        </div>
                    </a>
                </div>
            </div>
            
            
        </div>
    </section>

</body>
</html>