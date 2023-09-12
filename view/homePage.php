<?php
include_once('../controller/protect.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/homePage.css">
    <title>Página Principal</title>
</head>
<body>
    
    <header class="header">
        <div class="usuario">
            <div id="usuario"><p>Gabriel Trindade Rocha</p></div>
            <div id><img src="https://www.imagensempng.com.br/wp-content/uploads/2021/08/02-52.png" alt="usuário"></div>
        </div>
    </header>

    <nav class="menu-lateral">
        <div class="links-menu">
            <img src="https://img.freepik.com/vetores-premium/modelo-de-vetor-de-design-de-logotipo-de-chef-de-cozinha_15146-1164.jpg?w=2000" alt="">
        </div>
        <div class="links-menu" id="a-menu">
            <a href="homePage.php">Home</a>
            <a href="pageReceitas.php">Receitas</a>
            <a href="pageLivroReceitas.php">Livro de Receitas</a>
            <a href="pageCategoria.php">Categoria</a>
            <a href="pageDegustacao.php">Degustação</a>
            <a href="pageCargo.php">Cargo</a>
            <a href="pageFuncionario.php">Funcionários</a>
            <a href="pageRestaurante.php">Restaurantes</a>
        </div>

        <div id="perfil">
            <img src="https://www.imagensempng.com.br/wp-content/uploads/2021/08/02-52.png" alt="">
            <a href="">Perfil</a>
            <a href="../controller/logoutController.php">Sair</a>
        </div>
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
                <a href="pageReceitas.php">
                    <div class="card">
                        <div><img src="css\imagens\Tableware.png" alt=""></div>
                        <div><a href="pageReceitas.php">Receitas</a></div>
                    </div>
                </a>
                

                <a href="pageLivroReceitas.php">
                    <div class="card">
                        <div><img src="css\imagens\Cookbook.png" alt=""></div>
                        <div><a href="pageLivroReceitas.php">Livros de Receitas</a></div>
                    </div>
                </a>

                <a href="pageCategoria.php">
                    <div class="card">
                        <div><img src="css\imagens\Cookbook.png" alt=""></div>
                        <div><a href="pageCategoria.php">Categorias</a></div>
                    </div>
                </a>

                <a href="pageDegustacao.php">
                    <div class="card">
                        <div><img src="css\imagens\Cookbook.png" alt=""></div>
                        <div><a href="pageDegustacao.php">Categorias</a></div>
                    </div>
                </a>
            </div>

            <div id="cards-conteiner-2">
                <a href="pageCargo.php">
                    <div class="card">
                        <div><img src="css\imagens\Restaurant.png" alt=""></div>
                        <div><a href="pageCargo.php">Cargo</a></div>
                    </div>
                </a>

                <a href="pageFuncionario.php">
                    <div class="card">
                        <div><img src="css\imagens\Management.png" alt=""></div>
                        <div><a href="pageFuncionario.php">Funcionários</a></div>
                    </div>
                </a>

                <a href="ageRestaurante.php">
                    <div class="card">
                        <div><img src="css\imagens\Restaurant.png" alt=""></div>
                        <div><a href="pageRestaurante.php">Restaurantes</a></div>
                    </div>
                </a>
            </div>
        </div>
    </section>

</body>
</html>