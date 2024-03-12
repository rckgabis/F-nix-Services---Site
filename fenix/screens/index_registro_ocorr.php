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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


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
        <select id="ocorrencia" name="ocorrencia" required onchange="mostrarFormularioNovoOcorrencia()">
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
                    echo "<option value='$ServicosNome'>$ServicosNome</option>";
                }
            } else {
                echo "<option value=''>Erro ao carregar tipo de ocorrências</option>";
            }
            ?>
                <option value="nova">CADASTRAR NOVA</option>

        </select>

    <div class="button-container">
    <button type="button" class="btn" onclick="salvarOcorrencia()">SALVAR</button>
    <button type="button" class="btn" onclick="limparForm()">LIMPAR</button>
    </div>
</form>

<!-- Formulário oculto para cadastrar nova ocorrência -->
<form id="form_nova_ocorrencia" action="cadastrar_nova_ocorr.php" method="post" style="display: none;">
    <label for="nova_ocorrencia">NOVA OCORRÊNCIA:</label>
    <input id="nova_ocorrencia_input" name="nova_ocorrencia" class="cadocorr" placeholder="INSIRA NOVA OCORRÊNCIA">
    <button type="button" class="btn" onclick="cadastrarNovaOcorrencia()">ENVIAR</button>
</form>

</div>

<!-- Script da função cadastrar nova ocorrência -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>


function salvarOcorrencia() {
    // Obter os dados do formulário
    var cliente = document.getElementById('cliente').value;
    var ocorrencia = document.getElementById('ocorrencia').value;

    // Verificar se os dois selects estão selecionados
    if (cliente.trim() === '' || ocorrencia.trim() === '') {
        // Exibir um pop-up de erro utilizando SweetAlert2
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Por favor, selecione um cliente e uma ocorrência.',
        });
        return; // Impede o envio da requisição se os selects não estiverem selecionados
    }

    // Criar um objeto FormData para enviar os dados para o PHP
    var formData = new FormData();
    formData.append('cliente', cliente);
    formData.append('ocorrencia', ocorrencia);

    // Fazer uma requisição AJAX para o arquivo PHP
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../php/registro_ocorr.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Verificar se a requisição foi bem-sucedida e exibir uma mensagem ao usuário
            Swal.fire({
                title: 'Sucesso!',
                text: 'Nova ocorrência registrada com sucesso!',
                icon: 'success',
            });
        } else {
            // Se a requisição não foi bem-sucedida, exibir uma mensagem de erro
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Erro ao salvar a ocorrência.',
            });
        }
    };
    xhr.send(formData);
}

function cadastrarNovaOcorrencia() {
    var novaOcorrencia = document.getElementById('nova_ocorrencia_input').value;

    // Verificar se o campo nova_ocorrencia está vazio
    if (novaOcorrencia.trim() === '') {
        // Exibir um pop-up de erro utilizando SweetAlert2
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Por favor, preencha o campo Nova Ocorrência.',
        });
        return; // Impede o envio da requisição se o campo estiver vazio
    }

    // Criar um objeto FormData para enviar os dados para o PHP
    var formData = new FormData();
    formData.append('nova_ocorrencia', novaOcorrencia);

    // Fazer uma requisição AJAX para o arquivo PHP
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../php/cadastrar_nova_ocorr.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Verificar se a requisição foi bem-sucedida e exibir uma mensagem ao usuário
            Swal.fire({
                title: 'Sucesso!',
                text: 'Ocorrência cadastrada com sucesso!',
                icon: 'success',
            });

            // Limpar o campo após o cadastro
            document.getElementById('nova_ocorrencia_input').value = '';
        } else {
            // Se a requisição não foi bem-sucedida, exibir uma mensagem de erro
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Erro ao cadastrar nova ocorrência.',
            });
        }
    };
    xhr.send(formData);
}

function mostrarFormularioNovoOcorrencia() {
        var selectOcorrencia = document.getElementById('ocorrencia');
        var formNovaOcorrencia = document.getElementById('form_nova_ocorrencia');

        // Verifica se a opção selecionada é "Cadastrar nova"
        if (selectOcorrencia.value === 'nova') {
            formNovaOcorrencia.style.display = 'block'; // Mostra o formulário
        } else {
            formNovaOcorrencia.style.display = 'none'; // Esconde o formulário
        }
    }

    function limparForm() {
    // Limpar os campos do select
    document.getElementById('cliente').selectedIndex = 0;
    document.getElementById('ocorrencia').selectedIndex = 0;

    // Ocultar o formulário de nova ocorrência
    document.getElementById('form_nova_ocorrencia').style.display = 'none';
}

</script>


</body>
</html>