<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once('../../../controller/protectSubFolders.php');
include_once('../../../configuration/connect.php');
include_once('../../../controller/receitaController.php');
include_once('../../../controller/receitaComposicaoController.php');
include_once('../../../model/fotoModel.php');
include_once('../../../model/receitaModel.php');
include_once('../../../model/composicaoModel.php');
include_once('../../../model/funcoes.php');

if (!isset($_SESSION['controlar_abas'])) {
    $_SESSION['controlar_abas'] = 0;
}

if (isset($_GET['nome_receita'])) {
    $nome_receita = $_GET['nome_receita'];
    $receitaModel = new receitaModel($link);
    $recuperar = $receitaModel->recuperaReceita($nome_receita);

    $composicaoModel = new composicaoModel($link);
    $recuperar_composicao = $composicaoModel->recuperaReceitaComposicao($nome_receita);


    if ($recuperar) {
        $nome_receita = $recuperar["nome_receita"];
        $data_criacao = $recuperar["data_criacao"];
        $modo_preparo = $recuperar["modo_preparo"];
        $qtd_porcao = $recuperar["qtd_porcao"];
        $degustador = $recuperar["degustador"];
        $data_degustacao = $recuperar["data_degustacao"];
        $nota_degustacao = $recuperar["nota_degustacao"];
        $ind_inedita = $recuperar["ind_inedita"];
        $id_cozinheiro = $recuperar["id_cozinheiro"];
        $id_categoria = $recuperar["id_categoria"];
        $id_foto_receita = $recuperar["id_foto_receita"];
        $path_foto_receita = $recuperar["path_foto_receita"];
    } else {
        header("Location: pageReceita.php?mensagem=" . urlencode("Receita não encontrado."));
        exit();
    }


    if (isset($id_foto_receita) && isset($path_foto_receita)) {
        $id_foto_receita =  $id_foto_receita;
        $img_receita = "<img src=" . $path_foto_receita . " >";
    }
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
                $_SESSION["mensagem"] = "Arquivo salvo!";
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

    <title>Receita Edição</title>
</head>

<body>
    <!-- Menu lateral -->
    <?php include '../../components/menuSub1.php';
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
                <a href="#" class="pagina-atual"> Receitas Edição</a>
            </div>
            <section>

                <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active <?php if ($_SESSION['controlar_abas'] == 0) echo "active"; ?>" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">1 Foto</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?php if ($_SESSION['controlar_abas'] == 1) echo "active"; ?>" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">2 Dados</button>

                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?php if ($_SESSION['controlar_abas'] == 2) echo "active"; ?>" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">3 Ingredientes</button>
                    </li>
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
                    <!-- foto form -->
                    <div class="tab-pane show <?php if ($_SESSION['controlar_abas'] == 0) {
                                                echo 'active';
                                            }?>" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        <!-- foto -->
                        <div class="conteiner-abas">
                            <div class="box-foto">
                                <?php
                                // if (isset($ultima_foto) && isset($_SESSION["cadastro_sucesso"]) &&  $_SESSION["cadastro_sucesso"]) {

                                echo $img_receita;
                                // }
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

                    <!-- receita form -->
                    <div class="tab-pane <?php if ($_SESSION['controlar_abas'] == 1) {
                                                echo 'active';
                                            }?>" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                        <!-- receita -->
                        <div class="conteiner-abas">
                            <section>
                                <form method="POST" action="../../../controller/receitaController.php">
                                    <div class="conteiner-form-colum-operacoes">
                                        <button type="submit" name="salvar" class="button">Salvar</button>
                                    </div>
                                    <div class="form">
                                        <div class="conteiner-form-colum">
                                            <label for="nome">Nome</label>
                                            <input type="text" id="nome" name="nome" value="<?php echo isset($nome_receita) ? $nome_receita : ''; ?>" required>

                                            <label for="data_criacao">Data de Criação</label>
                                            <input type="date" id="data_criacao" name="data_criacao" value="<?php echo isset($data_criacao) ? $data_criacao : ''; ?>" required>

                                            <label for="qtd_porcao">Quantidade de Porções</label>
                                            <input type="number" id="qtd_porcao" name="qtd_porcao" value="<?php echo isset($qtd_porcao) ? $qtd_porcao : ''; ?>" required>

                                            <div class="conteiner-dados-input-select">
                                                <label for="degustador">Degustador</label>
                                                <?php monta_select_degustador(isset($degustador) ? $degustador : '');  ?>
                                            </div>
                                            <label for="nota_degustacao">Nota</label>
                                            <input type="number" id="nota_degustacao" name="nota_degustacao" value="<?php echo isset($nota_degustacao) ? $nota_degustacao : ''; ?>">

                                            <label for="data_degustacao">Data de Degustação</label>
                                            <input type="date" id="data_degustacao" name="data_degustacao" value="<?php echo isset($data_degustacao) ? $data_degustacao : ''; ?>">
                                        </div>
                                        <div class="conteiner-form-colum">
                                            <div class="conteiner-dados-input-select">
                                                <label for="ind_inedita">Inédita</label> <br>
                                                <input type="radio" id="sim" name="ind_inedita" value="S" <?php echo (isset($ind_inedita) && $ind_inedita == 'S') ? 'checked' : ''; ?>>
                                                <label for="sim">Sim</label>
                                                <input type="radio" id="nao" name="ind_inedita" value="N" <?php echo (isset($ind_inedita) && $ind_inedita == 'N') ? 'checked' : ''; ?>>
                                                <label for="nao">Não</label> <br>

                                                <label for="cozinheiro">Cozinheiro</label>
                                                <?php monta_select_cozinheiro(isset($id_cozinheiro) ? $id_cozinheiro : ''); ?>

                                                <label for="categoria">Categoria</label>
                                                <?php monta_select_categoria(isset($id_categoria) ? $id_categoria : ''); ?>
                                            </div>

                                        </div>

                                        <div class="conteiner-form-colum mb-3">
                                            <h3 class="titulo" class="form-label">Modo de Preparo</h3>
                                            <textarea name="modo_preparo" id="" rows="10" cols="40" maxlength="4000"><?php echo isset($modo_preparo) ? $modo_preparo : ''; ?></textarea>
                                        </div>
                                    </div>

                                </form>
                            </section>
                        </div>
                    </div>

                    <!-- composição -->
                    <div class="tab-pane <?php if ($_SESSION['controlar_abas'] == 2) {
                                                echo 'active';
                                            }?>" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                        <!-- Cadastro medida ingrediente -->
                        <div class="conteiner-abas">

                            <div>
                                <form action="../../../controller/receitaComposicaoControllerEdicao.php" method="post">
                                    <input type="hidden" name="acao" id="acao" value="salvar">
                                    <input type="hidden" name="nome_receita" id="nome_receita" value="<?php echo isset($nome_receita) ? $nome_receita : ''; ?>">
                                    <input type="hidden" name="idIngrediente" id="idIngrediente" value="">
                                    <input type="hidden" name="idMedida" id="idMedida" value="">

                                    <label for="ingrediente">Ingrediente</label>

                                    <input type="text" id="ingrediente" name="ingrediente" placeholder="Pesquisar Ingrediente" onkeyup="carregarIngrediente(this.value)" autocomplete="off">

                                    <span id="resultado-pesquisa-ingrediente"></span>

                                    <label for="medida">Medida</label>
                                    <input type="text" id="medida" name="medida" placeholder="Pesquisar Medida" onkeyup="carregarMedida(this.value)" autocomplete="off">

                                    <span id="resultado-pesquisa-medida"></span>

                                    <label for="quantidade">Quantidade</label>
                                    <input type="number" name="quantidade" id="quantidade">

                                    <button type="submit" name="salvar_composicao">Adicionar</button>
                                </form>

                                <div class="box-link-i-m"> <a href="pageReceitaIngreMedida.php">Lista de Ingredientes e Medidas salvas</a></div>

                                <div class="table-lista">
                                    <h3>Lista de Ingredientes</h3>
                                    <table class="table" id="table">
                                        <thead>
                                            <tr>
                                                <th class="select-column"></th>
                                                <th>Ingredientes</th>
                                                <th>Medidas</th>
                                                <th>Quantidade</th>
                                                <th class="operacao">OPERAÇÕES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Gerando de acordo com o que foi cadastrado -->
                                            <?php foreach ($recuperar_composicao as $index => $composicao) : ?>
                                                <tr>
                                                    <td></td>
                                                    <td> <?php echo $composicao['nome']; ?> </td>
                                                    <td> <?php echo $composicao['descricao']; ?> </td>
                                                    <td> <?php echo $composicao['qtd_medida']; ?> </td>
                                                    <td>
                                                        <a onclick="excluirComposicao(this, '<?php echo $composicao['nome_receita']; ?>', <?php echo $composicao['idIngrediente']; ?>, <?php echo $composicao['idMedida']; ?>)" href="#">
                                                            Remover
                                                        </a>

                                                        <a onclick="editarComposicao('<?php echo $composicao['nome_receita'] ?>', <?php echo $composicao['idIngrediente']; ?>, '<?php echo $composicao['nome'] ?>',<?php echo $composicao['idMedida']; ?>, '<?php echo $composicao['descricao'] ?>',<?php echo $composicao['qtd_medida']; ?>)" href="#" id="btn-salvar-composicao" data-id="<?php echo $composicao['nome_receita']; ?>" data-idI="<?php echo $composicao['idIngrediente']; ?>" data-idM="<?php echo $composicao['idMedida']; ?>">
                                                            Editar
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>

                                    <button>Salvar e Sair</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

        <script src="../../js/customReceita.js"></script>
        <script src="../../js/customReceita2.js"></script>
        <script src="../../js/customComposicaoReceitaAlteracao.js"></script>

        <!-- BOOSTRAP JAVASCRIPT -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>