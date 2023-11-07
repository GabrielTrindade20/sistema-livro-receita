<?php
if(!isset($_SESSION)) {
    session_start();
}

include_once(__DIR__ .'../../configuration/connect.php');
include_once(__DIR__ .'../../model/referenciaModel.php');

$referenciaModel = new referenciaModel($link);

// SALVAR 
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["salvar_restaurante"])) 
{   
    $idRestaurante = $_POST['idRestaurante'];
    $data_inicio = $_POST['data_inicio'];
    $data_fim = $_POST['data_fim'];

    // Chame a função para obter o próximo ID do funcionário
    $idFuncionario = $referenciaModel->pegarUltimoIdFuncionario();

    if ($idFuncionario !== false) 
    {
        if(empty($ $idFuncionario) && empty($idRestaurante) && empty($data_inicio) && empty($data_fim)) {
            $referenciaModel->validar_campos($data_inicio, $data_fim);
        }
        else {
            if (!empty($referenciaModel->getErros())) {
                // Há erros, armazene-os na sessão
                $_SESSION["erros"] = $referenciaModel->getErros();
                header("Location: ../view/pages/Funcionario/pageFuncionarioCadastro.php");
                exit();
            } else {
                // Não há erros, salve no banco de dados
                if ($referenciaModel->create( $idFuncionario, $idRestaurante, $data_inicio, $data_fim )) {
                    $_SESSION["sucesso"] = $referenciaModel->getSucesso();
                } else {
                    $_SESSION["erros"] = ["Erro ao salvar no banco de dados."];
                }
                header("Location: ../view/pages/Funcionario/pageFuncionarioCadastro.php");
                exit();
            }
        }   
    }
    mysqli_close($link);
}
// Vem da page de ALTERAÇÃO 
elseif (isset($_POST['alterar'])) {
    $idRestauranteNovo = $_POST['idRestaurante'];
    $nova_data_inicio = $_POST['data_inicio'];
    $nova_data_fim = $_POST['data_fim'];

    // Verifique se a descrição não está vazia
    if (empty($data_inicio) && empty( $data_fim)) {
        $referenciaModel->validar_campos( $data_inicio, $data_fim);
    } else {
        // Verificar se a erro
        if (!empty($referenciaModel->getErros())) {
            // Há erros, armazene-os na sessão
            $_SESSION["erros"] = $referenciaModel->getErros();
            header("Location: ../view/pages/pageFuncionarioAlteracao.php");
            exit();
        }
        else {
            if ($atualizado = $referenciaModel->update($idFuncionario, $idRestauranteNovo, $nova_data_inicio, $nova_data_fim)) {
                $_SESSION["sucesso"] = $referenciaModel->getSucesso();
            } else {
                $_SESSION["erros"] = ["Erro ao alterar no banco de dados."];
            }
            header("Location: ../view/pages/pageFuncionarioAlteracao.php");
            exit();
        }
    }
}
// EXCLUIR
elseif (isset($_GET['acao']) && $_GET['acao'] === 'excluir') {
    if (isset($_GET['idRestaurante']) && isset($_GET['idFuncionario'])) {
        $idRestaurante = $_GET['idRestaurante'];
        $idFuncionario = $_GET['idFuncionario'];

        if ($referenciaModel->delete( $idFuncionario, $idRestaurante)) {
            $_SESSION["sucesso"] = $referenciaModel->getSucesso();
        } else {
            $_SESSION["erros"] = ["Erro ao excluir no banco de dados."];
        }
    } else {
        $_SESSION["erros"] = ["ID de restaurante não especificado."];
    }

    header("Location: ../view/pages/pageFuncionarioAlteracao.php");
    exit();
}
// EXCLUIR SELECIONADOS
elseif(isset($_GET['acao']) && $_GET['acao'] === 'excluirSelecionados'){ 
    if(isset($_POST['checkbox']) && is_array($_POST['checkbox'])) {
        // Loop através dos IDs das categorias selecionadas
        foreach ($_POST['checkbox'] as $idRestaurante) {
            // Verificar se o ID da categoria é válido (por exemplo, um número inteiro positivo)
            if (is_numeric($idRestaurante) && $idRestaurante > 0) {
                if ($referenciaModel->delete( $idFuncionario, $idRestaurante )) {
                    $_SESSION["sucesso"] = ["Restaurantes excluidos com sucesso."];
                } else {
                    $_SESSION["erros"] = ["Erro ao excluir a restaurante com ID $idRestaurante."];
                }
            } else {
                // O ID da categoria não é válido
                $_SESSION["erros"] = ["ID de restaurante inválido: $idRestaurante."];
            }
        }
        header("Location: ../view/pages/pageFuncionarioAlteracao.php");
        exit();
    }
}
// RETORNAR DADOS SALVOS
else 
{
}


?>