<?php
include_once('../configuration/connect.php');
include_once('../model/modelCargo/cargoModel.php');

$cargoModel = new CargoModel($link);
$cargos = $cargoModel->listarCargos();
$numCargos = count($cargos);

?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/stylePesq.css">
    <link rel="stylesheet" href="css/styleMenu.css">
    <link rel="stylesheet" href="css/styleTabl.css">
    <link rel="icon" href="css/iconsSVG/iconReceita.svg">
    <link rel="stylesheet" href="css/styleResponsiv.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Página de Receitas</title>
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
                    <span class="name">Gabriel Rocha</span>
                </a>
                <a href="../controller/logoutController.php">
                    <span class="material-symbols-outlined"> logout </span>
                </a>
            </div>
        </div>
    </nav>

    <div id="sub-titulo">
        <a href="">links paginas</a>
    </div>

    <section class="conteiner-pesquisa">

        <div class="titulos" id="titulo">
            <div class="conteiner-titulo">
                <div>
                    <h1>Lista de Cargos</h1>
                </div>

                <div class="info-receitas">
                    <a href="">
                        <?php echo "($numCargos) Cargos"; ?>
                    </a>
                </div>
            </div>

            <div class="search-container">
                <div class="search-box">
                    <form method="post" action="#">
                        <div class="search-box-input-container">
                            <input type="text" class="search-box-input" name="busca" placeholder="Faça sua Pesquisa">
                            <button class="search-box-button"><i class="search-box-icone icon icon-search"></i></button>
                        </div>
                    </form>
                </div>

                <div class="button-nova">
                    <a href="Cargo/cargoCadastro.php">
                        <button class="nova-receita-button">Novo Cargo</button>
                    </a>
                </div>
            </div><!-- Search -->
        </div>
    </section>

    <section class="conteiner-conteudo">
        <table class="table">
            <thead>
                <tr>
                    <th class="select-column">-</th>
                    <th class="nome-col">Nome</th>
                    <th class="operacao-col">Operações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cargos as $index => $cargo): ?>
                    <tr class="<?php echo ($index % 2 == 0) ? 'even-row' : 'odd-row'; ?>">
                        <td class="select-column">
                            <a href=""><input type="checkbox"></a>
                        </td>
                        <td>
                            <?php echo $cargo['descricao']; ?>
                        </td>
                        <td class="operation-link">
                            <a href="../model/modelCargo/cargoEdicao.php?idCargo=<?php echo $cargo['idCargo']; ?>">
                                <img src="https://snz04pap002files.storage.live.com/y4m4-w_bDj25YrJN1L7ZcJhkuuzwPAluhLVfsCTxYJHZ-yLdvMQIzPR0KYV2ed70KJtFUL-WXP3LsaMUPLN9OKPPUQWhG_-6JWf2IqhR6AhEk4N8OG9X33jIK1wXhv9Q5ZIRY66yld3hjdSi29usXzRXN3w7eEdT_xaTIeHJoGAlxdAUIFHf-zVSS457EfXzn4N060oSD5MZdkuWf2f7eIfbK_VhTJwUQz3-bKXc1hRyBM?encodeFailures=1&width=56&height=56" alt="editar">
                            </a>

                            <!-- <form method="POST" action="../model/modelCargo/cargoEdicao.php">
                                <input type="hidden" name="idCargo" value="<?php echo $cargo['idCargo']; ?>">
                                <button type="submit" name="editar">Editar</button>
                            </form> -->


                            <form method="POST" action="../model/modelCargo/excluir_cargo.php">
                                <input type="hidden" name="idCargo" value="<?php echo $cargo['idCargo']; ?>">
                                <button type="submit" name="excluir" class="button">
                                    <img src="https://snz04pap002files.storage.live.com/y4ma1A6iNXOMgaNxs1BJHyqwEYHyyDhP-6oGnCFW5XhQFD0JdbvhbrHNGEetirDJa_w6YVwv4S2aeaIqn3eXJP-lJ34NHv8OGOMvPMV757xs4YzQEnzo3SZFuvwOquua0yYZ8FKzYhKwuyK2_47VqZernBMvrA7Jmr8PK58LjsaECEpJNz4ZlOIaJoboYVL1g9CugVtGsrGKxnjD8L2pLb2BHfURd5_D8tfphcBoTsfbIc?encodeFailures=1&width=47&height=56" alt="excluir">
                                </button>
                            </form>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

</body>

</html>