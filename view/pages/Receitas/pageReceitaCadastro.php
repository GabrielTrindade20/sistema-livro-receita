<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once('../../../controller/protectSubFolders.php');
include_once('../../../configuration/connect.php');
include_once('../../../controller/receitaController.php');
include_once('../../../controller/receitaComposicaoController.php');
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
            $path =   $pasta . $novo_nome_arquivo . '.' . $extensao;
            $deu_certo = move_uploaded_file($arquivo["tmp_name"], $path);

            if ($deu_certo) {
                $fotoModel->create($novo_nome_arquivo, $nome_do_arquivo, $path, $usuario);
                $_SESSION["mensagem"] = "Foto salva!";
                $_SESSION["cadastro_sucesso"] = true;
                // Armazene o ID da última foto salva na sessão
                $_SESSION["ultima_id_foto_receita"] = $fotoModel->recuperaUltimoIdFoto();
                //echo $_SESSION["ultima_id_foto_receita"];
                $_SESSION['controlar_abas'] = 1;
            } else {
                $_SESSION["mensagem"] = "Erro ao enviar.";
                $_SESSION["cadastro_sucesso"] = false;
            }
        }
    }
}

$ultima_foto = $foto_recuperada = $fotoModel->recuperaFoto();

if (isset($ultima_foto) && isset($_SESSION["cadastro_sucesso"]) &&  $_SESSION["cadastro_sucesso"]) {
    $id_foto_receita =  $ultima_foto['id_foto_receita'];
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="../../components/style.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <link rel="stylesheet" href="../../css/styleAllConteinerPages.css">
    <link rel="stylesheet" href="../../css/styleReceita.css">
    <link rel="icon" href="../../css/iconsSVG/iconReceita.svg">

    <title>Receita Cadastro</title>
</head>

<body>
    <!-- Menu lateral -->
    <?php include '../../components/menuSub1.php'; ?>
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
                <a href="#" class="pagina-atual"> Receita Cadastro</a>
            </div>
            <section>

                <ul class="nav nav-tabs justify-content-end" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?php if ($_SESSION['controlar_abas'] == 0) echo "active"; ?>" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Foto</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?php if ($_SESSION['controlar_abas'] < 1) echo "disabled"; ?> <?php if ($_SESSION['controlar_abas'] == 1) echo "active"; ?>" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Dados</button>

                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?php if ($_SESSION['controlar_abas'] < 2) echo "disabled"; ?><?php if ($_SESSION['controlar_abas'] == 2) echo "active"; ?>" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Ingredientes</button>
                    </li>
                    <li class="nav-item ms-auto" role="presentation">
                        <a class="nav-link " href="../pageReceitas.php">Sair</a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="mensagens" id="mensagemFoto">
                        <?php
                        if (isset($_SESSION["mensagem"])) {
                            echo $_SESSION["mensagem"];
                            unset($_SESSION["mensagem"]);
                        }
                        ?>
                    </div>
                    <!-- foto form -->
                    <div class="tab-pane show <?php if ($_SESSION['controlar_abas'] == 0) {
                                                    echo "active";
                                                } else {
                                                    echo " ";
                                                } ?>" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        <!-- foto -->
                        <div class="conteiner-abas">
                            <div class="box-foto">
                                <?php
                                if (isset($ultima_foto) && isset($_SESSION["cadastro_sucesso"]) &&  $_SESSION["cadastro_sucesso"]) {
                                    $_SESSION['img_foto'] = $img_ultima;
                                    echo $_SESSION['img_foto'];
                                }
                                ?>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-6">
                                    <form enctype="multipart/form-data" action="" method="post">
                                        <div class="mb-3">
                                            <label for="foto_receita" class="form-label">Foto da Receita</label>
                                            <input class="form-control" type="file" id="formFile" accept="image/*" name="foto_receita">

                                            <button type="submit" id="file" name="upload" class="btn btn-primary">Salvar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Notificação de erro ou não receita -->
                    <div class="mensagens" id="mensagemR">
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

                    <!-- receita form -->
                    <div class="tab-pane  <?php if ($_SESSION['controlar_abas'] == 1) {
                                                echo 'active';
                                            } else {
                                                echo ' ';
                                            } ?>" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                        <!-- receita -->
                        <div class="conteiner-abas">
                            <section>
                                <div class="row justify-content-center">
                                    <div class="col-6">
                                        <form method="POST" action="../../../controller/receitaController.php">
                                            <div class="form">
                                                <div class="mb-3">
                                                    <label for="nome" class="form-label">Nome</label>
                                                    <input type="text" class="form-control" id="nome" name="nome" value="<?php echo isset($_SESSION['nome_receita']) ? $_SESSION['nome_receita'] : ''; ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="data_criacao" class="form-label">Data de Criação</label>
                                                    <input type="date" class="form-control" id="data_criacao" name="data_criacao" value="<?php echo isset($_SESSION['data_criacao']) ? $_SESSION['data_criacao'] : ''; ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="qtd_porcao" class="form-label">Quantidade de Porções</label>
                                                    <input type="number" class="form-control" id="qtd_porcao" name="qtd_porcao" value="<?php echo isset($_SESSION['qtd_porcao']) ? $_SESSION['qtd_porcao'] : ''; ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                        <label for="degustador" class="form-label">Degustador</label>
                                                        <?php monta_select_degustador(isset($_SESSION['degustador']) ? $_SESSION['degustador'] : '');  ?>                                                
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nota_degustacao" class="form-label">Nota</label>
                                                    <input type="number" class="form-control" id="nota_degustacao" name="nota_degustacao" value="<?php echo isset($_SESSION['nota_degustacao']) ? $_SESSION['nota_degustacao'] : ''; ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="data_degustacao" class="form-label">Data de Degustação</label>
                                                    <input type="date" class="form-control" id="data_degustacao" name="data_degustacao" value="<?php echo isset($_SESSION['data_degustacao']) ? $_SESSION['data_degustacao'] : ''; ?>">
                                                </div>

                                                <div class="conteiner-dados-input-select">
                                                    <div class="mb-3">
                                                        <label for="ind_inedita" class="form-label">Inédita</label> <br>
                                                        <input type="radio" id="sim" name="ind_inedita" value="S" <?php echo (isset($_SESSION['ind_inedita']) && $_SESSION['ind_inedita'] == 'S') ? 'checked' : ''; ?>>
                                                        <label for="sim" class="form-label">Sim</label>
                                                        <input type="radio" id="nao" name="ind_inedita" value="N" <?php echo (isset($_SESSION['ind_inedita']) && $_SESSION['ind_inedita'] == 'N') ? 'checked' : ''; ?>>
                                                        <label for="nao" class="form-label">Não</label> <br>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="cozinheiro" class="form-label">Cozinheiro</label>
                                                        <?php monta_select_cozinheiro(isset($_SESSION['cozinheiro']) ? $_SESSION['cozinheiro'] : ''); ?>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="categoria" class="form-label">Categoria</label>
                                                        <?php monta_select_categoria2(isset($_SESSION['categoria']) ? $_SESSION['categoria'] : ''); ?>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <h3 class="titulo" class="form-label">Modo de Preparo</h3>
                                                    <textarea class="form-control" name="modo_preparo" id="" rows="10" cols="40" maxlength="4000"><?php echo isset($_SESSION['modo_preparo']) ? $_SESSION['modo_preparo'] : ''; ?></textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <button type="submit" name="salvar" class="btn btn-primary">Salvar e Próximo</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>

                    <!-- composição -->
                    <div class="tab-pane <?php if ($_SESSION['controlar_abas'] == 2) {
                                                echo 'active';
                                            } else {
                                                echo ' ';
                                            } ?>" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                        <!-- Cadastro medida ingrediente -->
                        <div class="conteiner-abas">

                            <div class="composicao">
                                <form action="../../../controller/receitaComposicaoController.php" method="post">
                                    <input type="hidden" name="acao" id="acao" value="salvar">
                                    <input type="hidden" name="nome_receita" id="nome_receita" value="<?php echo isset($_SESSION['nome_receita']) ? $_SESSION['nome_receita'] : ''; ?>">
                                    <input type="hidden" name="idIngrediente" id="idIngrediente" value="">
                                    <input type="hidden" name="idMedida" id="idMedida" value="">

                                    <div class="row">
                                        <div class="col">
                                            <label for="ingrediente">Ingrediente</label>
                                            <input type="text" class="form-control" id="ingrediente" name="ingrediente" placeholder="Pesquisar Ingrediente" onkeyup="carregarIngrediente(this.value)" autocomplete="off">
                                            <span id="resultado-pesquisa-ingrediente"></span>
                                        </div>
                                        <div class="col">
                                            <label for="medida">Medida</label>
                                            <input type="text" class="form-control" id="medida" name="medida" placeholder="Pesquisar Medida" onkeyup="carregarMedida(this.value)" autocomplete="off">
                                            <span id="resultado-pesquisa-medida"></span>
                                        </div>
                                        <div class="col">
                                            <label for="quantidade">Quantidade</label>
                                            <input type="number" class="form-control" placeholder="Ex: 0" name="quantidade" id="quantidade">
                                        </div>
                                        <div class="col button">
                                            <button type="submit" name="salvar_composicao"  class="btn btn-primary">Adicionar</button>
                                        </div>
                                        <div class="row justify-content-center">
                                        <div class="col-5">
                                            <div class="box-link">
                                                <a href="pageReceitaIngreMedida.php">Lista de Ingredientes e Medidas salvas</a>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="table-lista">
                                <h4>Lista de Ingredientes</h4>
                                <table class="table" id="table">
                                    <thead>
                                        <tr>
                                            <th class="select-column"></th>
                                            <th>Ingredientes</th>
                                            <th>Medidas</th>
                                            <th>Quantidade</th>
                                            <th class="operacao">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Gerando de acordo com o que foi cadastrado -->
                                        <?php foreach ($dados_composicao as $index => $composicao) : ?>
                                            <tr>
                                                <td></td>
                                                <td> <?php echo $composicao['nome']; ?> </td>
                                                <td> <?php echo $composicao['descricao']; ?> </td>
                                                <td> <?php echo $composicao['qtd_medida']; ?> </td>
                                                <td>
                                                    <a onclick="excluirComposicao(this, '<?php echo $composicao['nome_receita']; ?>', <?php echo $composicao['idIngrediente']; ?>, <?php echo $composicao['idMedida']; ?>)" href="#">
                                                        <span class="material-symbols-outlined"> delete </span>
                                                    </a>

                                                    <a onclick="editarComposicao('<?php echo $composicao['nome_receita'] ?>', <?php echo $composicao['idIngrediente']; ?>, '<?php echo $composicao['nome'] ?>',<?php echo $composicao['idMedida']; ?>, '<?php echo $composicao['descricao'] ?>',<?php echo $composicao['qtd_medida']; ?>)" href="#" id="btn-salvar-composicao" data-id="<?php echo $composicao['nome_receita']; ?>" data-idI="<?php echo $composicao['idIngrediente']; ?>" data-idM="<?php echo $composicao['idMedida']; ?>">
                                                        <span class="material-symbols-outlined"> edit </span>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                                <!-- <button>Salvar e Sair</button> -->

                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </section>
    </div>
    </div>

    <script>
        setTimeout(function() {
            var mensagemDiv = document.getElementById('mensagemFoto');
            mensagemDiv.style.display = 'none';
        }, 4000);
        setTimeout(function() {
            var mensagemDiv = document.getElementById('mensagemR');
            mensagemDiv.style.display = 'none';
        }, 4000);
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="../../js/customReceita.js"></script>
    <script src="../../js/customReceita2.js"></script>
    <script src="../../js/customComposicaoReceita.js"></script>

    <!-- BOOSTRAP JAVASCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>