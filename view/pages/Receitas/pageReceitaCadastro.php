<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once('../../../controller/protectSubFolders.php');
include_once('../../../configuration/connect.php');
include_once('../../../controller/receitaController.php');
include_once('../../../model/fotoModel.php');
include_once('../../../model/funcoes.php');

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
                $_SESSION["cadastro_sucesso"] = true;
                $_SESSION["mensagem"] = "Arquivo salvo!";
            } else {
                $_SESSION["mensagem"] = "Erro ao enviar.";
                $_SESSION["cadastro_sucesso"] = false;
            }
        }
    }
}


$ultima_foto = $foto_recuperada = $fotoModel->recuperaFoto();

if (isset($ultima_foto)) {
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
    <!-- Menu lateral - vem de outra página -->
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
                <a href="#" class="pagina-atual"> Receitas Cadastro</a>
            </div>
            <section>
                <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Foto</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Dados</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Ingredientes</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        <div class="conteiner-abas">
                            <div class="foto"><!-- Foto -->
                                <?php
                                if (isset($_SESSION["mensagem"])) {
                                    echo $_SESSION["mensagem"];
                                    unset($_SESSION["mensagem"]);
                                }
                                ?>
                            </div>
                            <div class="box-foto">
                                <?php
                                if (isset($ultima_foto) && isset($_SESSION["cadastro_sucesso"]) &&  $_SESSION["cadastro_sucesso"]) {
                                    echo $img_ultima;
                                    unset($_SESSION["cadastro_sucesso"]);
                                }
                                ?>
                            </div>

                            <form enctype="multipart/form-data" action="" method="post">
                                <div class="box-foto">
                                    <label for="foto_receita">Foto da Receita</label>
                                    <input type="file" accept="image/*" name="foto_receita"> <br>
                                    <button type="submit" id="file" name="upload" class="button">Salvar</button>
                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                        <div class="conteiner-abas">
                            <section>
                                <!-- Notificação de erro ou não -->
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


                                <form method="POST" action="../../../controller/receitaController.php">
                                    <div class="conteiner-form-colum-operacoes">
                                        <button type="submit" name="salvar" class="button">Salvar</button>
                                    </div>
                                    <div class="form">
                                        <div class="conteiner-form-colum">
                                            <label for="nome">Nome</label>
                                            <input type="text" id="nome" name="nome" required>

                                            <label for="data_criacao">Data de Criação</label>
                                            <input type="date" id="data_criacao" name="data_criacao" required>

                                            <label for="qtd_porcao">Quantidade de Porções</label>
                                            <input type="number" id="qtd_porcao" name="qtd_porcao" required>

                                            <div class="conteiner-dados-input-select">
                                                <label for="degustador">Degustador</label>
                                                <?php monta_select_degustador(); ?>
                                            </div>
                                            <label for="nota_degustacao">Nota</label>
                                            <input type="number" id="nota_degustacao" name="nota_degustacao">

                                            <label for="data_degustacao">Data de Degustação</label>
                                            <input type="date" id="data_degustacao" name="data_degustacao">
                                        </div>
                                        <div class="conteiner-form-colum">
                                            <div class="conteiner-dados-input-select">
                                                <label for="ind_inedita">Inédita</label> <br>
                                                <input type="radio" id="sim" name="ind_inedita" value="S">
                                                <label for="sim">Sim</label>
                                                <input type="radio" id="nao" name="ind_inedita" value="N">
                                                <label for="nao">Não</label> <br>

                                                <label for="cozinheiro">Cozinheiro</label>
                                                <?php monta_select_cozinheiro(); ?>

                                                <label for="categoria">Categoria</label>
                                                <?php monta_select_categoria(); ?>
                                            </div>

                                        </div>

                                        <div class="conteiner-form-colum mb-3">
                                            <h3 class="titulo" class="form-label">Modo de Preparo</h3>
                                            <textarea name="modo_preparo" id="" rows="10" cols="40" maxlength="4000"></textarea>
                                        </div>
                                    </div>

                                </form>
                            </section>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                        <div class="conteiner-abas">
                            <!-- Cadastro medida ingrediente -->
                            
                                <!-- Notificação de erro ou não -->
                                <div class="mensagens">
                                    <?php
                                    if (isset($_SESSION["errosC"])) {
                                        $erros = $_SESSION["errosC"];
                                        foreach ($erros as $erro) {
                                            echo $erro . "<br>";
                                        }
                                        unset($_SESSION["errosC"]);
                                    } elseif (isset($_SESSION["sucessoC"])) {
                                        $sucessos = $_SESSION["sucessoC"];
                                        foreach ($sucessos as $sucesso) {
                                            echo $sucesso . "<br>";
                                        }
                                        unset($_SESSION["sucesso"]);
                                    }
                                    ?>
                                </div>

                                <div>
                                    <form action="../../../controller/composicaoController.php" method="post">
                                        <label for="ingrediente">Ingrediente</label>

                                        <input type="text" id="ingrediente" name="ingrediente" placeholder="Pesquisar Ingrediente" onkeyup="carregarIngrediente(this.value)" autocomplete="off">

                                        <span id="resultado-pesquisa-ingrediente"></span>

                                        <label for="medida">Medida</label>
                                        <input type="text" id="medida" name="medida" placeholder="Pesquisar Medida" onkeyup="carregarMedida(this.value)" autocomplete="off">

                                        <span id="resultado-pesquisa-medida"></span>

                                        <label for="quantidade">Quantidade</label>
                                        <input type="number" name="quantidade">

                                        <input type="hidden" name="idIngrediente" id="idIngrediente">
                                        <input type="hidden" name="idMedida" id="idMedida">

                                        <button type="submit" name="salvar_composicao">Salvar</button>
                                    </form>

                                    <div class="box-link-i-m"> <a href="pageReceitaIngreMedida.php">Lista de Ingredientes e Medidas salvas</a></div>

                                    <div class="table-lista">
                                        <h3>Lista de Ingredientes</h3>
                                        <table class="table" id="table" border="1" align="right">
                                            <thead>
                                                <tr>
                                                    <th class="select-column">-</th>
                                                    <th>Medida</th>
                                                    <th>Ingrediente</th>
                                                    <th class="operacao" colspan="2">OPERAÇÕES</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Gerando de acordo com o que foi cadastrado -->
                                            </tbody>
                                        </table>

                                        <button id="salvar-todos" name="salvar_medidas" onclick="passarReferenciaParaPHP()">Salvar Todos</button>
                                        <br>
                                    </div>

                                </div>
                            
                        </div>

                    </div>
                </div>
            </section>
        </div>


        <script src="../../js/customReceita.js"></script>
        <script src="../../js/customReceita2.js"></script>

        <!-- BOOSTRAP JAVASCRIPT -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>