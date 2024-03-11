<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.html');
    exit();
}

include('conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nova_ocorrencia'])) {
    // Capturando os dados do formulário
    $nome_servico = isset($_POST['nova_ocorrencia']) ? $_POST['nova_ocorrencia'] : '';

    // Preparando e executando a consulta SQL para inserir os dados na tabela 'servicos'
    $sql = "INSERT INTO servicos (nome_servico) VALUES ('$nome_servico')";

    if (mysqli_query($conexao, $sql)) {
        echo "<script>setTimeout(function() { document.getElementById('mensagem-sucesso').style.display = 'none'; }, 3000);</script>";
        echo "<h1 id='mensagem-sucesso'>Dados enviados com sucesso.</h1>";
    } else {
        echo "<script>setTimeout(function() { document.getElementById('mensagem-erro').style.display = 'none'; }, 3000);</script>";
        echo "<h1 id='mensagem-erro'>Erro ao enviar os dados. Por favor, tente novamente.</h1>" . mysqli_error($conexao);
    }
}
