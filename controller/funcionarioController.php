<?php
if(!isset($_SESSION)) {
    session_start();
}

include_once(__DIR__ .'../../configuration/connect.php');
include_once(__DIR__ .'../../model/funcionarioModel.php');

$funcionarioModel = new funcionarioModel($link);

// PESQUISAR
//$sendPesqCategria = filter_input( )
/*
// SALVAR 
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["salvar"])) 
{
    $rg = $_POST["rg"];
    $nome = $_POST["rg"];
    $rg = $_POST["rg"];
    $rg = $_POST["rg"];
    $rg = $_POST["rg"];
    $rg = $_POST["rg"];
    
    if(empty($descricao)){
        $funcionarioModel->validar_campos($rg, $nome, $data_ingresso, $salario, $nome_fantasia, $cargo );
    }
    else {
        if (!empty($funcionarioModel->getErros())) {
            // Há erros, armazene-os na sessão
            $_SESSION["erros"] = $funcionarioModel->getErros();
            header("Location: ../view/pages/pageCategoria.php");
            exit();
        } else {
            // Não há erros, salve no banco de dados
            if ($funcionarioModel->create($rg, $nome, $data_ingresso, $salario, $nome_fantasia, $cargo )) {
                $_SESSION["sucesso"] = $funcionarioModel->getSucesso();
            } else {
                $_SESSION["erros"] = ["Erro ao salvar no banco de dados."];
            }
            header("Location: ../view/pages/pageFuncionario.php");
            exit();
        }
    }
    mysqli_close($link);
}
// Vem da page de ALTERAÇÃO 
elseif (isset($_POST['alterar'])) {
    $idCategoria = $_POST['idCategoria'];
    $novaDescricao = $_POST['descricao']; 

    // Verifique se a descrição não está vazia
    if (empty($novaDescricao)) {
        $funcionarioModel->validar_campos($rg, $nome, $data_ingresso, $salario, $nome_fantasia, $cargo );
    } else {
        // Verificar se a erro
        if (!empty($funcionarioModel->getErros())) {
            // Há erros, armazene-os na sessão
            $_SESSION["erros"] = $funcionarioModel->getErros();
            header("Location: ../view/pages/pageCategoria.php");
            exit();
        }
        else {
            if ($atualizado = $funcionarioModel->update($idCategoria, $novaDescricao)) {
                $_SESSION["sucesso"] = $funcionarioModel->getSucesso();
            } else {
                $_SESSION["erros"] = ["Erro ao alterar no banco de dados."];
            }
            header("Location: ../view/pages/pageCategoria.php");
            exit();
        }
    }
}
// EXCLUIR
elseif (isset($_GET['acao']) && $_GET['acao'] === 'excluir') {
    if (isset($_GET['idCategoria'])) {
        $idCategoria = $_GET['idCategoria'];

        if ($funcionarioModel->delete($idCategoria)) {
            $_SESSION["sucesso"] = $funcionarioModel->getSucesso();
        } else {
            $_SESSION["erros"] = ["Erro ao excluir no banco de dados."];
        }
    } else {
        $_SESSION["erros"] = ["ID de categoria não especificado."];
    }

    header("Location: ../view/pages/pageCategoria.php");
    exit();
}
elseif(isset($_GET['acao']) && $_GET['acao'] === 'excluirSelecionados'){ 
    if(isset($_POST['checkbox']) && is_array($_POST['checkbox'])) {
        // Loop através dos IDs das categorias selecionadas
        foreach ($_POST['checkbox'] as $idCategoria) {
            // Verificar se o ID da categoria é válido (por exemplo, um número inteiro positivo)
            if (is_numeric($idCategoria) && $idCategoria > 0) {
                if ($funcionarioModel->delete($idCategoria)) {
                    // A categoria foi excluída com sucesso
                    $_SESSION["sucesso"] = ["Categorias excluídas com sucesso."];
                } else {
                    // Houve um erro na exclusão
                    $_SESSION["erros"] = ["Erro ao excluir a categoria com ID $idCategoria."];
                }
            } else {
                // O ID da categoria não é válido
                $_SESSION["erros"] = ["ID de categoria inválido: $idCategoria."];
            }
        }
        header("Location: ../view/pages/pageCategoria.php");
        exit();
    }
}
// RETORNAR DADOS SALVOS
else 
{*/
    $funcionarios = $funcionarioModel->read();
    mysqli_close($link);

    // Contar quandas linhas tem na tabela
    $countFuncinarios = count($funcionarios); 
//}


?>