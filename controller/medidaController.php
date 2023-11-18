<?php
if(!isset($_SESSION)) {
    session_start();
}

include_once(__DIR__ .'../../configuration/connect.php');
include_once(__DIR__ .'../../model/medidaModel.php');

$medidaModel = new medidaModel($link);

// SALVAR MEDIDA
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["acaoM"])) 
{
    $idMedida = $_POST["idMedida"];
    $medida = $_POST["medida"];
    
    $acao = $_POST["acaoM"];

    if ($acao === "atualizarM") {
        if (!empty($idMedida)) {
            if ($medidaModel->update($idMedida, $medida)) {
                // Redirecione para a página desejada após a atualização
                header("Location: ../view/pages/Receitas/pageReceitaIngreMedida.php");
                exit(); // encerrar o script após o redirecionamento
            } else {
                echo "Erro na atualização";
            }
        }
    } elseif ($acao === "salvarM") {
        // Salve os dados no banco de dados
        if ($medidaModel->create($medida)) {
            // Redirecione para a página desejada
            header("Location: ../view/pages/Receitas/pageReceitaIngreMedida.php");
            exit(); 

        } else {
            echo " erro";
        }
    } else {
        echo  "erro";
    }
}


// DELETE
if (isset($_GET['acao']) && $_GET['acao'] == 'deleteM') {
    $idMedida = $_GET["idMedida"];

    $medidaModel->delete($idMedida);
}


// READ
$dados_medidas = $medidaModel->read();

// pesquisar medida na receita
$pesquisar_medida = filter_input(INPUT_GET, "medida", FILTER_DEFAULT);

if(!empty($pesquisar_medida)) {
    $resultado_medida = $medidaModel->pesquisar_medida($pesquisar_medida);

    if($resultado_medida !== false && !empty($resultado_medida)) {
        $dados_medida = $resultado_medida; 
        $retorna_medida = ['statusM' => true, 'dadosM' => $dados_medida];
    } else {
        $retorna_medida = ['statusM' => false, 'msgM' => "Erro: nenhuma medida encontrado!"];
    }
}else {
    $retorna_medida = ['statusM' => false, 'msgM' => "Erro: nenhuma medida encontrado!"];
}

echo json_encode($retorna_medida);

?>