<?php
function recuperaCategoria($id){

    global $link;
    // lista cursos já cadastrados
    $query =   "SELECT idCategoria, descricao
                FROM Categoria
                WHERE idCategoria = '$id';";
    if ($result = mysqli_query($link, $query)) {
             // busca os dados lidos do banco de dados
        while ($row = mysqli_fetch_assoc($result)) {
                  return $row;
            }           
          
        // libera a área de memória onde está o resultado
        mysqli_free_result($result);
    }
}

?>