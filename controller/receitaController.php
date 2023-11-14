<?php
if(!isset($_SESSION)) {
    session_start();
}

include_once(__DIR__ .'../../configuration/connect.php');
include_once(__DIR__ .'../../model/funcionarioModel.php');
include_once(__DIR__ .'../../model/receitaModel.php');

$funcionarioModel = new funcionarioModel($link);
$receitaModel = new receitaModel($link);

// SALVAR 
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["salvar"])) 
{
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
    $id_foto_receita = $_POST["foto_receita"];

    var_dump( $nome,
    $data_criacao,
    $modo_preparo,
    $qtd_porcao,
    $degustador,
    $data_degustacao,
    $nota_degustacao,
    $ind_inedita,
    $id_cozinheiro,
    $id_categoria,
    $id_foto_receita);
    // Depois de inserir os dados no banco de dados com sucesso
    if ($receitaModel->create( $nome,
                                    $data_criacao,
                                    $modo_preparo,
                                    $qtd_porcao,
                                    $degustador,
                                    $data_degustacao,
                                    $nota_degustacao,
                                    $ind_inedita,
                                    $id_cozinheiro,
                                    $id_categoria,
                                    $id_foto_receita )) 
    {
        $_SESSION["sucesso"] = $funcionarioModel->getSucesso();
    } else {
        $_SESSION["erros"] = ["Erro ao salvar no banco de dados."];
    }

    // Redirecionar
    header("Location: ../view/pages/Receitas/pageReceitaCadastro.php");
    exit();
    
    
    mysqli_close($link);
}





?>