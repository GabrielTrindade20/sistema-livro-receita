<?php
include_once('../../configuration/connect.php');
include_once('cargoModel.php');
include_once('../../controller/protectSubFolders.php');

$mensagem = '';

// Verifique se o ID do cargo foi passado na URL
if (isset($_GET['idCargo'])) {
    $idCargo = $_GET['idCargo'];

    // Crie uma instância do modelo CargoModel
    $cargoModel = new CargoModel($link);

    // Consulta SQL para obter os detalhes do cargo com base no ID
    $cargo = $cargoModel->obterCargoPorID($idCargo);

    // Verifique se o cargo foi encontrado
    if ($cargo) {
        // O cargo foi encontrado, agora você pode preencher o formulário com os dados do cargo
        $descricaoCargo = $cargo['descricao'];
    } else {
        // O cargo não foi encontrado, trate o erro aqui, por exemplo, redirecionando de volta à página anterior
        header("Location: pageCargo.php?mensagem=" . urlencode("Cargo não encontrado."));
        exit();
    }
} else {
    // O ID do cargo não foi passado na URL, trate o erro aqui, por exemplo, redirecionando de volta à página anterior
    header("Location: pageCargo.php?mensagem=" . urlencode("ID do cargo não fornecido."));
    exit();
}
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../view/css/styleMenu.css">
    <link rel="stylesheet" href="../../view/css/cssEdicao/styleEdicaoCarg.css">
    <link rel="icon" href="css/iconsSVG/iconReceita.svg">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Página Principal</title>
</head>


<body>
    <header class="header">
        <div class="usuario">
            <a href="">
                <span class="usuario-name">Gabriel Rocha</span>
                <span class="material-symbols-outlined"> person </span>
            </a>
        </div>
    </header>

    <nav class="menu-lateral">
        <div class="logo">
            <a href="homePage.php"><img src="../../view/css/img/logoIcon.png" alt="logo site livro de receitas"> </a>
        </div>

        <div class="links-menu">
            <div class="icone-menu">
                <a href="../../view/homePage.php">
                    <span class="material-symbols-outlined"> Home </span>
                    <span>Home</span>
                </a>
            </div>
            <div class="icone-menu">
                <a href="../pageReceitas.php">
                    <span class="material-symbols-outlined"> restaurant </span>
                    <span>Receitas</span>
                </a>
            </div>
            <div class="icone-menu">
                <a href="../../view/pageLivroReceitas.php">
                    <span class="material-symbols-outlined"> menu_book </span>
                    <span>Livro de Receitas</span>
                </a>
            </div>
            <div class="icone-menu">
                <a href="../../view/pageCargo.php">
                    <span class="material-symbols-outlined"> category </span>
                    <span>Categoria</span>
                </a>
            </div>
            <div class="icone-menu">
                <a href="../../view/pageDegustacao.php">
                    <span><img src="../../view/css/iconsSVG/iconDegustação.svg" alt=""></span>
                    <span>Degustação</span>
                </a>
            </div>
            <div class="icone-menu">
                <a href="../../view/pageCargo.php">
                    <span class="material-symbols-outlined"> patient_list </span>
                    <span>Cargo</span>
                </a>
            </div>
            <div class="icone-menu">
                <a href="../../view/pageFuncionario.php">
                    <span class="material-symbols-outlined"> group </span>
                    <span>Funcionários</span>
                </a>
            </div>
            <div class="icone-menu">
                <a href="../../view/pageRestaurante.php">
                    <span class="material-symbols-outlined"> restaurant_menu </span>
                    <span>Restaurantes</span>
                </a>
            </div>
        </div>

        <div class="perfil">
            <div class="icon-usuario">
                <a href="pagePerfil.php">
                    <span class="material-symbols-outlined"> person </span>
                    <span class="name">Gabriel Rocha</span>
                </a>
                <a href="./../../controller/logoutController.php">
                    <span class="material-symbols-outlined"> logout </span>
                </a>
            </div>
        </div>
    </nav>


    <!-- Estrutura do formulário de edição -->
    <section class="container-conteudo">
        <div>
            <h1>Editar Cargo</h1>
        </div>

        <div class="conteiner-abas">
            <h2>Nome do Cargo</h2>
            <form method="POST" action="atualizar_cargo.php">

                <div class="conteiner-dados">
                    <label for="nome">Nome do Cargo:</label>
                    <input type="text" id="descricao" name="descricao"
                        value="<?php echo isset($descricaoCargo) ? $descricaoCargo : ''; ?>" required>
                </div>
                <br>

                <div class="conteiner-operacoes">
                    <input type="hidden" name="idCargo" value="<?php echo $idCargo; ?>">
                    <button type="submit" name="editar">Editar</button>
                    
                    <a href="../../view/pageCargo.php">Cancelar</a>
                </div>
            </form>
        </div>
    </section>


</body>

</html>