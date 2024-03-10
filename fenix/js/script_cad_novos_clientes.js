$(document).ready(function(){
    $('#cpf').mask('000.000.000-00', {reverse: true});
    $('#rg').mask('00.000.000-0', {reverse: true});
    $('#telefone').mask('(00) 90000-0000');
    $('#cep').mask('00000-000');
});

$('#cep').blur(function() {
    var cep = $(this).val().replace(/\D/g, '');

    if (cep.length != 8) {
        return;
    }

    $.getJSON('https://viacep.com.br/ws/' + cep + '/json/', function(data) {
        if (!("erro" in data)) {
            $('#rua').val(data.logradouro);
            $('#bairro').val(data.bairro);
            $('#cidade').val(data.localidade);
            $('#estado').val(data.uf);
            $('#numero').focus();
        } else {
            alert('CEP não encontrado.');
            limparCamposEndereco();
        }
    });
});

document.getElementById("cadastroCliente").addEventListener("submit", function(event) {
    event.preventDefault(); // Impede o envio padrão do formulário
    var form = this; // Obtém o formulário
    var formData = new FormData(form); // Cria um objeto FormData com os dados do formulário

    // Envia uma requisição assíncrona POST para o arquivo PHP de processamento
    fetch("../php/cadastrar_novos_clientes.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        console.log(data); // Exibe a resposta do servidor no console (opcional)
        // Aqui você pode redirecionar para outra página se desejar
    })
    .catch(error => {
        console.error("Erro ao enviar formulário:", error); // Exibe erros no console (opcional)
    });
});



    // Função para limpar os campos do formulário
    function limparCampos() {
        // Seleciona todos os campos de entrada e seleção dentro do formulário
        var campos = document.querySelectorAll('#cadastroCliente input, #cadastroCliente select');

        // Itera sobre os campos e define seus valores como vazio
        campos.forEach(function(campo) {
            campo.value = '';
        });
    }