<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/generalStyles.css">
    <link rel="stylesheet" href="css/estiloCards.css">
    <title>Página de Receitas</title>
</head>
<body>
    
<header class="header">
        <div class="usuario">
            <div id="usuario"><p>Gabriel Rocha</p></div>
            <div><img src="https://www.imagensempng.com.br/wp-content/uploads/2021/08/02-52.png" alt="usuário"></div>
        </div>
    </header>

    <nav class="menu-lateral">
        <div class="logo">
            <a href="homePage.php"><img src="./css/imagens/logo.png" alt=""></a>
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
                <div>
                    <img src="https://www.imagensempng.com.br/wp-content/uploads/2021/08/02-52.png" alt="usuário" id="icone-usuario">
                </div>
                
                <div>
                    <a href="">Gabriel Rocha</a>
                </div>
                
                <div>
                    <a href="../controller/logoutController.php"><img id="logout" src="https://raw.githubusercontent.com/GabrielTrindade20/Projeto-Livro-Receta/2d7a4f2b3a9cb0a2670d48c5790af5f1f21e1f9c/view/css/iconsSVG/iconLogoout.svg?token=AYIZEWTYADPF36E3ZR7N2M3FBCHZQ" alt="logout"></a>
                </div>
            </div>
        </div>

        <hr class="linha-separadora-menu">
        
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