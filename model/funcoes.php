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
            echo  $cargo . "</option>";
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
                    echo $idCargo." == " .$id. " <br>";
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
?>