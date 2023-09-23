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
                <h1>Cargos</h1>
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
                    <td>Cozinheiro</td>
                    <td><a href="Editar"><img src="css/imagens/deleteAzul.png" alt=""></a><a href=""><img src="css/imagens/editarAzul.png" alt=""></a></td>
                </tr>
                <tr>
                    <td>Degustador</td>
                    <td><a href="Editar"><img src="css/imagens/deleteAzul.png" alt=""></a><a href=""><img src="css/imagens/editarAzul.png" alt=""></a></td>
                </tr>
                <tr>
                    <td>Editor de Livros</td>
                    <td><a href="Editar"><img src="css/imagens/deleteAzul.png" alt=""></a><a href=""><img src="css/imagens/editarAzul.png" alt=""></a></td>
                </tr>
            </table>
        </div>
    </section>

</body>
</html>