<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once(__DIR__ . '../../configuration/connect.php');
include_once(__DIR__ . '../../model/composicaoModel.php');

if (!isset($_SESSION['controlar_abas'])) {
    $_SESSION['controlar_abas'] = 0;
}

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
                header("Location: ../view/pages/Receitas/pageReceitaAlteracao.php?nome_receita=$nome_receita");
                exit(); // encerrar o script após o redirecionamento
                $_SESSION["sucesso"] =  "Atualizado com sucesso";
                $_SESSION['controlar_abas'] = 2;
            } else {
                $_SESSION["erros"] = ["Preenchar todos os campos!"];
            }
        }
    } 
    elseif ($acao === "salvar") {
        if (isset($idIngrediente) && isset($idMedida) && isset($quantidade) && isset($nome_receita)) {
            if ($composicaoModel->create($nome_receita, $idIngrediente, $idMedida, $quantidade)) {
                $_SESSION["sucesso"] =  ["Ingredientes salvos."];
                $_SESSION['controlar_abas'] = 2;
                header("Location: ../view/pages/Receitas/pageReceitaAlteracao.php?nome_receita=$nome_receita");
                exit();
            } else {
                $_SESSION["erros"] = ["Erro ao salvar. Tente novamente!"];
            }
        } else {
            $_SESSION["erros"] = ["Preenchar todos os campos!"];
        }
        header("Location: ../view/pages/Receitas/pageReceitaAlteracao.php?nome_receita=$nome_receita");
        exit();
    } else {
        echo  "erro acao ===  ";
    }
}

