<?php

if (!isset($_SESSION)) {
    session_start();
}

include_once(__DIR__ . '../../configuration/connect.php');
include_once(__DIR__ . '../../model/modelCargo/cargoModel.php'); // Inclua o modelo de cargo

$cargoModel = new cargoModel($link);


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
        $cargoModel->validar_campos($descricao);
    } else {
        // Verificar se a erro
        if (!empty($cargoModel->getErros())) {
            // Há erros, armazene-os na sessão
            $_SESSION["erros"] = $cargoModel->getErros();
        } else {
            if ($atualizado = $cargoModel->update($idCargo, $novaDescricao)) {
                $_SESSION["sucesso"] = $cargoModel->getSucesso();
                header("Location: ../view/pages/pageCargo.php");
            } else {
                $_SESSION["erros"] = ["Erro ao alterar no banco de dados."];
            }

        }
        exit();
    }
}

// EXCLUIR
elseif (isset($_GET['acao']) && $_GET['acao'] === 'excluir') {
    if (isset($_GET['idCargo'])) {
        $idCargo = $_GET['idCargo'];

        if ($cargoModel->delete($idCargo)) {
            $_SESSION["sucesso"] = $cargoModel->getSucesso();
            header("Location: ../view/pages/pageCargo.php");
        } else {
            $_SESSION["erros"] = ["Erro ao excluir no banco de dados."];
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
                if ($cargoModel->delete($idCargo)) {
                    // A cargo foi excluída com sucesso
                    $_SESSION["sucesso"] = ["Cargos excluídas com sucesso."];
                } else {
                    // Houve um erro na exclusão
                    $_SESSION["erros"] = ["Erro ao excluir a cargo com ID $idCargo."];
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

// include_once('../../configuration/connect.php');
// include_once('../../model/modelCargo/cargoModel.php');// Inclua o modelo de cargo

// $cargoModel = new CargoModel($conexao); // Crie uma instância do modelo de cargo

// if (isset($_POST['salvar'])) {
//     $nome = $_POST['nome']; // Obtenha o nome do cargo do formulário
//     $resultado = $cargoModel->criarCargo($nome); // Chame a função para criar um cargo

//     if ($atualizado) {
//         $mensagem = 'Cargo atualizado com sucesso!';
//         header("Location: ../view/pages/pageCargo.php?mensagem=" . urlencode($mensagem));
//         exit();
//     } else {
//         $mensagem = 'Erro ao cadastrar o cargo.';
//     }

//     exit();
// }
?>