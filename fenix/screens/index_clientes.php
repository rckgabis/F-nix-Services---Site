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

// Consulta para obter os clientes cadastrados
$query = "SELECT * FROM clientes";
$resultado = mysqli_query($conexao, $query);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Cliente - Fênix</title>

    <!-- Importação das fontes League Spartan e Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100..900&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=League+Spartan:wght@100..900&display=swap" rel="stylesheet">


    <!-- Importação da biblioteca -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    

    <link rel="stylesheet" href="../css/style_clientes.css">
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
    <h2>CONSULTAR CLIENTES</h2>

    <div class="top-bar">
        <button class="btn-cadastrar" onclick="window.location.href='cadastrar_clientes.php'">CADASTRAR NOVO CLIENTE</button>

        <!-- Barra de Pesquisa -->
        <div class="search-bar">
            <input type="text" placeholder="PESQUISAR...">
            <button><i class="ph ph-magnifying-glass"></i></button>
        </div>
    </div>


    <div class="lista">
    <?php
    // Verifica se há clientes cadastrados
    if (mysqli_num_rows($resultado) > 0) {
        // Loop para percorrer os resultados da consulta
        while ($cliente = mysqli_fetch_assoc($resultado)) {
            // Exibe as informações do cliente
            echo '<div class="list-item">';
            echo '<span class="nome">' . $cliente['nome'] . '</span>';
            echo '<span class="rua">' . $cliente['rua'] . '</span>';
            echo '<span class="numero">' . $cliente['num'] . '</span>';
            echo '<span class="cep">' . $cliente['CEP'] . '</span>';
            echo '<span class="telefone">' . $cliente['telefone'] . '</span>';
            // Aqui você pode adicionar os ícones para visualizar, editar e excluir o cliente
            echo '<i class="ph ph-eye icone-olho" onclick="visualizar()"></i>';
            echo '<i class="ph ph-pen" onclick="editar()"></i>';
            echo '<i class="ph ph-trash-simple" onclick="excluir()"></i>';
            echo '</div>';
        }
    } else {
        // Se não houver clientes cadastrados, exiba uma mensagem
        echo '<p>Nenhum cliente cadastrado.</p>';
    }
    ?>
</div>


<script src="script_consultar_clientes.js"></script>
</body>
</html>