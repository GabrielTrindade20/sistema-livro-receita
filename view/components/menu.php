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
                <span>Home</span>
            </a>
        </div>
        <div class="icone-menu">
            <a href="../pages/pageReceitas.php">
                <span class="material-symbols-outlined"> restaurant </span>
                <span>Receitas</span>
            </a>
        </div>
        <div class="icone-menu">
            <a href="../pages/pageLivroReceitas.php">
                <span class="material-symbols-outlined"> menu_book </span>
                <span>Livro de Receitas</span>
            </a>
        </div>
        <div class="icone-menu">
            <a href="../pages/pageCategoria.php">
                <span class="material-symbols-outlined"> category </span>
                <span>Categoria</span>
            </a>
        </div>
        <div class="icone-menu">
            <a href="../pages/pageDegustacao.php">
                <span><img src="../css/iconsSVG/iconDegustação.svg" alt=""></span>
                <span>Degustação</span>
            </a>
        </div>
        <div class="icone-menu">
            <a href="../pages/pageCargo.php">
                <span class="material-symbols-outlined"> patient_list </span>
                <span>Cargo</span>
            </a>
        </div>
        <div class="icone-menu">
            <a href="../pages/pageFuncionario.php">
                <span class="material-symbols-outlined"> group </span>
                <span>Funcionários</span>
            </a>
        </div>
        <div class="icone-menu">
            <a href="../pages/pageRestaurante.php">
                <span class="material-symbols-outlined"> restaurant_menu </span>
                <span>Restaurantes</span>
            </a>
        </div>
    </div>

    <div class="perfil">
        <div class="icon-usuario">
            <a href="">
                <span class="material-symbols-outlined"> person </span>
                <span class="name"> <?php echo $_SESSION['nome']; ?> </span>
            </a>
            <a href="../../controller/logoutController.php">
                <span class="material-symbols-outlined"> logout </span>
            </a>
        </div>
    </div>
</nav>