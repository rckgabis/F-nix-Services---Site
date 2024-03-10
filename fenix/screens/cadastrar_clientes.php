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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <link rel="stylesheet" href="../css/style_cad_clientes.css">
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
    <h2>CADASTRAR NOVO CLIENTE</h2>
    <form id="cadastroCliente" action="cadastrar_novos_clientes.php" method="POST">
    <label for="nome">NOME:</label>
<input type="text" id="nome" name="nome" required placeholder="INSIRA O NOME COMPLETO"><br>

<div class="grid-container">
    <div>
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" required placeholder="INSIRA O CPF">
    </div>
    <div>
        <label for="rg">RG:</label>
        <input type="text" id="rg" name="rg" required placeholder="INSIRA O RG">
    </div>
</div>

<div class="grid-container">
    <div>
        <label for="email">E-MAIL:</label>
        <input type="email" id="email" name="email" required placeholder="INSIRA O E-MAIL">
    </div>
    <div>
        <label for="telefone">TELEFONE:</label>
        <input type="tel" id="telefone" name="telefone" required placeholder="INSIRA O TELEFONE">
    </div>
</div>

<div class="grid-container">
    <div>
        <label for="residencia">TIPO:</label>
        <select id="residencia" name="residencia" required>
            <option value="" disabled selected hidden>SELECIONE O TIPO</option>
            <option value="residencial">RESIDENCIAL</option>
            <option value="comercial">COMERCIAL</option>
        </select>
    </div>
    <div>
        <label for="cep">CEP:</label>
        <input type="text" id="cep" name="cep" required placeholder="INSIRA O CEP">
    </div>
</div>

<div class="grid-container">
    <div>
        <label for="rua">RUA:</label>
        <input type="text" id="rua" name="rua" required placeholder="INSIRA O NOME DA RUA">
    </div>

    <div>
        <label for="numero">N°:</label>
        <input type="text" id="numero" name="numero" required placeholder="INSIRA O NÚMERO">
    </div>

</div>

<div class="grid-container">
<div>
        <label for="bairro">BAIRRO:</label>
        <input type="text" id="bairro" name="bairro" required placeholder="INSIRA O BAIRRO">
    </div>
    <div>
        <label for="cidade">CIDADE:</label>
        <input type="text" id="cidade" name="cidade" required placeholder="INSIRA A CIDADE">
    </div>

    </div>
    <div class="grid-container">

    <div>
        <label for="estado">ESTADO:</label>
        <select id="estado" name="estado" required>
    <option value="" disabled selected hidden>SP</option>
    <option value="AC">AC</option>
    <option value="AL">AL</option>
    <option value="AP">AP</option>
    <option value="AM">AM</option>
    <option value="BA">BA</option>
    <option value="CE">CE</option>
    <option value="DF">DF</option>
    <option value="ES">ES</option>
    <option value="GO">GO</option>
    <option value="MA">MA</option>
    <option value="MT">MT</option>
    <option value="MS">MS</option>
    <option value="MG">MG</option>
    <option value="PA">PA</option>
    <option value="PB">PB</option>
    <option value="PR">PR</option>
    <option value="PE">PE</option>
    <option value="PI">PI</option>
    <option value="RJ">RJ</option>
    <option value="RN">RN</option>
    <option value="RS">RS</option>
    <option value="RO">RO</option>
    <option value="RR">RR</option>
    <option value="SC">SC</option>
    <option value="SP">SP</option>
    <option value="SE">SE</option>
    <option value="TO">TO</option>
</select>
</div>

<div>
<label for="referencia">PONTO DE REFERÊNCIA:</label>
<input type="text" id="referencia" name="referencia" required placeholder="INSIRA O PONTO DE REFERÊNCIA"><br>
</div>
</div>


        <!-- Botões dentro de uma div para centralizar -->
        <div class="button-container">
            <button type="submit" id="btnCadastrar">CADASTRAR</button>
            <button type="reset" onclick="limparCampos()">LIMPAR</button>
        </div>
    </form>
</div>

<script>
$(document).ready(function() {
    // Adiciona um ouvinte de eventos de clique no botão "CADASTRAR"
    $('#btnCadastrar').click(function(event) {

        // Exibe o popup com a mensagem
        Swal.fire({
            title: 'Sucesso!',
            text: 'Cliente cadastrado com sucesso!',
            icon: 'success',
            showCancelButton: true,
            confirmButtonText: 'CONSULTAR',
            cancelButtonText: 'CADASTRAR OUTRO',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Redireciona para a página de consulta de clientes
                window.location.href = 'index_clientes.php';
            } else {
                // Redireciona para a página de cadastro de clientes
                window.location.href = 'cadastrar_clientes.php';
            }
        });
    });
});
</script>

<script src="../js/script_cad_novos_clientes.js"></script>

</body>
</html>