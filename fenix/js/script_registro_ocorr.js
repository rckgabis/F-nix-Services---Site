function salvarOcorrencia() {
    // Obter os dados do formulário
    var cliente = document.getElementById('cliente').value;
    var ocorrencia = document.getElementById('ocorrencia').value;

    // Criar um objeto FormData para enviar os dados para o PHP
    var formData = new FormData();
    formData.append('cliente', cliente);
    formData.append('ocorrencia', ocorrencia);

    // Fazer uma requisição AJAX para o arquivo PHP
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../php/registro_ocorr.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Verificar se a requisição foi bem-sucedida e exibir uma mensagem ao usuário
            alert(xhr.responseText);
        } else {
            // Se a requisição não foi bem-sucedida, exibir uma mensagem de erro
            alert('Erro ao salvar a ocorrência.');
        }
    };
    xhr.send(formData);
}