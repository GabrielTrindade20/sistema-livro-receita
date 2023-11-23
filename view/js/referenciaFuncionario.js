function carregarFuncionario(valor) {
    // Realize uma solicitação AJAX para o script PHP de atualização
    if (valor.length >= 2) {
        // Crie uma instância do objeto XMLHttpRequest
        var xhr = new XMLHttpRequest();

        // Defina o método e a URL da solicitação
        xhr.open('GET', '../../../controller/funcionarioPesquisarController.php?funcionario=' + valor);

        // Defina o cabeçalho para indicar que você está enviando dados via URL
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        // Defina a função a ser chamada quando a solicitação estiver concluída
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    // A resposta foi bem-sucedida, faça algo com os dados recebidos
                    console.log(xhr.responseText);
                    var resposta = JSON.parse(xhr.responseText);

                    var conteudoHTML = "<ul class='list-group' position-fixed>";
                    if(resposta['status']){
                        for (i = 0; i < resposta['dados'].length; i++) {
                           conteudoHTML += "<li class='list-group-item list-group-itemaction' style='cursor: pointer;' onclick='getIdFuncionario(" 
                           + resposta['dados'][i].idFuncionario + " , " +  JSON.stringify(resposta['dados'][i].nome) + ")'>" 
                           + resposta['dados'][i].nome + "</li>";
                        }
                    } else {
                        conteudoHTML += " <li class='list-group-item' disabled>" + resposta['msg'] + "</li> ";
                    }

                    conteudoHTML += "</ul>";

                    // enviar para o html lista
                    document.getElementById('resultado-pesquisa-funcionario').innerHTML = conteudoHTML;
                    
                } else {
                    // Houve um erro na solicitação
                    console.error('Erro na solicitação. Código de status:', xhr.status);
                }
            }
        };

        xhr.send();
        
    } else {
        document.getElementById('resultado-pesquisa-funcionario').innerHTML = "";
    }
}

function getIdFuncionario(idFuncionario, nome)
{
    document.getElementById("nome").value = nome;
    document.getElementById("idFuncionario").value = idFuncionario;
    
    // fechar lista
    document.getElementById('resultado-pesquisa-funcionario').innerHTML = "";
}
