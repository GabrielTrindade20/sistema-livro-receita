<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/estiloCards.css">
    <title>Página de Receitas</title>
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
            <a href="estiloCards.php">Livro de Receitas</a>
            <a href="pageCategoria.php">Categoria</a>
            <a href="pageCargo.php">Cargo</a>
            <a href="pageFuncionario.php">Funcionários</a>
            <a href="pageRestaurante.php">Restaurantes</a>
        </div>

        <div id="perfil">
            <img src="https://www.imagensempng.com.br/wp-content/uploads/2021/08/02-52.png" alt="">
            <a href="">Perfil</a>
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