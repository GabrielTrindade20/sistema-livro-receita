<?php 

function monta_select_cargo(){

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
            echo  $cargo . '</option>';
            }
            echo "</select>";
            
        // libera a área de memória onde está o resultado
        mysqli_free_result($result);
    }
}// fim monta_select_cargo

function monta_select_cargo2($idCargo){
    global $link;
  
    // lista cursos já cadastrados
    $query = "SELECT idCargo, descricao FROM cargo;";
    if ($result = mysqli_query($link, $query)) {
        echo "<select name=\"idCargo\">";
        // busca os dados lidos do banco de dados
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row["idCargo"];
            $cargo = $row["descricao"];
                    echo $idCargo." == ".$id." <br>";
                    if ($idCargo == $id) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                    }
            echo "<option value=\"$id\" $selected>";
            echo  $cargo . '</option>';
            }
            echo "</select>";
            
        // libera a área de memória onde está o resultado
        mysqli_free_result($result);
    }
}

function monta_select_restaurante(){

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
}// fim monta_select_restaurante

function monta_select_medida(){

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
}// fim monta_select_medida

function monta_select_categoria(){

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
}// fim monta_select_categoria

function monta_select_Ingrediente(){

    global $link;
    
    // lista medidas já cadastrados
    $query = "SELECT idIngrediente, descricao FROM Ingrediente;";
    if ($result = mysqli_query($link, $query)) {
        echo "<select name=\"idIngrediente\">";
        echo "<option selected disabled hidden> Selecionar Ingrediente</option>";
        // busca os dados lidos do banco de dados
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row["idIngrediente"];
            $ingrediente = $row["descricao"];
            echo "<option value=\"$id\">";
            echo  $ingrediente . '</option>';
            }
            echo "</select>";
            
        // libera a área de memória onde está o resultado
        mysqli_free_result($result);
    }
}// fim monta_select_Ingrediente
?>