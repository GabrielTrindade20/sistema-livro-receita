<?php
if(!isset($_SESSION)) {
    session_start();
}

include_once(__DIR__ .'../../configuration/connect.php');
include_once(__DIR__ .'../../model/restauranteModel.php');

$restauranteModel = new restauranteModel($link);

// PESQUISAR

// SALVAR 
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["salvar"])) 
{
    $nome = $_POST["nome"];
    $contato = $_POST["contato"];
    
    if(empty($nome) && empty($nome)){
        $restauranteModel->validar_campos($nome, $contato);
    }
    else {
        if (!empty($restauranteModel->getErros())) {
            // Há erros, armazene-os na sessão
            $_SESSION["erros"] = $restauranteModel->getErros();
            header("Location: ../view/pages/pageRestaurante.php");
            exit();
        } else {
            // Não há erros, salve no banco de dados
            if ($restauranteModel->create($nome, $contato)) {
                $_SESSION["sucesso"] = $restauranteModel->getSucesso();
            } else {
                $_SESSION["erros"] = ["Erro ao salvar no banco de dados."];
            }
            header("Location: ../view/pages/pageRestaurante.php");
            exit();
        }
    }
    mysqli_close($link);
}
// Vem da page de ALTERAÇÃO 
elseif (isset($_POST['alterar'])) {
    $idRestaurante = $_POST['idRestaurante'];
    $novoNome = $_POST['nome']; 
    $novoContato = $_POST['contato']; 

    // Verifique se a descrição não está vazia
    if (empty($novoNome) && empty($novoContato)) {
        $restauranteModel->validar_campos($novoNome, $novoContato);
    } else {
        // Verificar se a erro
        if (!empty($restauranteModel->getErros())) {
            // Há erros, armazene-os na sessão
            $_SESSION["erros"] = $restauranteModel->getErros();
            header("Location: ../view/pages/pageRestaurante.php");
            exit();
        }
        else {
            if ($atualizado = $restauranteModel->update($idRestaurante, $novoNome, $novoContato)) {
                $_SESSION["sucesso"] = $restauranteModel->getSucesso();
            } else {
                $_SESSION["erros"] = ["Erro ao alterar no banco de dados."];
            }
            header("Location: ../view/pages/pageRestaurante.php");
            exit();
        }
    }
}
// EXCLUIR
elseif (isset($_GET['acao']) && $_GET['acao'] === 'excluir') {
    if (isset($_GET['idRestaurante'])) {
        $idRestaurante = $_GET['idRestaurante'];

        if ($restauranteModel->delete($idRestaurante)) {
            $_SESSION["sucesso"] = $restauranteModel->getSucesso();
        } else {
            $_SESSION["erros"] = ["Erro ao excluir no banco de dados."];
        }
    } else {
        $_SESSION["erros"] = ["ID de restaurante não especificado."];
    }

    header("Location: ../view/pages/pageRestaurante.php");
    exit();
}
// EXCLUIR SELECIONADOS
elseif(isset($_GET['acao']) && $_GET['acao'] === 'excluirSelecionados'){ 
    if(isset($_POST['checkbox']) && is_array($_POST['checkbox'])) {
        // Loop através dos IDs das categorias selecionadas
        foreach ($_POST['checkbox'] as $idRestaurante) {
            // Verificar se o ID da categoria é válido (por exemplo, um número inteiro positivo)
            if (is_numeric($idRestaurante) && $idRestaurante > 0) {
                if ($restauranteModel->delete($idRestaurante)) {
                    $_SESSION["sucesso"] = ["Restaurantes excluidos com sucesso."];
                } else {
                    $_SESSION["erros"] = ["Erro ao excluir a restaurante com ID $idRestaurante."];
                }
            } else {
                // O ID da categoria não é válido
                $_SESSION["erros"] = ["ID de restaurante inválido: $idRestaurante."];
            }
        }
        header("Location: ../view/pages/pageRestaurante.php");
        exit();
    }
}
// RETORNAR DADOS SALVOS
else 
{
    $restaurantes = $restauranteModel->read();
    mysqli_close($link);

    // Contar quandas linhas tem na tabela
    $countRestaurante = count($restaurantes); 
}


?>