<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.html');
    exit();
}

$nome_usuario = isset($_SESSION['usuario_nome']) ? $_SESSION['usuario_nome'] : '';
$nivel_acesso = isset($_SESSION['nivel_acesso']) ? $_SESSION['nivel_acesso'] : '';

// Verifica se o usuário é um admin
$isAdmin = ($nivel_acesso === 'admin');

include('conexao.php');

// Verifica se o cliente a ser excluído foi enviado via GET
if (isset($_GET['excluir_cliente'])) {
    $idCliente = $_GET['excluir_cliente'];

    // Consulta para excluir o cliente do banco de dados
    $queryExcluir = "DELETE FROM clientes WHERE id = $idCliente";
    $resultadoExcluir = mysqli_query($conexao, $queryExcluir);

    if ($resultadoExcluir) {
        // Redireciona de volta para a página de consulta de clientes após a exclusão
        header('Location: index_clientes.php');
        exit();
    } else {
        // Em caso de erro, exibe uma mensagem de erro
        echo '<script>alert("Erro ao excluir o cliente. Por favor, tente novamente.");</script>';
    }
}

// Consulta para obter os clientes cadastrados
$query = "SELECT * FROM clientes";
$resultado = mysqli_query($conexao, $query);

?>