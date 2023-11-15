<?php

function monta_select_cargo()
{

    global $link;

    // lista cursos já cadastrados
    $query = "SELECT idCargo, descricao FROM cargo;";
    if ($result = mysqli_query($link, $query)) {
        echo "<select name=\"idCargo\">";
        echo "<option selected disabled hidden> Selecionar Cargo</option>";
        // busca os dados lidos do banco de dados
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row["idCargo"];
            $cargo = $row["descricao"];
            echo "<option value=\"$id\">";
            echo  $cargo . "</option>";
        }
        echo "</select>";

        // libera a área de memória onde está o resultado
        mysqli_free_result($result);
    }
} // fim monta_select_cargo

function monta_select_cargo2($idCargo)
{
    global $link;

    // lista cursos já cadastrados
    $query = "SELECT idCargo, descricao FROM cargo;";
    if ($result = mysqli_query($link, $query)) {
        echo "<select name=\"idCargo\">";
        // busca os dados lidos do banco de dados
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row["idCargo"];
            $cargo = $row["descricao"];
            echo $idCargo . " == " . $id . " <br>";
            if ($idCargo == $id) {
                $selected = 'selected';
            } else {
                $selected = '';
            }
            echo "<option value=\"$id\" $selected>";
            echo  $cargo . "</option>";
        }
        echo "</select>";

        // libera a área de memória onde está o resultado
        mysqli_free_result($result);
    }
}

function monta_select_restaurante()
{

    global $link;

    // lista cursos já cadastrados
    $query = "SELECT idRestaurante, nome FROM restaurante;";
    if ($result = mysqli_query($link, $query)) {
        echo "<select name=\"idRestaurante\">";
        echo "<option selected disabled hidden> Selecionar Restaurante</option>";
        // busca os dados lidos do banco de dados
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row["idRestaurante"];
            $restaurante = $row["nome"];
            echo "<option value=\"$id\">";
            echo  $restaurante . '</option>';
        }
        echo "</select>";

        // libera a área de memória onde está o resultado
        mysqli_free_result($result);
    }
} // fim monta_select_restaurante


function monta_select_categoria()
{

    global $link;

    // lista medidas já cadastrados
    $query = "SELECT idCategoria, descricao FROM Categoria;";
    if ($result = mysqli_query($link, $query)) {
        echo "<select name=\"idCategoria\">";
        echo "<option selected disabled hidden> Selecionar Categoria</option>";
        // busca os dados lidos do banco de dados
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row["idCategoria"];
            $categoria = $row["descricao"];
            echo "<option value=\"$id\">";
            echo  $categoria . '</option>';
        }
        echo "</select>";

        // libera a área de memória onde está o resultado
        mysqli_free_result($result);
    }
} // fim monta_select_categoria

function monta_select_medida()
{

    global $link;

    // lista medidas já cadastrados
    $query = "SELECT idMedida, descricao FROM Medida;";
    if ($result = mysqli_query($link, $query)) {
        echo "<select name=\"idMedida\">";
        echo "<option selected disabled hidden> Selecionar Medida</option>";
        // busca os dados lidos do banco de dados
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row["idMedida"];
            $medida = $row["descricao"];
            echo "<option value=\"$id\">";
            echo  $medida . '</option>';
        }
        echo "</select>";

        // libera a área de memória onde está o resultado
        mysqli_free_result($result);
    }
} // fim monta_select_medida

function monta_select_Ingrediente()
{

    global $link;

    $query = "SELECT idIngrediente, nome FROM Ingrediente;";
    if ($result = mysqli_query($link, $query)) {
        echo '<input list="ingredientes" name="idIngrediente" placeholder="Selecionar ou Adicionar">';
        echo '<datalist id="ingredientes">';

        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row["idIngrediente"];
            $ingrediente = $row["nome"];
            echo "<option value=\"$ingrediente\">";
        }

        echo '</datalist>';
        mysqli_free_result($result);
    }
}

function monta_select_degustador()
{
    global $link;

    // lista degustador já cadastrados
    $query =   "SELECT f.idFuncionario, f.nome, c.descricao AS cargo
                FROM funcionario f
                JOIN Cargo c ON f.idCargo = c.idCargo
                WHERE c.descricao = 'Desgustador';";

    if ($result = mysqli_query($link, $query)) {
        echo "<select name=\"idFuncionario\">";
        echo "<option selected disabled hidden> Selecionar Degustador</option>";
        // busca os dados lidos do banco de dados
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row["idFuncionario"];
            $nome_degustador = $row["nome"];
            echo "<option value=\"$id\">";
            echo  $nome_degustador . "</option>";
        }
        echo "</select>";

        // libera a área de memória onde está o resultado
        mysqli_free_result($result);
    }
} // fim monta_select_Ingrediente

function monta_select_cozinheiro()
{
    global $link;

    // lista degustador já cadastrados
    $query =   "SELECT f.idFuncionario, f.nome, c.descricao AS cargo
                FROM funcionario f
                JOIN Cargo c ON f.idCargo = c.idCargo
                WHERE c.descricao = 'Cozinheiro';";

    if ($result = mysqli_query($link, $query)) {
        echo "<select name=\"idFuncionario\">";
        echo "<option selected disabled hidden> Selecionar Cozinheiro</option>";
        // busca os dados lidos do banco de dados
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row["idFuncionario"];
            $nome_cozinheiro = $row["nome"];
            echo "<option value=\"$id\">";
            echo  $nome_cozinheiro . "</option>";
        }
        echo "</select>";

        // libera a área de memória onde está o resultado
        mysqli_free_result($result);
    }
} // fim monta_select_Ingrediente
