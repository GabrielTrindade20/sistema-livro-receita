<?php
include_once(__DIR__ . '../../configuration/connect.php');
include_once(__DIR__ . '../../model/ingredienteModel.php');
include_once(__DIR__ . '../../model/medidaModel.php');

$ingredienteModel = new ingredienteModel($link);
$medidaModel = new medidaModel($link);

$pesquisar_ingrediente = filter_input(INPUT_GET, "ingrediente", FILTER_DEFAULT);

if(!empty($pesquisar_ingrediente)) {
    $resultado_ingredientes = $ingredienteModel->pesquisar_ingrediente($pesquisar_ingrediente);

    if($resultado_ingredientes !== false && !empty($resultado_ingredientes)) {
        $dados_ingredientes = $resultado_ingredientes; 
        $retorna_ingrediente = ['status' => true, 'dados' => $dados_ingredientes];
    } else {
        $retorna_ingrediente = ['status' => false, 'msg' => "Erro: nenhum ingrediente encontrado!"];
    }
}else {
    $retorna_ingrediente = ['status' => false, 'msg' => "Erro: nenhum ingrediente encontrado!"];
}

echo json_encode($retorna_ingrediente);


//var_dump($pesquisar_ingrediente);


// // SALVAR pageCadastro
// if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["salvar_composicao"])) {
//     $idIngrediente = $_POST["idIngrediente"];
//     $idMedida = $_POST["idMedida"];
//     $novoIngrediente = $_POST["novoIngrediente"];
//     $novoMedida = $_POST["novoMedida"];
//     $quantidade = $_POST["quantidade"];

//     if (!empty($idIngrediente) || !empty($idMedida) && !empty($quantidade)) {

//     }
//     elseif (!empty($novoIngrediente) || !empty($novoMedida) && !empty($quantidade)) {
//         $ingredienteModel->verificarExisteBanco($novoIngrediente);
//         $medidaModel->verificarExisteBanco($novoMedida);

//         if (!empty($ingredienteModel->verificaSim) || !empty($medidaModel->verificaSim)) {
//             $_SESSION["errosC"] = ["O registro já existe."];
//             header("Location: ../view/pages/Receitas/pageReceitaCadastro.php");
//             exit();
//         } else {
//             if (!empty($novoMedida) && !empty($quantidade)) {
//                 if ($ingredienteModel->create($novoIngrediente, NULL) && $medidaModel->create($novoMedida)) {
//                     // Redirecione para a página desejada
//                     header("Location: ../view/pages/Receitas/pageReceitaCadastro.php");
//                     exit();
//                     $_SESSION["sucessoC"] =  ["Salvo com sucesso."];
//                 } else {
//                     $_SESSION["errosC"] = ["Erro ao salvar no banco de dados."];
//                 }
//             }
//         }
//     }
// else {
//         $_SESSION["errosC"] = ["Preenchar todos os campos."];
//         header("Location: ../view/pages/Receitas/pageReceitaCadastro.php");
//         exit();
//     }
// }

// RETORNAR DADOS SALVOS
// $referencias = $referenciaModel->leitura();

// $count_referencias = count($referencias);
?>