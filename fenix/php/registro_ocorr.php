<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.html');
    exit();
}

include('conexao.php');

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $cliente = $_POST['cliente'];
    $ocorrencia = $_POST['ocorrencia'];
    
    // Ajusta a hora
    $hora_atual = date('H:i:s', strtotime('-4 hours')); // Hora atual

    // Data atual
    $data_atual = date('Y-m-d'); // Formato Ano-Mês-Dia

    // Insere os dados na tabela "registro"
    $queryInserir = "INSERT INTO registro (cliente, data, hora, ocorrencia) VALUES ('$cliente', '$data_atual', '$hora_atual', '$ocorrencia')";
}
?>