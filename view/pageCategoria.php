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
    <link rel="stylesheet" href="css/estiloTable.css">
    <title>Categorias</title>
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
            <a href="homePage.php">Homepage > </a>
            <a href="pageCategoria.php">Categoria</a>
        </div>

    <section class="conteiner-conteudo">
        
        <div class="titulos" id="titulo">
            <div>
                <h1>Categorias</h1>
            </div>

            <div>
                <a href=""><img src="css\imagens\Vector.png" alt=""></a>
            </div>
        </div>
        <hr>

        <div class="conteiner-table">    
            <table>
                <tr id="titulo-cards">
                    <th id="descricao">Descrição</th>
                    <th id="operacao">Operações</th>
                </tr>
                
                <tr>
                    <td>Bolos e Tortas</td>
                    <td><a href="Editar"><img src="css/imagens/deleteAzul.png" alt=""></a><a href=""><img src="css/imagens/editarAzul.png" alt=""></a></td>
                </tr>
                <tr>
                    <td>Saladas</td>
                    <td><a href="Editar"><img src="css/imagens/deleteAzul.png" alt=""></a><a href=""><img src="css/imagens/editarAzul.png" alt=""></a></td>
                </tr>
                <tr>
                    <td>Massas</td>
                    <td><a href="Editar"><img src="css/imagens/deleteAzul.png" alt=""></a><a href=""><img src="css/imagens/editarAzul.png" alt=""></a></td>
                </tr>
                <tr>
                    <td>Doces</td>
                    <td><a href="Editar"><img src="css/imagens/deleteAzul.png" alt=""></a><a href=""><img src="css/imagens/editarAzul.png" alt=""></a></td>
                </tr>
            </table>
        </div>
    </section>

</body>
</html>