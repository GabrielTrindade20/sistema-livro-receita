<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once(__DIR__ . '../../configuration/connect.php');
include_once(__DIR__ . '../../model/composicaoModel.php');

$composicaoModel = new composicaoModel($link);


// DELETE composicao
if (isset($_GET['acao']) && $_GET['acao'] == 'delete') {
    $nome_receita = $_GET["nome_receita"];
    $idMedida = $_GET["idMedida"];
    $idIngrediente = $_GET["idIngrediente"];

    $composicaoModel->delete($nome_receita, $idIngrediente, $idMedida);
    echo "exclusao";
}

// UPDATE COMPOSIÇÂO
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["acao"])) 
{
    $nome_receita = $_POST["nome_receita"];
    $idIngrediente = $_POST["idIngrediente"];
    $idMedida = $_POST["idMedida"];
    $quantidade = $_POST["quantidade"];
    
    $acao = $_POST["acao"];

    var_dump($acao, $nome_receita, $idIngrediente, $idMedida, $quantidade) ;

    if ($acao === "atualizar") {
        if (!empty($nome_receita)) {
            if ($composicaoModel->update($nome_receita, $idIngrediente, $idMedida, $quantidade)) {
                // Redirecione para a página desejada após a atualização
                header("Location: ../view/pages/Receitas/pageReceitaCadastro.php");
                exit(); // encerrar o script após o redirecionamento
                echo "Atualizado com sucesso";
            } else {
                echo "Erro na atualização";
            }
        }
    } 
    elseif ($acao === "salvar") {
        if (isset($idIngrediente) && isset($idMedida) && isset($quantidade) && isset($nome_receita)) {
            if ($composicaoModel->create($nome_receita, $idIngrediente, $idMedida, $quantidade)) {
                $_SESSION["sucesso"] =  ["Ingredientes salvos."];
                header("Location: ../view/pages/Receitas/pageReceitaCadastro.php");
                exit();
            } else {
                $_SESSION["erros"] = ["Erro ao salvar. Tente novamente!"];
            }
        } else {
            $_SESSION["erros"] = ["Preenchar todos os campos!"];
        }
        header("Location: ../view/pages/Receitas/pageReceitaCadastro.php");
        exit();
    } else {
        echo  "erro acao ===  ";
    }
}

//ler dados de composição
if ($_SESSION['controlar_abas'] == 2 ) {
    $nome_receita =  $_SESSION["nome_receita"];
    $dados_composicao = $composicaoModel->read($nome_receita);
}
//ler dados de composição
if (isset($_GET["nome_receita"]) && $_SESSION['controlar_abas'] == 2 ) {
    $nome_receita =  $_GET["nome_receita"];
    $dados_composicao = $composicaoModel->read($nome_receita);
}
