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

include('../php/conexao.php');


?>

<!-- registro_ocorrencias.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Fênix</title>

    <!-- Importação das fontes League Spartan e Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100..900&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=League+Spartan:wght@100..900&display=swap" rel="stylesheet">


    <!-- Importação da biblioteca -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <link rel="stylesheet" href="../css/style_registro_ocorr.css">
</head>
<body>

<div class="sidenav">
    <img src="../assets/logo-fenix-branca.png" alt="Logo Fênix Branca" style="width: 100%; max-width: 225px; display: block; margin: 0 auto; padding-top: 40px;">
    <a href="index_registro_ocorr.php"><i class="ph ph-list-plus"></i> REGISTRO   DE OCORRÊNCIAS</a>
    <a href="index_clientes.php"><i class="ph ph-users-three"></i> CLIENTES</a>
    <a href="index_cadastrar_usuarios.php"><i class="ph ph-user-list"></i> USUÁRIOS</a>
    <a href="index.html" class="logout"><i class="ph ph-sign-out"></i> SAIR</a>
</div>

<div class="container">
    <h2>REGISTRO DE OCORRÊNCIAS</h2>
    <form id="registroOcorrForm" onsubmit="return false;">
        <label for="cliente">CLIENTE:</label>
        <select id="cliente" name="cliente" required>
            <option value="">SELECIONE O CLIENTE</option>
            <?php
            // Consulta SQL para obter os nomes dos clientes da tabela clientes
            $queryClientes = "SELECT nome FROM clientes";
            $resultClientes = mysqli_query($conexao, $queryClientes);

            // Verifica se a consulta foi bem-sucedida
            if ($resultClientes && mysqli_num_rows($resultClientes) > 0) {
                // Loop através dos resultados para preencher as opções do menu suspenso
                while ($row = mysqli_fetch_assoc($resultClientes)) {
                    $clienteNome = $row['nome'];
                    echo "<option value='$clienteNome'>$clienteNome</option>";
                }
            } else {
                echo "<option value=''>Erro ao carregar clientes</option>";
            }
            ?>
        </select><br><br>

        <label for="ocorrencia">TIPO OCORRÊNCIA:</label>
        <select id="ocorrencia" name="ocorrencia" required>
            <option value="">SELECIONE O TIPO DA OCORRÊNCIA</option>
            <?php
            // Consulta SQL para obter os nomes dos clientes da tabela clientes
            $queryServicos = "SELECT nome_servico FROM servicos";
            $resultServicos = mysqli_query($conexao, $queryServicos);

            // Verifica se a consulta foi bem-sucedida
            if ($resultServicos && mysqli_num_rows($resultServicos) > 0) {
                // Loop através dos resultados para preencher as opções do menu suspenso
                while ($row = mysqli_fetch_assoc($resultServicos)) {
                    //$ServicosId = $row['id'];
                    $ServicosNome = $row['nome_servico'];
                    echo "<option value=''>$ServicosNome</option>";
                }
            } else {
                echo "<option value=''>Erro ao carregar tipo de ocorrências</option>";
            }
            ?>
                <option value="nova">Cadastrar nova</option>

        </select>

    <div class="button-container">
    <button type="button" class="btn" onclick="salvarOcorrencia()">SALVAR</button>
    <button type="button" class="btn" onclick="limparForm()">LIMPAR</button>
</div>

<script src="../js/script_registro_ocorr.js"></script>
</body>
</html>