$(document).ready(function(){
    $('#cpf').mask('000.000.000-00', {reverse: true});
    $('#rg').mask('00.000.000-0', {reverse: true});
    $('#telefone').mask('(00) 90000-0000');
    $('#cep').mask('00000-000');
    $('#numero_contato1').mask('(00) 90000-0000');
    $('#numero_contato2').mask('(00) 90000-0000');
    $('#numero_contato3').mask('(00) 90000-0000');
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