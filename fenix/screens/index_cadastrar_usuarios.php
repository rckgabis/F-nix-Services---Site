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
    <title>Cadastrar Cliente - Fênix</title>

    <!-- Importação das fontes League Spartan e Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100..900&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=League+Spartan:wght@100..900&display=swap" rel="stylesheet">


    <!-- Importação da biblioteca -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <link rel="stylesheet" href="../css/style_cad_usuarios.css">
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
    <h2>CADASTRAR NOVO USUÁRIO DO SISTEMA</h2>
    <form id="cadastroCliente" action="php" method="POST">
        <label for="user">USUÁRIO:</label>
        <input type="text" id="user" name="user" required placeholder="INSIRA O USUÁRIO"><br>

        <!-- Botões dentro de uma div para centralizar -->
        <div class="button-container">
            <button type="submit">CADASTRAR</button>
            <button type="reset">LIMPAR</button>
        </div>
    </form>
</div>

</body>
</html>