<?php
if(!isset($_SESSION)) {
    session_start();
}

include_once(__DIR__ .'../../configuration/connect.php');
include_once(__DIR__ .'../../model/funcionarioModel.php');
include_once(__DIR__ .'../../model/referenciaModel.php');

$funcionarioModel = new funcionarioModel($link);
$referenciaModel = new referenciaModel($link);

// PESQUISAR
//$sendPesqCategria = filter_input( )

// SALVAR 
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["salvar"])) 
{
    $rg = $_POST["rg"];
    $nome = $_POST["nome"];
    $data_ingresso = $_POST["data_ingresso"];
    $salario = $_POST["salario"];
    $nome_fantasia = $_POST["nome_fantasia"];
    $status = 0; // 0 - ativo 
    $cargo = $_POST["idCargo"];
    $idRestaurante = $_POST['idRestaurante']; // ID do restaurante
    $data_inicio = $_POST['data_inicio']; 
    $data_fim = $_POST['data_fim'];
    
    if(empty($rg) && empty($nome) && empty($data_ingresso) && empty($salario) && empty($nome_fantasia) && empty($status) && empty($cargo)){
        $funcionarioModel->validar_campos($rg, $nome, $data_ingresso, $salario, $nome_fantasia, $status, $cargo );
    }
    else {
        if (!empty($funcionarioModel->getErros())) {
            // Há erros, armazene-os na sessão
            $_SESSION["erros"] = $funcionarioModel->getErros();
            header("Location: ../view/pages/pageFuncionario.php");
            exit();
        } else {
            // Não há erros, salve no banco de dados
            if ($funcionarioModel->create($rg, $nome, $data_ingresso, $salario, $nome_fantasia, $status, $cargo )) {
                $idFuncionario = mysqli_insert_id($link);

                if ($referenciaModel->create( $idFuncionario, $idRestaurante, $data_inicio, $data_fim)) {
                    $_SESSION["sucesso"] = $funcionarioModel->getSucesso();
                } else {
                    $_SESSION["erros"] = ["Erro ao associar restaurante ao funcionário: " . $referenciaModel->getErros()];
                }
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
    $idFuncionario = $_POST['idFuncionario'];
    $rg_novo = $_POST["rg"];
    $nome_novo = $_POST["nome"];
    $data_ingresso_novo = $_POST["data_ingresso"];
    $salario_novo = $_POST["salario"];
    $nome_fantasia_novo = $_POST["nome_fantasia"];
    $status_novo = $_POST["status"];
    $cargo_novo = $_POST["idCargo"];

    // Verifique se a descrição não está vazia
    if (empty($rg_novo) && empty($nome_novo) && empty($data_ingresso_novo) && empty($salario_novo) && empty($nome_fantasia_novo) && empty($status_novo) && empty($cargo_novo)) {
        $funcionarioModel->validar_campos( $rg_novo, $nome_novo, $data_ingresso_novo, $salario_novo, $nome_fantasia_novo, $status_novo, $cargo_novo );
    } else {
        // Verificar se a erro
        if (!empty($funcionarioModel->getErros())) {
            // Há erros, armazene-os na sessão
            $_SESSION["erros"] = $funcionarioModel->getErros();
            header("Location: ../view/pages/pageFuncionario.php");
            exit();
        }
        else {
            if ($atualizado = $funcionarioModel->update( $idFuncionario, $rg_novo, $nome_novo, $data_ingresso_novo, $salario_novo, $nome_fantasia_novo, $status_novo, $cargo_novo )) {
                $_SESSION["sucesso"] = $funcionarioModel->getSucesso();
            } else {
                $_SESSION["erros"] = ["Erro ao alterar no banco de dados."];
            }
            header("Location: ../view/pages/pageFuncionario.php");
            exit();
        }
    }
}
// INATIVO
elseif (isset($_GET['acao']) && $_GET['acao'] === 'inativo') {
    if (isset($_GET['idFuncionario'])) {
        $idFuncionario = $_GET['idFuncionario'];

        if ($funcionarioModel->status_inativo($idFuncionario, 1)) {
            $_SESSION["sucesso"] = $funcionarioModel->getSucesso();
        } else {
            $_SESSION["erros"] = ["Erro ao atualizar no banco de dados."];
        }
    } else {
        $_SESSION["erros"] = ["ID de funcionario não especificado."];
    }

    header("Location: ../view/pages/pageFuncionario.php");
    exit();
}
elseif(isset($_GET['acao']) && $_GET['acao'] === 'inativosSelecionados'){ 
    if(isset($_POST['checkbox']) && is_array($_POST['checkbox'])) {
        // Loop através dos IDs das categorias selecionadas
        foreach ($_POST['checkbox'] as $idFuncionario) {
            // Verificar se o ID da categoria é válido (por exemplo, um número inteiro positivo)
            if (is_numeric($idFuncionario) && $idFuncionario > 0) {
                if ($funcionarioModel->status_inativo($idFuncionario, 1)) {
                    // A categoria foi excluída com sucesso
                    $_SESSION["sucesso"] = ["Categorias excluídas com sucesso."];
                } else {
                    // Houve um erro na exclusão
                    $_SESSION["erros"] = ["Erro ao excluir a categoria com ID $idFuncionario."];
                }
            } else {
                // O ID da categoria não é válido
                $_SESSION["erros"] = ["ID de categoria inválido: $idFuncionario."];
            }
        }
        header("Location: ../view/pages/pageCategoria.php");
        exit();
    }
}

// RETORNAR DADOS SALVOS
else 
{
    $funcionarios = $funcionarioModel->read();
    mysqli_close($link);

    // Contar quandas linhas tem na tabela
    $countFuncionarios = count($funcionarios); 
}


?>