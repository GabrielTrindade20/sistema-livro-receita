<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once(__DIR__ . '../../configuration/connect.php');
include_once(__DIR__ . '../../model/receitaModel.php');
include_once(__DIR__ . '../../model/fotoModel.php');

$fotoModel = new fotoModel($link);
$ultima_foto = $foto_recuperada = $fotoModel->recuperaFoto();

$receitaModel = new receitaModel($link);

// SALVAR 
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["salvar"])) {
    if (isset($ultima_foto) && isset($_SESSION['upload_form_foto'])) {
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
            isset($nome) && isset($data_criacao) && isset($modo_preparo) && isset($qtd_porcao)
            && isset($degustador) && isset($data_degustacao) && isset($nota_degustacao) && isset($ind_inedita)
            && isset($id_cozinheiro) && isset($id_categoria) && isset($path_foto_receita)
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
                $_SESSION["sucesso"] = ["Receita Salva"];
            } else {
                $_SESSION["erros"] = ["Erro ao salvar. Tente novamente!"];
            }
        } else {
            $_SESSION["erros"] = ["Preenchar todos os campos."];
        }
    } else {
        $_SESSION["erros"] = ["Escolhar uma imagem antes."];
    }


    // Redirecionar
    header("Location: ../view/pages/Receitas/pageReceitaCadastro.php");
    exit();


    mysqli_close($link);
}
