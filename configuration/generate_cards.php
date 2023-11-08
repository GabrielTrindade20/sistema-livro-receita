<?php 

    $dbname = "livro_receita_dev";
    $servername = "localhost";
    $username = "root";
    $password = "";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }   

    $sql = "SELECT foto, nome FROM cards";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
            echo '<div class="card">';
                echo '<div><img src="' . $row["foto"] . '"></div>';
                
                echo '<div class="conteudo-card">';
                    echo '<div class="nomeReceita">';
                    echo '<a href="">' . $row["nome"] . '</a>';
                    echo '</div>';
                    
                    // Ícone de Edição
                    echo '<div class="edicaoReceita">';
                    echo '<div><a href=""><img src="css/imagens/editar.png" alt="Editar"></a></div>';
                    echo '<div><a href=""><img src="css/imagens/delete.png" alt="Excluir"></a></div>';
                    echo '</div>';
                
                echo '</div>'; // Fecha div "conteudo-card"
            echo '</div>';                 
        }
    } else {
        echo "Nenhum card encontrado.";
    }

    $conn->close();
?>