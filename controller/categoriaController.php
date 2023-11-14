<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once(__DIR__ . '../../configuration/connect.php');
include_once(__DIR__ . '../../model/categoriaModel.php');

$categoriaModel = new categoriaModel($link);

// PESQUISAR
//$sendPesqCategria = filter_input( )

// SALVAR 
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["salvar"])) {
    $descricao = $_POST["descricao"];

    if (empty($descricao)) {
        $categoriaModel->validar_campos($descricao);
    } else {
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
        } else {
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
} elseif (isset($_GET['acao']) && $_GET['acao'] === 'excluirSelecionados') {
    if (isset($_POST['checkbox']) && is_array($_POST['checkbox'])) {
        // Loop através dos IDs das categorias selecionadas
        foreach ($_POST['checkbox'] as $idCategoria) {
            // Verificar se o ID da categoria é válido (por exemplo, um número inteiro positivo)
            if (is_numeric($idCategoria) && $idCategoria > 0) {
                if ($categoriaModel->delete($idCategoria)) {
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
// Pesquisar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['descricao'])) {
    $termo = $_POST['descricao'];
    $resultados = $categoriaModel->pesquisar($termo);
    
    // Armazenar os resultados da pesquisa em uma variável de sessão
    $_SESSION['resultados_pesquisa'] = $resultados;

    // Redirecionar de volta para a página pageCategoria
    header("Location: ../view/pages/pageCategoria.php");
    exit();
}




// RETORNAR DADOS SALVOS
else {
    $categorias = $categoriaModel->read();
    mysqli_close($link);

    // Contar quandas linhas tem na tabela
    $countCategorias = count($categorias);
}



?>