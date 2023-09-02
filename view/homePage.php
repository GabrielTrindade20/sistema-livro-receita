<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/homepage.css">
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
            <a href="pageCargo.php">Cargo</a>
            <a href="pageFuncionario.php">Funcionários</a>
            <a href="pageRestaurante.php">Restaurantes</a>
        </div>

        <div id="perfil">
            <img src="https://www.imagensempng.com.br/wp-content/uploads/2021/08/02-52.png" alt="">
            <a href="">Perfil</a>
        </div>
    </nav>

    <section class="conteiner-conteudo">
        <div class="titulos" id="titulo">
            <h1>Bem-Vindo</h1>
        </div>

        <div id="sub-titulo">
            <h2>Acesso Rápido</h2>
        </div>
        <hr>

        <div id="cards-conteiner">
            
            <div class="card">
                <div><img src="css\imagens\Tableware.png" alt="" width="90px"></div>
                <div><a href="pageReceitas.php">Receitas</a></div>
            </div>

            <div class="card">
                <div><img src="css\imagens\Cookbook.png" alt=""></div>
                <div><a href="pageLivroReceitas.php">Livros de Receitas</a></div>
            </div>

            <div class="card">
                <div><img src="css\imagens\Cookbook.png" alt=""></div>
                <div><a href="pageCategoria.php">Categorias</a></div>
            </div>

            <div class="card">
                <div><img src="css\imagens\Restaurant.png" alt=""></div>
                <div><a href="pageCargo.php">Cargo</a></div>
            </div>

            <div class="card">
                <div><img src="css\imagens\Management.png" alt=""></div>
                <div><a href="pageFuncionario.php">Funcionários</a></div>
            </div>

            <div class="card">
                <div><img src="css\imagens\Restaurant.png" alt=""></div>
                <div><a href="pageRestaurante.php">Restaurantes</a></div>
            </div>
        </div>
    </section>

</body>
</html>