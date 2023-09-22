<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Página Principal</title>
    <link rel="icon" href="css/iconsSVG/iconReceita.svg">
    <link rel="stylesheet" href="css/generalStyles.css">
    <link rel="stylesheet" href="css/styleHomePage.css">
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"
    />
    <link rel="stylesheet" href="css/styleMenu.css" />
  </head>
  <body>
    <aside class="sidebar">
      <header class="sidebar-header">
        <img class="logo-img" src="css/logo.png" />
      </header>
      <nav>
        <button>
          <span>
            <i class="material-symbols-outlined"> home </i>
            <span>Home</span>
          </span>
        </button>
        <button onclick="window.location.href = 'pageReceitas.php'">    
          <span>
            <i class="material-symbols-outlined"> restaurant </i>
            <span>Receitas</span>
        </span>
        </button>
        <button onclick="window.location.href = 'pageLivroReceits.php'">
          <span>
            <i class="material-symbols-outlined">
                menu_book
            </i>
            <span>Livro de Receitas</span>
          </span>
        </button>
        <button onclick="window.location.href = 'pageCategoria.php'">
          <span>
            <i class="material-symbols-outlined"> category </i>
            <span>Categorias</span>
          </span>
        </button>
        <button onclick="window.location.href = 'pageDegustacao.php'">
          <span>
            <i class="material-symbols-outlined"> bookmark </i>
            <span>Degustação</span>
          </span>
        </button>
        <button onclick="window.location.href = 'pageCargo.php'">
          <span>
            <i class="material-symbols-outlined"> person </i>
            <span>Cargo</span>
          </span>
        </button>
        <button onclick="window.location.href = 'pageFuncionarios.php'">
          <span>
            <i class="material-symbols-outlined"> group </i>
            <span>Funcionarios</span>
          </span>
        </button>
        <button onclick="window.location.href = 'pageRestaurante.php'">
          <span>
            <i class="material-symbols-outlined"> restaurant_menu </i>
            <span>Restaurantes</span>
          </span>
        </button>
        <button class="user-button" >
          <span>
            <i class="material-symbols-outlined"> manage_accounts </i>
            <span>
              <span class="fullname"> Joe </span>
            </span>
                <a href="../controller/logoutController.php"> 
                    <i class="material-symbols-outlined"> logout </i>
                </a>   
          </span>
        </button>
      </nav>
    </aside>
    
    
  </body>
</html>