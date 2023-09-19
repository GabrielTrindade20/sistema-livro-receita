<?php
include_once('../configuration/connect.php');
include_once('../controller/categoriaController.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/estiloTable.css">
    <title>Categorias</title>
</head>
<body>
<h1>Categoria</h1>

<table border="1">
    <tr>
        <th>id</th>
        <th>Categoria</th>
        <th colspan="2">Ações</th>
    </tr>
    <?php foreach ($categorias as $categoria): ?>
        <tr>
            <td><?php echo $categoria["idCategoria"]; ?></td>
            <td><?php echo $categoria["descricao"]; ?></td>
            <td>
                <a href="exclusao.php?id=<?php echo $categoria["idCategoria"]; ?>">
                    <img src="../view/css/iconsSVG/iconCategoria.svg"/>
                </a>
            </td>
            <td>
                <a href="formAlteracao.php?id=<?php echo $categoria["idCategoria"]; ?>">
                    <img src="../view/css/iconsSVG/iconCategoria.svg"/>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php if (isset($mensagem)): ?>
    <div class="mensagem"><?php echo $mensagem; ?></div>
<?php endif; ?>

    <br>
    <a href="cadastro.php">Cadastrar</a>
    <br>
    <a href="">Menu Principal</a>     

</body>
</html>

<?php 
    /* // lista categoria cadastrados  

    include_once('../configuration/connect.php');

    echo "<h1>Categoria</h1>";
    
    // lista categoria já cadastrados
    $query =   "SELECT idCategoria, descricao
                FROM Categoria;";

    if ($result = mysqli_query($link, $query)) {
        echo "<table border='1'>";
        echo '<tr><th>id</th><th>Categoria</th><th colspan="2">Ações</th></tr>';
        // busca os dados no banco de dados
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row["idCategoria"];
            $descricao = $row["descricao"];
                    
            echo "<tr>";
            echo "<td>" . $id . "</td>";
            echo "<td>" . $descricao . "</td>";
            // cria link para EXCLUSAO 
            echo '<td><a href="exclusao.php?id='. $row["idCategoria"] .'">Excluir</a></td>';
            // cria link para ALTERACAO
            echo '<td><a href="formAlteracao.php?id='. $row["idCategoria"] .'">Alterar</a></td>';
            
            echo "</tr>";
        }
        echo "</table>";
        // libera a área de memória onde está o resultado
        mysqli_free_result($result);
    }
    // fecha a conexão
    mysqli_close($link);*/
?>  

