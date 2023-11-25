<link rel="stylesheet" href="../css/styleMenu.css">

<header class="header">
    <div class="usuario">
        <a href="">
            <span class="usuario-name"> <?php echo $_SESSION['nome']; ?> </span>
            <span class="material-symbols-outlined"> person </span>
        </a>
    </div>
</header>

<nav class="menu-lateral">
    <div class="logo">
        <a href="../pages/homePage.php">
            <img src="../css/img/logoIcon.png" alt="logo site livro de receitas"> 
        </a>
    </div>

    <div class="links-menu">
        <div class="icone-menu">
            <a href="../pages/homePage.php">
                <span class="material-symbols-outlined"> Home </span>
                
                <div class="name">
                    <span>Home</span>
                </div>
                
            </a>
        </div>
        <div class="icone-menu">
            <a href="../pages/pageReceitas.php">
                <span class="material-symbols-outlined"> restaurant </span>
                <div class="name">
                <span>Receitas</span>
                </div>
            </a>
        </div>
        <div class="icone-menu">
            <a href="../pages/pageLivroReceitas.php">
                <span class="material-symbols-outlined"> menu_book </span>
                <div class="name">
                <span>Livro de Receitas</span>
                </div>
            </a>
        </div>
        <div class="icone-menu">
            <a href="../pages/pageCategoria.php">
                <span class="material-symbols-outlined"> category </span>
                <div class="name">
                <span>Categoria</span>
                </div>
            </a>
        </div>
        <div class="icone-menu">
            <a href="../pages/pageDegustacao.php">
                <span><img src="../css/iconsSVG/iconDegustação.svg" alt=""></span>
                <div class="name">
                <span>Degustação</span>
                </div>
            </a>
        </div>
        <div class="icone-menu">
            <a href="../pages/pageCargo.php">
                <span class="material-symbols-outlined"> patient_list </span>
                <div class="name">
                <span>Cargo</span>
                </div>
            </a>
        </div>
        <div class="icone-menu">
            <a href="../pages/pageFuncionario.php">
                <span class="material-symbols-outlined"> group </span>
                <div class="name">
                <span>Funcionários</span>
                </div>
            </a>
        </div>
        <div class="icone-menu">
            <a href="../pages/pageRestaurante.php">
                <span class="material-symbols-outlined"> restaurant_menu </span>
                <div class="name">
                <span>Referência</span>
                </div>
            </a>
        </div>
    </div>

    <div class="perfil">
        <div class="icon-usuario">
            <a href="">
                <span class="material-symbols-outlined"> person </span>
                <div class="name">
                <span class="name"> <?php echo $_SESSION['nome']; ?> </span>
                </div>
            </a>
            <a href="../../controller/logoutController.php">
                <span class="material-symbols-outlined"> logout </span>
            </a>
        </div>
    </div>
</nav>