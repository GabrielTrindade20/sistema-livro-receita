
<!-- Bootstrap CSS CDN -->
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"> -->
<!-- Our Custom CSS -->
<!-- <link rel="stylesheet" href="../components/style.css"> -->

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

<!-- Font Awesome JS -->
<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"></script>
<title>Document</title>

<div class="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="logo">
            <a href="../pages/homePage.php">
                <img src="../../css/img/logoIcon.png" alt="logo site livro de receitas">
            </a>
        </div>

        <ul class="list-unstyled components">
            <li class="active">
                <div class="links-menu">
                    <div class="icone-menu">
                        <a href="../../pages/homePage.php">
                            <span class="material-symbols-outlined"> Home </span>

                            <div class="name">
                                <span>Home</span>
                            </div>

                        </a>
                    </div>
                    <div class="icone-menu">
                        <a href="../../pages/pageReceitas.php">
                            <span class="material-symbols-outlined"> restaurant </span>
                            <div class="name">
                                <span>Receitas</span>
                            </div>
                        </a>
                    </div>
                    <div class="icone-menu">
                        <a href="../../pages/pageLivroReceitas.php">
                            <span class="material-symbols-outlined"> menu_book </span>
                            <div class="name">
                                <span>Livro de Receitas</span>
                            </div>
                        </a>
                    </div>
                    <div class="icone-menu">
                        <a href="../../pages/pageCategoria.php">
                            <span class="material-symbols-outlined"> category </span>
                            <div class="name">
                                <span>Categoria</span>
                            </div>
                        </a>
                    </div>
                    <div class="icone-menu">
                        <a href="../../pages/pageDegustacao.php">
                            <span class="material-symbols-outlined"> dinner_dining </span>
                            <div class="name">
                                <span>Degustação</span>
                            </div>
                        </a>
                    </div>
                    <div class="icone-menu">
                        <a href="../../pages/pageCargo.php">
                            <span class="material-symbols-outlined"> patient_list </span>
                            <div class="name">
                                <span>Cargo</span>
                            </div>
                        </a>
                    </div>
                    <div class="icone-menu">
                        <a href="../../pages/pageFuncionario.php">
                            <span class="material-symbols-outlined"> group </span>
                            <div class="name">
                                <span>Funcionários</span>
                            </div>
                        </a>
                    </div>
                    <div class="icone-menu">
                        <a href="../../pages/pageRestaurante.php">
                            <span class="material-symbols-outlined"> restaurant_menu </span>
                            <div class="name">
                                <span>Referência</span>
                            </div>
                        </a>
                    </div>
                    </div>
                    <div class="perfil">
                        <a href="">
                            <span class="material-symbols-outlined"> person </span>
                            <div class="name">
                                <span class="name"> <?php echo $_SESSION['nome']; ?> </span>
                            </div>
                        </a>
                        <a href="../../../controller/logoutController.php">
                            <span class="material-symbols-outlined"> logout </span>
                        </a>
                    </div>
                </div>
            </li>
        </ul>
    </nav>
</div>

</div>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var sidebar = document.getElementById('sidebar');
        var content = document.getElementById('content');
        var sidebarCollapse = document.getElementById('sidebarCollapse');

        sidebarCollapse.addEventListener('click', function() {
            sidebar.classList.toggle('active');
            content.classList.toggle('active');

            var collapseElements = document.querySelectorAll('.collapse.in');
            collapseElements.forEach(function(element) {
                element.classList.toggle('in');
            });
        });
    });
</script>
