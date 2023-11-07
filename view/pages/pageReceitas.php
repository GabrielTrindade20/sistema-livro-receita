<?php
include_once('../../controller/protect.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/stylePesq.css">
    <link rel="stylesheet" href="../css/styleTable.css">
    <link rel="icon" href="../css/iconsSVG/iconReceita.svg">
    <link rel="stylesheet" href="../css/styleResponsivo.css">
    <link rel="icon" href="../css/iconsSVG/iconReceita.svg">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Página de Receitas</title>
</head>

<body>
    <!-- Menu lateral - vem de outra página -->
    <?php require_once('../components/menu.php'); ?>


    <div id="sub-titulo">
        <a href="">links paginas</a>
    </div>

    <section class="conteiner-pesquisa">

        <div class="titulos" id="titulo">
            <div class="conteiner-titulo">
                <div>
                    <h1>Lista de Receitas</h1>
                </div>

                <div class="info-receitas">
                    <a href="">(10) Receitas</a>
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
                    <a href="./Receitas/receitaCadastro.php">
                        <button class="nova-receita-button">Nova Receita</button>
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
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Cozinheiro</th>
                    <th>Data de Criação</th>
                    <th class="operacao-col" colspan="2">Operações</th>
                </tr>
            </thead>
            <tbody>
                <!-- Exemplo de uma linha de dados -->
                <tr>
                    <td class="select-column">
                        <a href=""><input type="checkbox"></a>
                    </td>
                    <td>Nome do Prato</td>
                    <td>Categoria A</td>
                    <td>Nome do Cozinheiro</td>
                    <td>01/09/2023</td>
                    <td colspan="2">
                        <a href="../../model/modelCargo/cargoEdicao.php?idCargo=<?php echo $cargo['idCargo']; ?>">
                            <span class="material-symbols-outlined"> edit </span>
                        </a>

                        <a href="#" onclick="confirmarExclusao(<?php echo $cargo['idCargo']; ?>);" class="button">
                            <span class="material-symbols-outlined"> delete </span>
                        </a>
                    </td>
                </tr>
                <!-- Adicione mais linhas de dados conforme necessário -->
            </tbody>
        </table>
    </section>

</body>

</html>