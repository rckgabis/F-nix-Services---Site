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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
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
    // Exibe as informações do cliente
            echo '<div class="grid-container">';
            echo '<div class="list-item"><span class="nome">' . $cliente['nome'] . '</span></div>';
            echo '<div class="list-item"><span class="rua">' . $cliente['rua'] . '</span></div>';
            echo '<div class="list-item"><span class="numero">' . $cliente['num'] . '</span></div>';
            echo '<div class="list-item"><span class="cep">' . $cliente['CEP'] . '</span></div>';
            echo '<div class="list-item"><span class="telefone">' . $cliente['telefone'] . '</span></div>';
            // Aqui você pode adicionar os ícones para visualizar, editar e excluir o cliente
            echo '<div class="list-icon">';
            echo '<i class="ph ph-eye icone-olho" onclick="visualizar(' . $cliente['id'] . ')"></i>';
            echo '<i class="ph ph-pen" onclick="editar(' . $cliente['id'] . ')"></i>';
            echo '<i class="ph ph-trash-simple" onclick="excluir(' . $cliente['id'] . ')"></i>';
            echo '</div>';
            echo '</div>';
        }
        
    } else {
        // Se não houver clientes cadastrados, exiba uma mensagem
        echo '<p>Nenhum cliente cadastrado.</p>';
    }
    ?>
</div>
</div>

<script>
$(document).ready(function() {
    $('.search-bar input[type="text"]').on('keyup', function() {
        var searchText = $(this).val().toLowerCase(); // Obtém o texto digitado na barra de pesquisa
        $('.grid-container').each(function() {
            var nome = $(this).find('.nome').text().toLowerCase(); // Obtém o texto do campo "nome"
            var rua = $(this).find('.rua').text().toLowerCase(); // Obtém o texto do campo "rua"
            var numero = $(this).find('.numero').text().toLowerCase(); // Obtém o texto do campo "numero"
            var cep = $(this).find('.cep').text().toLowerCase(); // Obtém o texto do campo "cep"
            var telefone = $(this).find('.telefone').text().toLowerCase(); // Obtém o texto do campo "telefone"
            // Verifica se algum dos campos contém o texto pesquisado
            if (nome.includes(searchText) || rua.includes(searchText) || numero.includes(searchText) || cep.includes(searchText) || telefone.includes(searchText)) {
                $(this).show(); // Exibe o contêiner da linha inteira se houver correspondência em algum campo
            } else {
                $(this).hide(); // Oculta o contêiner da linha inteira se não houver correspondência em nenhum campo
            }
        });
    });
});



function visualizar(idCliente) {
    $.ajax({
        url: '../php/consultar_clientes.php',
        method: 'POST',
        data: { idCliente: idCliente },
        dataType: 'json',
        success: function(response) {
            // Construa a mensagem do SweetAlert com os detalhes do cliente
            var mensagem = '<div>';
            mensagem += '<p><strong>Nome:</strong> ' + response.nome + '</p>';
            mensagem += '<p><strong>CPF:</strong> ' + response.cpf + '</p>';
            mensagem += '<p><strong>RG:</strong> ' + response.rg + '</p>';
            mensagem += '<p><strong>Email:</strong> ' + response.email + '</p>';
            mensagem += '<p><strong>Telefone:</strong> ' + response.telefone+ '</p>';
            mensagem += '<p><strong>Tipo:</strong> ' + response.tipo+ '</p>';
            mensagem += '<p><strong>CEP:</strong> ' + response.CEP+ '</p>';
            mensagem += '<p><strong>Rua:</strong> ' + response.rua + ' N° ' + response.num + '</p>';
            mensagem += '<p><strong>Bairro:</strong> ' + response.bairro+ '</p>';
            mensagem += '<p><strong>Cidade:</strong> ' + response.cidade+ '</p>';
            mensagem += '<p><strong>Estado:</strong> ' + response.estado+ '</p>';
            mensagem += '<p><strong>Ponto Refência:</strong> ' + response.pont_ref+ '</p>';
            mensagem += '<p><strong>Contato 1:</strong> ' + response.nome_contato1 + '  ' + response.parentesco_contato1 + '  ' + response.numero_contato1 + '</p>';
            mensagem += '<p><strong>Contato 2:</strong> ' + response.nome_contato2 + '  ' + response.parentesco_contato2 + '  ' + response.numero_contato2 + '</p>';
            mensagem += '<p><strong>Contato 3:</strong> ' + response.nome_contato3 + '  ' + response.parentesco_contato3 + '  ' + response.numero_contato3 + '</p>';

            mensagem += '</div>';

            // Abra o popup do SweetAlert com os detalhes do cliente
            Swal.fire({
                title: 'DETALHES DO CLIENTE',
                html: mensagem,
                icon: 'info',
                confirmButtonText: 'FECHAR'
            });
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('Ocorreu um erro ao buscar os detalhes do cliente.');
        }
    });
}

function editar(idCliente) {
    // Redireciona o usuário para a tela de edição de usuário com o ID do usuário como parâmetro na URL
    window.location.href = 'editar_clientes.php?id=' + idCliente;
}

function excluir(idCliente) {
    Swal.fire({
        title: 'Tem certeza?',
        text: 'Você está prestes a excluir os dados deste cliente. Esta ação não pode ser revertida!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sim, excluir!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Se confirmado, envie uma solicitação AJAX para excluir o cliente
            $.ajax({
                url: '../php/excluir_clientes.php',
                method: 'POST',
                data: { idCliente: idCliente },
                success: function(response) {
                    // Exibe uma mensagem de sucesso após a exclusão do cliente
                    Swal.fire({
                        title: 'Cliente excluído!',
                        text: 'Os dados do cliente foram excluído com sucesso.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                    // Faça qualquer outra coisa necessária, como recarregar a página
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Ocorreu um erro ao excluir o cliente.');
                }
            });
        }
    });
}

</script>



<script src="script_consultar_clientes.js"></script>
</body>
</html>