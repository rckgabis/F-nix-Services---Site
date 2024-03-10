<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.html');
    exit();
}

include('conexao.php');

// Verifica se o método da requisição é POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados do formulário
    $cliente_nome = $_POST['cliente']; // Supondo que o nome do cliente seja enviado pelo formulário
    $ocorrencia_nome = $_POST['ocorrencia']; // Supondo que o nome da ocorrência seja enviado pelo formulário

    // Consulta para obter o ID do cliente usando o nome
    $query_cliente = "SELECT id FROM clientes WHERE nome = '$cliente_nome'";
    $resultado_cliente = mysqli_query($conexao, $query_cliente);

    // Consulta para obter o ID da ocorrência usando o nome
    $query_ocorrencia = "SELECT id FROM servicos WHERE nome_servico = '$ocorrencia_nome'";
    $resultado_ocorrencia = mysqli_query($conexao, $query_ocorrencia);

    // Verifica se as consultas foram bem-sucedidas
    if ($resultado_cliente && $resultado_ocorrencia) {
        // Verifica se foram encontrados registros
        if (mysqli_num_rows($resultado_cliente) > 0 && mysqli_num_rows($resultado_ocorrencia) > 0) {
            $cliente_id = mysqli_fetch_assoc($resultado_cliente)['id'];
            $ocorrencia_id = mysqli_fetch_assoc($resultado_ocorrencia)['id'];

            // Insere os dados no banco de dados
            $query = "INSERT INTO registro (cliente_nome, data, hora, ocorrencia_nome) VALUES ('$cliente_nome', CURRENT_DATE(), CURRENT_TIME(), '$ocorrencia_nome')";
            $resultado = mysqli_query($conexao, $query);

            // Verifica se a inserção foi bem-sucedida
            if ($resultado) {
                echo 'Ocorrência registrada com sucesso!';
            } else {
                echo 'Erro ao registrar a ocorrência.';
            }
        } else {
            echo 'Cliente ou ocorrência não encontrados.';
        }
    } else {
        echo 'Erro ao obter informações do cliente ou da ocorrência.';
    }
} else {
    // Se a requisição não for POST, retorna um erro
    echo 'Método de requisição inválido.';
}
?>

