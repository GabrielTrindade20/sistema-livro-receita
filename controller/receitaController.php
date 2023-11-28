<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once(__DIR__ . '../../configuration/connect.php');
include_once(__DIR__ . '../../model/receitaModel.php');
include_once(__DIR__ . '../../model/fotoModel.php');
include_once(__DIR__ . '../../model/composicaoModel.php');

if (!isset($_SESSION['controlar_abas'])) {
    $_SESSION['controlar_abas'] = 0;
}

$fotoModel = new fotoModel($link);
$ultima_foto = $foto_recuperada = $fotoModel->recuperaFoto();

$receitaModel = new receitaModel($link);
$composicaoModel = new composicaoModel($link);

// SALVAR Receita
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["salvar"])) {
    $id_foto_receita =  $ultima_foto['id_foto_receita'];
    $path_foto_receita =  $ultima_foto['path'];

    $nome = $_POST["nome"];
    $data_criacao = $_POST["data_criacao"];
    $modo_preparo = $_POST["modo_preparo"];
    $qtd_porcao = $_POST["qtd_porcao"];
    $degustador = $_POST["idFuncionario"];
    $data_degustacao = $_POST["data_degustacao"];
    $nota_degustacao = $_POST["nota_degustacao"];
    $ind_inedita = $_POST["ind_inedita"]; // S-sim   N-nao
    $id_cozinheiro  = $_POST["idFuncionario"];
    $id_categoria  = $_POST["idCategoria"];

    if (
        isset($nome) && isset($data_criacao) && isset($modo_preparo) && isset($qtd_porcao) && isset($ind_inedita)
        && isset($id_cozinheiro) && isset($id_categoria) && isset($id_foto_receita) && isset($path_foto_receita)
    ) {
        // inserir os dados no banco de dados 
        if ($receitaModel->create(
            $nome,
            $data_criacao,
            $modo_preparo,
            $qtd_porcao,
            $degustador,
            $data_degustacao,
            $nota_degustacao,
            $ind_inedita,
            $id_cozinheiro,
            $id_categoria,
            $id_foto_receita,
            $path_foto_receita
        )) {
            $_SESSION["sucesso"] = ["Receita Salva."];
            // passar dados pra session 
            $_SESSION["nome_receita"] = $nome;
            $_SESSION["data_criacao"] = $data_criacao;
            $_SESSION["modo_preparo"] = $modo_preparo;
            $_SESSION["qtd_porcao"] = $qtd_porcao;
            $_SESSION["degustador"] = $degustador;
            $_SESSION["data_degustacao"] = $data_degustacao;
            $_SESSION["nota_degustacao"] = $nota_degustacao;
            $_SESSION["ind_inedita"] = $ind_inedita; // S-sim   N-nao
            $_SESSION["id_cozinheiro"] = $id_cozinheiro;
            $_SESSION["id_categoria"] = $id_categoria;
            $_SESSION['controlar_abas'] = 2;
        } else {
            $_SESSION["erros"] = ["Erro ao salvar. Tente novamente!"];
        }
    } else {
        $_SESSION["erros"] = ["Preenchar todos os campos."];
    }
    // Redirecionar
    header("Location: ../view/pages/Receitas/pageReceitaCadastro.php");
    exit();

    mysqli_close($link);
}
// EXCLUIR
if (isset($_GET['acao']) && $_GET['acao'] === 'delete') {
    if (isset($_GET['nome_receita'])) {
        $nome_receita = $_GET['nome_receita'];

        if ($receitaModel->delete($nome_receita)) {
            $_SESSION["sucesso"] = ["Receita deleta."];
        } else {
            $_SESSION["erros"] = ["Erro ao excluir no banco de dados."];
        }
    } else {
        $_SESSION["erros"] = ["Reecita não especificado."];
    }

    header("Location: ../view/pages/pageReceitas.php");
    exit();
} 

$dados_receitas = $receitaModel->read();
$countReceitas = count($dados_receitas);
