<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once('../../../controller/protectSubFolders.php');
include_once('../../../configuration/connect.php');
include_once('../../../controller/receitaController.php');
include_once('../../../model/fotoModel.php');
include_once('../../../model/funcoes.php');

if (!isset($_SESSION['controlar_abas'])) {
    $_SESSION['controlar_abas'] = 0;
}

$fotoModel = new fotoModel($link);
$usuario = $_SESSION["id"];

// SALVAR FOTO
if (isset($_FILES["foto_receita"]) && $_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["upload"])) {

    $_SESSION['upload_form_foto'] = true;
    $arquivo = $_FILES["foto_receita"];

    if ($arquivo['error']) {
        $_SESSION["mensagem"] = "Falha ao enviar o arquivo";
    } elseif ($arquivo['size'] > 2097154) {
        $_SESSION["mensagem"] = "Arquivo muito grande! Max = 2MB";
    } else {
        $pasta = "../../../arquivos/";
        $nome_do_arquivo = $arquivo['name'];
        $novo_nome_arquivo = uniqid();
        $extensao = strtolower(pathinfo($nome_do_arquivo, PATHINFO_EXTENSION));

        if ($extensao != "jpg" && $extensao != "png") {
            $_SESSION["mensagem"] = "Tipo de arquivo não aceito";
        } else {
            $path = $pasta . $novo_nome_arquivo . '.' . $extensao;
            $deu_certo = move_uploaded_file($arquivo["tmp_name"], $path);

            if ($deu_certo) {
                $fotoModel->create($novo_nome_arquivo, $nome_do_arquivo, $path, $usuario);
                $_SESSION["mensagem"] = "Arquivo salvo!";
                $_SESSION["cadastro_sucesso"] = true;
                $_SESSION['controlar_abas'] = 1;
            } else {
                $_SESSION["mensagem"] = "Erro ao enviar.";
                $_SESSION["cadastro_sucesso"] = false;
            }
        }
    }
}

$ultima_foto = $foto_recuperada = $fotoModel->recuperaFoto();

if (isset($ultima_foto)) {
    $id_foto_receita = $ultima_foto['id_foto_receita'];
    $img_ultima = "<img src=" . $ultima_foto['path'] . ">";
    $link_img = "<a target=\"blank\" href=" . $ultima_foto['path'] . ">VER</a>";
    $delete_link_img = "<a href=\"pageReceitaCadastro.php?idFoto=" . $id_foto_receita . "&acao=deletar-foto\">DELETAR</a>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOSTRAP  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="../../components/style.css">

    <link rel="stylesheet" href="../../css/styleAllConteinerPages.css">
    <link rel="stylesheet" href="../../css/styleReceita.css">
    <link rel="icon" href="../../css/iconsSVG/iconReceita.svg">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Receita Cadastro</title>
</head>

<body>
    <!-- Menu lateral - vem de outra página -->
    <?php include '../../components/menuSub1.php'; ?>
    ?>
    <!-- Page Content -->
    <div id="content">
        <div class="container-fluid">
            <header>
                <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fas fa-align-left"></i>
                </button>
            </header>
        </div>
        <div class="conteudo">
            <div class="paginação-sub">
                <a href="../homePage.php">Homepage </a> >
                <a href="../pageReceitas.php"> Receitas </a> >
                <a href="#" class="pagina-atual"> Receitas Cadastro</a>
            </div>
            <!--  -->
            <section>
                <ul class="nav nav-tabs menu-abas" id="myTab" role="tablist">
                    <div class="menus-container">
                        <li class="nav-item" role="presentation">
                            <button class="aba-container" <?php if ($_SESSION['controlar_abas'] == 0)
                                echo "active"; ?>
                                id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button"
                                role="tab" aria-controls="home-tab-pane" aria-selected="true">Foto</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="aba-container" <?php if ($_SESSION['controlar_abas'] == 1)
                                echo "active"; ?>
                                id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button"
                                role="tab" aria-controls="profile-tab-pane" aria-selected="false">Informações</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="aba-container" <?php if ($_SESSION['controlar_abas'] == 2)
                                echo "active"; ?>
                                id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button"
                                role="tab" aria-controls="contact-tab-pane" aria-selected="false">Ingredientes</button>
                        </li>
                    </div>
                    <div class="acoes-container">
                        <li class="nav-item" role="presentation">
                            <button class="aba-container-acoes">(lixeira)</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="aba-container-acoes">Cancelar</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="aba-container-acoes">Salvar</button>
                        </li>
                    </div>
                </ul>
                <div class="foto">
                    <?php
                    if (isset($_SESSION["mensagem"])) {
                        echo $_SESSION["mensagem"];
                        unset($_SESSION["mensagem"]);
                    }
                    ?>
                </div>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane show <?php if ($_SESSION['controlar_abas'] == 0) {
                        echo "active";
                    } else {
                        echo " ";
                    } ?>" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        <!-- foto -->
                        <div class="conteiner-abas">
                            <div class="box-foto">
                                <?php
                                if (isset($ultima_foto) && isset($_SESSION["cadastro_sucesso"]) && $_SESSION["cadastro_sucesso"]) {
                                    $_SESSION['img_foto'] = $img_ultima;
                                    echo $_SESSION['img_foto'];
                                    unset($_SESSION["cadastro_sucesso"]);
                                }
                                ?>
                            </div>

                            <form enctype="multipart/form-data" action="" method="post" class="form-foto-container">
                                <label class="icon-arquivo">(inserir icone de arquivo)</label>
                                <div class="form-foto-container">
                                    <label class="input-imagem" for="foto_receita">Clique para fazer upload da
                                        imgem</label>
                                    <input style="display: none;" id="foto_receita" type="file" accept="image/*"> <br>
                                </div>
                                <label class="icon-lixeira">(inserir icone de lixeira)</label>
                                <!-- <button type="submit" id="file" name="upload" class="button">Salvar</button> -->
                            </form>
                        </div>

                    </div>
                    <!-- Notificação de erro ou não receita -->
                    <div class="mensagens">
                        <?php
                        if (isset($_SESSION["erros"])) {
                            $erros = $_SESSION["erros"];
                            foreach ($erros as $erro) {
                                echo $erro . "<br>";
                            }
                            unset($_SESSION["erros"]);
                        } elseif (isset($_SESSION["sucesso"])) {
                            $sucessos = $_SESSION["sucesso"];
                            foreach ($sucessos as $sucesso) {
                                echo $sucesso . "<br>";
                            }
                            unset($_SESSION["sucesso"]);
                        }
                        ?>
                    </div>
                    <div class="tab-pane  <?php if ($_SESSION['controlar_abas'] == 1) {
                        echo 'active';
                    } else {
                        echo ' ';
                    } ?>" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                        <!-- receita -->
                        <div class="conteiner-abas">
                            <section>
                                <form method="POST" action="../../../controller/receitaController.php">
                                    <!-- <div class="conteiner-form-colum-operacoes">
                                        <button type="submit" name="salvar" class="button">Salvar</button>
                                    </div> -->
                                    <div class="form-container">
                                        <div class="form-column">
                                            <label for="nome">Nome</label>
                                            <input type="text" id="nome" name="nome"
                                                value="<?php echo isset($_SESSION['nome_receita']) ? $_SESSION['nome_receita'] : ''; ?>"
                                                required>

                                            <label for="categoria">Categoria</label>
                                            <?php monta_select_categoria(isset($_SESSION['categoria']) ? $_SESSION['categoria'] : ''); ?>

                                            <label for="data_criacao">Data de Criação</label>
                                            <input type="date" id="data_criacao" name="data_criacao"
                                                value="<?php echo isset($_SESSION['data_criacao']) ? $_SESSION['data_criacao'] : ''; ?>"
                                                required>

                                            <label for="cozinheiro">Cozinheiro</label>
                                            <?php monta_select_cozinheiro(isset($_SESSION['cozinheiro']) ? $_SESSION['cozinheiro'] : ''); ?>

                                            <label for="qtd_porcao">Quantidade de Porções</label>
                                            <input type="number" id="qtd_porcao" name="qtd_porcao"
                                                value="<?php echo isset($_SESSION['qtd_porcao']) ? $_SESSION['qtd_porcao'] : ''; ?>"
                                                required>
                                        </div>
                                        <div class="form-column">
                                            <label for="degustador">Degustador</label>
                                            <?php monta_select_degustador(isset($_SESSION['degustador']) ? $_SESSION['degustador'] : ''); ?>

                                            <label for="nota_degustacao">Nota</label>
                                            <input type="number" id="nota_degustacao" name="nota_degustacao"
                                                value="<?php echo isset($_SESSION['nota_degustacao']) ? $_SESSION['nota_degustacao'] : ''; ?>">

                                            <label for="data_degustacao">Data de Degustação</label>
                                            <input type="date" id="data_degustacao" name="data_degustacao"
                                                value="<?php echo isset($_SESSION['data_degustacao']) ? $_SESSION['data_degustacao'] : ''; ?>">

                                            <label for="ind_inedita">Inédita</label>
                                            <div class="inedita-options">
                                                <input type="radio" id="sim" name="ind_inedita" value="S" <?php echo (isset($_SESSION['ind_inedita']) && $_SESSION['ind_inedita'] == 'S') ? 'checked' : ''; ?>>
                                                <label for="sim">Sim</label>
                                                <input type="radio" id="nao" name="ind_inedita" value="N" <?php echo (isset($_SESSION['ind_inedita']) && $_SESSION['ind_inedita'] == 'N') ? 'checked' : ''; ?>>
                                                <label for="nao">Não</label> <br>
                                            </div>
                                        </div>
                                        <div class="form-column">
                                            <h3 class="titulo" class="form-label">Modo de Preparo</h3>
                                            <textarea name="modo_preparo" id="" rows="10" cols="40"
                                                maxlength="4000"><?php echo isset($_SESSION['modo_preparo']) ? $_SESSION['modo_preparo'] : ''; ?></textarea>
                                        </div>
                                    </div>
                                </form>
                            </section>
                        </div>
                    </div>
                    <div class="tab-pane <?php if ($_SESSION['controlar_abas'] == 2) {
                        echo 'active';
                    } else {
                        echo ' ';
                    } ?>" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                        <!-- Cadastro medida ingrediente -->
                        <div class="conteiner-abas">

                            <div>
                                <form action="../../../controller/receitaController.php" method="post">
                                    <div class="form-pesquisa-ingredientes">
                                        <div class="inputs-container">
                                            <label>(icone de filtro)</label>
                                            <div class="fieldset-ingredientes">
                                                <input type="text" placeholder="Digite aqui o ingrediente">
                                                <button>+</button>
                                            </div>
                                            <div class="fieldset-ingredientes">
                                                <input type="text" placeholder="Digite aqui o ingrediente">
                                                <button>+</button>
                                            </div>
                                        </div>
                                        <button>+ Adicionar</button>
                                    </div>
                                    <!-- <input type="hidden" name="nome_receita" id="nome_receita"
                                        value="<?php echo isset($_SESSION['nome_receita']) ? $_SESSION['nome_receita'] : ''; ?>">
                                    <input type="hidden" name="idIngrediente" id="idIngrediente">
                                    <input type="hidden" name="idMedida" id="idMedida">

                                    <label for="ingrediente">Ingrediente</label>

                                    <input type="text" id="ingrediente" name="ingrediente"
                                        placeholder="Pesquisar Ingrediente" onkeyup="carregarIngrediente(this.value)"
                                        autocomplete="off">

                                    <span id="resultado-pesquisa-ingrediente"></span>

                                    <label for="medida">Medida</label>
                                    <input type="text" id="medida" name="medida" placeholder="Pesquisar Medida"
                                        onkeyup="carregarMedida(this.value)" autocomplete="off">

                                    <span id="resultado-pesquisa-medida"></span>

                                    <button type="submit" name="salvar_composicao">Adicionar</button> -->
                                </form>

                                <!-- <div class="box-link-i-m"> <a href="pageReceitaIngreMedida.php">Lista de
                                        Ingredientes e
                                        Medidas salvas</a></div> -->

                                <div class="table-lista">
                                    <!-- <h3>Lista de Ingredientes</h3> -->
                                    <table class="table" id="table">
                                        <thead>
                                            <tr>
                                                <th class="select-column"></th>
                                                <th>Medida</th>
                                                <th>Ingrediente</th>
                                                <th>Quantidade</th>
                                                <th class="operacao" colspan="2">OPERAÇÕES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Gerando de acordo com o que foi cadastrado -->
                                            <!-- <?php foreach ($dados_composicao as $index => $composicao): ?> -->
                                                <tr>
                                                    <td>A</td>
                                                    <td>
                                                        B
                                                        <!-- <?php echo $composicao['nome']; ?> -->
                                                    </td>
                                                    <td>
                                                        C
                                                        <!-- <?php echo $composicao['descricao']; ?> -->
                                                    </td>
                                                    <td>
                                                        D
                                                        <!-- <?php echo $composicao['qtd_medida']; ?> -->
                                                    </td>
                                                    <td>
                                                        <a onclick="" class="remover-restaurante"
                                                            href="pageReceitaIngreMedida.php?idIngrediente=<?php echo $ingrediente['idIngrediente']; ?>&acao=delete">
                                                            Remover </a>
                                                        <a onclick="editarComposicao(<?php echo $composicao['idIngrediente'] ?>, '<?php echo $composicao['nome'] ?>', '<?php echo $composicao['descricao']; ?>')"
                                                            href="#" class="editar-composicao" id="btn-salvar-composicao"
                                                            data-id="<?php echo $composicao['idIngrediente']; ?>">
                                                            Editar
                                                        </a>
                                                    </td>
                                                </tr>
                                                <!-- <?php endforeach; ?> -->
                                        </tbody>
                                    </table>
                                    <!-- <button>Salvar e Sair</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
        </div>
    </div>

    <script src="../../js/customReceita.js"></script>
    <script src="../../js/customReceita2.js"></script>

    <!-- BOOSTRAP JAVASCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>