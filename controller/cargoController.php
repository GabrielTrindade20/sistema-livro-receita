<?php

if (!isset($_SESSION)) {
    session_start();
}

include_once(__DIR__ . '../../configuration/connect.php');
include_once(__DIR__ . '../../model/modelCargo/cargoModel.php');
include_once(__DIR__ . '../../configuration/connect.php');
include_once(__DIR__ . '../../model/funcionarioModel.php');

$cargoModel = new cargoModel($link);
$funcionarioModel = new funcionarioModel($link);


// SALVAR 
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["salvar"])) {
    $descricao = $_POST["descricao"];

    if (empty($descricao)) {
        $cargoModel->validar_campos($descricao);
    } else {
        if (!empty($cargoModel->getErros())) {
            // Há erros, armazene-os na sessão
            $_SESSION["erros"] = $cargoModel->getErros();
        } else {
            // Não há erros, salve no banco de dados
            if ($cargoModel->create($descricao)) {
                $_SESSION["sucesso"] = $cargoModel->getSucesso();
                header("Location: ../view/pages/pageCargo.php");
            } else {
                $_SESSION["erros"] = ["Erro ao salvar no banco de dados."];
            }
        }
        exit();
    }
    mysqli_close($link);
}
// Vem da page de ALTERAÇÃO 
elseif (isset($_POST['editar'])) {
    $idCargo = $_POST['idCargo'];
    $novaDescricao = $_POST['descricao'];

    // Verifique se a descrição não está vazia
    if (empty($novaDescricao)) {
        $cargoModel->validar_campos($novaDescricao);
    } else {
        // Verificar se a erro
        if (!empty($cargoModel->getErros())) {
            // Há erros, armazene-os na sessão
            $_SESSION["erros"] = $cargoModel->getErros();
            header("Location: ../view/pages/pageCargo.php");
            exit();
        } else {
            if ($atualizado = $cargoModel->update($idCargo, $novaDescricao)) {
                $_SESSION["sucesso"] = $cargoModel->getSucesso();
                header("Location: ../view/pages/pageCargo.php");
            } else {
                $_SESSION["erros"] = ["Erro ao alterar no banco de dados."];
            }
            header("Location: ../view/pages/pageCargo.php");
            exit();
        }
    }
}

// EXCLUIR
elseif (isset($_GET['acao']) && $_GET['acao'] === 'excluir') {
    if (isset($_GET['idCargo'])) {
        $idCargo = $_GET['idCargo'];

        // Recupera os funcionários vinculados ao cargo
        $funcionariosVinculados = $funcionarioModel->recuperaFuncionarioCargo($idCargo);

        if (!empty($funcionariosVinculados)) {
            $_SESSION["erros"] = ["Cargo não pode ser excluído, pois está vinculado com funcionário."];
            header("Location: ../view/pages/pageCargo.php");
        } else {
            // Não há funcionários vinculados, proceder com a exclusão do cargo
            if ($cargoModel->delete($idCargo)) {
                $_SESSION["sucesso"] = $cargoModel->getSucesso();
                header("Location: ../view/pages/pageCargo.php");
            } else {
                $_SESSION["erros"] = ["Erro ao excluir no banco de dados."];
            }
        }
    } else {
        $_SESSION["erros"] = ["ID de cargo não especificado."];
    }
    exit();
} elseif (isset($_GET['acao']) && $_GET['acao'] === 'excluirSelecionados') {
    if (isset($_POST['checkbox']) && is_array($_POST['checkbox'])) {
        // Loop através dos IDs das cargos selecionadas
        foreach ($_POST['checkbox'] as $idCargo) {
            // Verificar se o ID da cargo é válido (por exemplo, um número inteiro positivo)
            if (is_numeric($idCargo) && $idCargo > 0) {
                // Recupera os funcionários vinculados ao cargo
                $funcionariosVinculados = $funcionarioModel->recuperaFuncionarioCargo($idCargo);

                if (!empty($funcionariosVinculados)) {
                    $_SESSION["erros"] = ["Algum cargo não pode ser excluído, pois está vinculado com funcionário."];
                    header("Location: ../view/pages/pageCargo.php");
                } else {
                    if ($cargoModel->delete($idCargo)) {
                        // A cargo foi excluída com sucesso
                        $_SESSION["sucesso"] = ["Cargos excluídas com sucesso."];
                    } else {
                        // Houve um erro na exclusão
                        $_SESSION["erros"] = ["Erro ao excluir a cargo com ID $idCargo."];
                    }
                }
            } else {
                // O ID da cargo não é válido
                $_SESSION["erros"] = ["ID de cargo inválido: $idCargo."];
            }
        }
        header("Location: ../view/pages/pageCargo.php");
        exit();
    }
}
// RETORNAR DADOS SALVOS
else {
    $cargos = $cargoModel->read();
    mysqli_close($link);

    // Contar quandas linhas tem na tabela
    $countCargos = count($cargos);
}
