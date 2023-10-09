<?php
if(!isset($_SESSION)) {
    session_start();
}

include_once('../../configuration/connect.php');
include_once('../../model/categoriaModel.php');

$categoriaModel = new categoriaModel($link);

// SALVAR 
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["salvar"])) 
{
    $descricao = $_POST["descricao"];
    
    if(empty($descricao)){
        $categoriaModel->validar_campos($descricao);
    }
    else {
        if (!empty($categoriaModel->getErros())) {
            // Há erros, armazene-os na sessão
            $_SESSION["erros"] = $categoriaModel->getErros();
            header("Location: ../view/pages/pageCategoria.php");
            exit();
        } else {
            // Não há erros, salve no banco de dados
            if ($categoriaModel->create($descricao)) {
                $_SESSION["sucesso"] = $categoriaModel->getSucesso();
            } else {
                $_SESSION["erros"] = ["Erro ao salvar no banco de dados."];
            }
            header("Location: ../view/pages/pageCategoria.php");
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
        $categoriaModel->validar_campos($descricao);
    } else {
        // Verificar se a erro
        if (!empty($categoriaModel->getErros())) {
            // Há erros, armazene-os na sessão
            $_SESSION["erros"] = $categoriaModel->getErros();
            header("Location: ../view/pages/pageCategoria.php");
            exit();
        }
        else {
            if ($atualizado = $categoriaModel->update($idCategoria, $novaDescricao)) {
                $_SESSION["sucesso"] = $categoriaModel->getSucesso();
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

        if ($categoriaModel->delete($idCategoria)) {
            $_SESSION["sucesso"] = $categoriaModel->getSucesso();
        } else {
            $_SESSION["erros"] = ["Erro ao excluir no banco de dados."];
        }
    } else {
        $_SESSION["erros"] = ["ID de categoria não especificado."];
    }

    header("Location: ../view/pages/pageCategoria.php");
    exit();
}
// RETORNAR DADOS SALVOS
else 
{
    $categorias = $categoriaModel->read();
    mysqli_close($link);

    // Contar quandas linhas tem na tabela
    $countCategorias = count($categorias); 
}


?>