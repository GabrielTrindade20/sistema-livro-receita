<?php
include_once('../../../controller/protectSubFolders.php');
include_once('../../../controller/funcionarioController.php');
include_once('../../../controller/restauranteController.php');
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

    <link rel="stylesheet" href="../../css/styleAllConteinerPages.css">
    <link rel="stylesheet" href="../../css/styleReferencia.css">
    <link rel="icon" href="../../css/iconsSVG/iconReceita.svg">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Restaurante Cadastro</title>
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
                <a href="../pageRestaurante.php"> Referência </a> >
                <a href="#" class="pagina-atual"> Referência Cadastro</a>
            </div>
            <section>
                <div class="titulo">
                    <h1>Referência</h1>
                </div>

                <div class="conteiner-abas ">
                    <!-- Notificação de erro ou não -->
                    <div class="mensagens">
                        <?php
                        if (isset($_SESSION["erros"])) {
                            $erro = $_SESSION["erros"];
                            echo  $erro;

                            unset($_SESSION["erros"]);
                        } elseif (isset($_SESSION["sucesso"])) {
                            $sucesso = $_SESSION["sucesso"];
                            echo $sucesso;

                            unset($_SESSION["sucesso"]);
                        }
                        ?>
                    </div>

                    <div class="nova">
                    <a href="cadastrarRestaurante.php">Cadastrar Restaurante</a>

                    </div>

                    <form method="POST" action="../../../controller/referenciaController.php">
                        <input type="hidden" name="acao" id="acao" value="salvar">
                        <input type="hidden" name="idFuncionario" id="idFuncionario" value="">
                        <input type="hidden" name="idRestaurante" id="idRestaurante" value="">
                        <div class="conteiner-dados ">
                            <div class="row mb-3 ">
                                <div class="col-12">
                                    <label for="nome" class="form-label">Funcionário</label>
                                    <input type="text" class="form-control" name="nome" id="nome" placeholder="Pesquisar Funcionário" onkeyup="carregarFuncionario(this.value)" autocomplete="off">
                                    <span id="resultado-pesquisa-funcionario"></span>
                                </div>
                                <div class="col-12">
                                    <label for="Restaurante" class="form-label">Restaurante</label>
                                    <input type="text" class="form-control" name="restaurante" id="restaurante" placeholder="Pesquisar Restaurante" onkeyup="carregarRestaurante(this.value)" autocomplete="off">
                                    <span id="resultado-pesquisa-restaurante"></span>

                                </div>
                                <div class="col-12">
                                    <label for="data_inicio" class="form-label">Data Inicio</label>
                                    <input type="date" class="form-control" name="data_inicio" id="data_inicio" require>
                                </div>
                                <div class="col-12">
                                    <label for="data_fim" class="form-label">Data Fim</label>
                                    <input type="date" class="form-control" name="data_fim" id="data_fim" require>
                                </div>
                            </div>
                        </div>
                        <div class="conteiner-operacoes">
                            <button type="submit" class="button" name="salvar_referencia" value="salvar_referencia" id="btn-salvar-referencia">Salvar</button>
                            <a href="../pageRestaurante.php">Cancelar</a>

                        </div>
                    </form>
                    
                </div>
            </section>
        </div>
    </div>

    <script src="../../js/referenciaFuncionario.js"></script>
    <script src="../../js/referenciaRestaurante.js"></script>
    <!-- BOOSTRAP JAVASCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>