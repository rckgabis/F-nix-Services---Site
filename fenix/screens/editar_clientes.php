<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.html');
    exit();
}

include('../php/conexao.php');


if (isset($_GET['id'])) {
    $cliente_id = $_GET['id'];

    $query = "SELECT * FROM clientes WHERE id = $cliente_id";
    $result = mysqli_query($conexao, $query);

    if (mysqli_num_rows($result) == 1) {
        $cliente = mysqli_fetch_assoc($result);
        $nome = $cliente['nome'];
        $cpf = $cliente['cpf'];
        $rg = $cliente['rg'];
        $email = $cliente['email'];
        $telefone = $cliente['telefone'];
        $tipo = $cliente['tipo'];
        $cep = $cliente['CEP'];
        $rua = $cliente['rua'];
        $numero = $cliente['num']; // corrigido para número
        $bairro = $cliente['bairro'];
        $cidade = $cliente['cidade'];
        $estado = $cliente['estado'];
        $ponto_referencia = $cliente['pont_ref']; // corrigido para ponto_referencia
        $nome_contato1 = $cliente['nome_contato1'];
        $parentesco_contato1 = $cliente['parentesco_contato1'];
        $numero_contato1 = $cliente['numero_contato1'];
        $nome_contato2 = $cliente['nome_contato2'];
        $parentesco_contato2 = $cliente['parentesco_contato2'];
        $numero_contato2 = $cliente['numero_contato2'];
        $nome_contato3 = $cliente['nome_contato3'];
        $parentesco_contato3 = $cliente['parentesco_contato3'];
        $numero_contato3 = $cliente['numero_contato3'];
    } else {
        header('Location: index_clientes.php');
        exit();
    }
} else {
    header('Location: index_clientes.php');
    exit();
}
?>

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
    <a href="index_clientes.php" class="icon-link">
        <i class="ph ph-caret-double-left"></i>
    </a>

    <h2>EDITAR CLIENTE</h2>

    <form action="../php/atualizar_clientes.php" method="POST" id="updateForm">
        <input type="hidden" name="idCliente" value="<?php echo $cliente_id; ?>">
        
        <label for="nome">NOME:</label>
        <input type="text" id="nome" name="nome" required placeholder="INSIRA O NOME COMPLETO" value="<?php echo $nome; ?>"><br>

        <div class="grid-container">
            <div>
                <label for="cpf">CPF/CNPJ:</label>
                <input type="text" id="cpf" name="cpf" required placeholder="INSIRA O CPF" value="<?php echo $cpf; ?>">
            </div>
            <div>
                <label for="rg">RG:</label>
                <input type="text" id="rg" name="rg" required placeholder="INSIRA O RG" value="<?php echo $rg; ?>">
            </div>
        </div>

        <div class="grid-container">
            <div>
                <label for="email">E-MAIL:</label>
                <input type="email" id="email" name="email" required placeholder="INSIRA O E-MAIL" value="<?php echo $email; ?>">
            </div>
            <div>
                <label for="telefone">TELEFONE:</label>
                <input type="tel" id="telefone" name="telefone" required placeholder="INSIRA O TELEFONE" value="<?php echo $telefone; ?>">
            </div>
        </div>

        <div class="grid-container">
            <div>
                <label for="residencia">TIPO:</label>
                <select id="residencia" name="residencia" required>
                    <option value="residencial" <?php if ($tipo === 'residencial') echo 'selected'; ?>>RESIDENCIAL</option>
                    <option value="comercial" <?php if ($tipo === 'comercial') echo 'selected'; ?>>COMERCIAL</option>
                </select>
            </div>
            <div>
                <label for="cep">CEP:</label>
                <input type="text" id="cep" name="cep" required placeholder="INSIRA O CEP" value="<?php echo $cep; ?>">
            </div>
        </div>

        <div class="grid-container">
            <div>
                <label for="rua">RUA:</label>
                <input type="text" id="rua" name="rua" required placeholder="INSIRA O NOME DA RUA" value="<?php echo $rua; ?>">
            </div>

            <div>
                <label for="numero">N°:</label>
                <input type="text" id="numero" name="numero" required placeholder="INSIRA O NÚMERO" value="<?php echo $numero; ?>">
            </div>
        </div>

        <div class="grid-container">
            <div>
                <label for="bairro">BAIRRO:</label>
                <input type="text" id="bairro" name="bairro" required placeholder="INSIRA O BAIRRO" value="<?php echo $bairro; ?>">
            </div>
            <div>
                <label for="cidade">CIDADE:</label>
                <input type="text" id="cidade" name="cidade" required placeholder="INSIRA A CIDADE" value="<?php echo $cidade; ?>">
            </div>
        </div>

        <div class="grid-container">
            <div>
                <label for="estado">ESTADO:</label>
                <select id="estado" name="estado" required>
                    <option value="" disabled selected hidden>Selecione o Estado</option>
                    <option value="AC" <?php if ($estado === 'AC') echo 'selected'; ?>>AC - Acre</option>
                    <option value="AL" <?php if ($estado === 'AL') echo 'selected'; ?>>AL - Alagoas</option>
                    <option value="AP" <?php if ($estado === 'AP') echo 'selected'; ?>>AP - Amapá</option>
                    <option value="AM" <?php if ($estado === 'AM') echo 'selected'; ?>>AM - Amazonas</option>
                    <option value="BA" <?php if ($estado === 'BA') echo 'selected'; ?>>BA - Bahia</option>
                    <option value="CE" <?php if ($estado === 'CE') echo 'selected'; ?>>CE - Ceará</option>
                    <option value="DF" <?php if ($estado === 'DF') echo 'selected'; ?>>DF - Distrito Federal</option>
                    <option value="ES" <?php if ($estado === 'ES') echo 'selected'; ?>>ES - Espírito Santo</option>
                    <option value="GO" <?php if ($estado === 'GO') echo 'selected'; ?>>GO - Goiás</option>
                    <option value="MA" <?php if ($estado === 'MA') echo 'selected'; ?>>MA - Maranhão</option>
                    <option value="MT" <?php if ($estado === 'MT') echo 'selected'; ?>>MT - Mato Grosso</option>
                    <option value="MS" <?php if ($estado === 'MS') echo 'selected'; ?>>MS - Mato Grosso do Sul</option>
                    <option value="MG" <?php if ($estado === 'MG') echo 'selected'; ?>>MG - Minas Gerais</option>
                    <option value="PA" <?php if ($estado === 'PA') echo 'selected'; ?>>PA - Pará</option>
                    <option value="PB" <?php if ($estado === 'PB') echo 'selected'; ?>>PB - Paraíba</option>
                    <option value="PR" <?php if ($estado === 'PR') echo 'selected'; ?>>PR - Paraná</option>
                    <option value="PE" <?php if ($estado === 'PE') echo 'selected'; ?>>PE - Pernambuco</option>
                    <option value="PI" <?php if ($estado === 'PI') echo 'selected'; ?>>PI - Piauí</option>
                    <option value="RJ" <?php if ($estado === 'RJ') echo 'selected'; ?>>RJ - Rio de Janeiro</option>
                    <option value="RN" <?php if ($estado === 'RN') echo 'selected'; ?>>RN - Rio Grande do Norte</option>
                    <option value="RS" <?php if ($estado === 'RS') echo 'selected'; ?>>RS - Rio Grande do Sul</option>
                    <option value="RO" <?php if ($estado === 'RO') echo 'selected'; ?>>RO - Rondônia</option>
                    <option value="RR" <?php if ($estado === 'RR') echo 'selected'; ?>>RR - Roraima</option>
                    <option value="SC" <?php if ($estado === 'SC') echo 'selected'; ?>>SC - Santa Catarina</option>
                    <option value="SP" <?php if ($estado === 'SP') echo 'selected'; ?>>SP - São Paulo</option>
                    <option value="SE" <?php if ($estado === 'SE') echo 'selected'; ?>>SE - Sergipe</option>
                    <option value="TO" <?php if ($estado === 'TO') echo 'selected'; ?>>TO - Tocantins</option>
                </select>

            </div>

            <div>
                <label for="referencia">PONTO DE REFERÊNCIA:</label>
                <input type="text" id="referencia" name="referencia" required placeholder="INSIRA O PONTO DE REFERÊNCIA" value="<?php echo $ponto_referencia; ?>"><br>
            </div>
        </div>

        <div class="grid-container3">
            <div>
                <label for="nome_contato1">NOME 1:</label>
                <input type="text" id="nome_contato1" name="nome_contato1" required placeholder="INSIRA O NOME" value="<?php echo $nome_contato1; ?>">

                <label for="nome_contato2">NOME 2:</label>
                <input type="text" id="nome_contato2" name="nome_contato2" required placeholder="INSIRA O NOME" value="<?php echo $nome_contato2; ?>">

                <label for="nome_contato3">NOME 3:</label>
                <input type="text" id="nome_contato3" name="nome_contato3" required placeholder="INSIRA O NOME" value="<?php echo $nome_contato3; ?>">
            </div>
            <div>
                <label for="parentesco_contato1">PARENTESCO 1:</label>
                <select id="parentesco_contato1" name="parentesco_contato1" required>
                    <option value="Pai" <?php if ($parentesco_contato1 === 'Pai') echo 'selected'; ?>>Pai</option>
                    <option value="Mãe" <?php if ($parentesco_contato1 === 'Mãe') echo 'selected'; ?>>Mãe</option>
                    <!-- Adicione as outras opções de parentesco conforme necessário -->
                </select>
            </div>
            <div>
                <label for="parentesco_contato2">PARENTESCO 2:</label>
                <select id="parentesco_contato2" name="parentesco_contato2" required>
                    <option value="Pai" <?php if ($parentesco_contato2 === 'Pai') echo 'selected'; ?>>Pai</option>
                    <option value="Mãe" <?php if ($parentesco_contato2 === 'Mãe') echo 'selected'; ?>>Mãe</option>
                    <!-- Adicione as outras opções de parentesco conforme necessário -->
                </select>
            </div>
            <div>
                <label for="parentesco_contato3">PARENTESCO 3:</label>
                <select id="parentesco_contato3" name="parentesco_contato3" required>
                    <option value="Pai" <?php if ($parentesco_contato3 === 'Pai') echo 'selected'; ?>>Pai</option>
                    <option value="Mãe" <?php if ($parentesco_contato3 === 'Mãe') echo 'selected'; ?>>Mãe</option>
                    <!-- Adicione as outras opções de parentesco conforme necessário -->
                </select>
            </div>
            <div>
                <label for="numero_contato1">NÚMERO TELEFONE 1:</label>
                <input type="tel" id="numero_contato1" name="numero_contato1" required placeholder="INSIRA O NÚMERO DE TELEFONE" value="<?php echo $numero_contato1; ?>">

                <label for="numero_contato2">NÚMERO TELEFONE 2:</label>
                <input type="tel" id="numero_contato2" name="numero_contato2" required placeholder="INSIRA O NÚMERO DE TELEFONE" value="<?php echo $numero_contato2; ?>">

                <label for="numero_contato3">NÚMERO TELEFONE 3:</label>
                <input type="tel" id="numero_contato3" name="numero_contato3" required placeholder="INSIRA O NÚMERO DE TELEFONE" value="<?php echo $numero_contato3; ?>">
            </div>
        </div>

        <!-- Botão de enviar -->
        <button type="submit">ATUALIZAR DADOS</button>
    </form>
</div>

<script>

        // Verificar se há um parâmetro na URL indicando sucesso
        if (window.location.search.includes('success=true')) {
        // Exibir o pop-up de sucesso
        showSuccessPopup();
    }
    // Função para exibir o pop-up de sucesso após a atualização
    function showSuccessPopup() {
        Swal.fire({
                title: 'Sucesso!',
                text: 'Dados atualizados com sucesso!',
                icon: 'success',
                showCancelButton: true,
                confirmButtonText: 'CONSULTAR',
                cancelButtonText: 'EDITAR OUTRO',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redireciona para a página de consulta de clientes
                    window.location.href = 'index_clientes.php';
                } else {
                    // Redireciona para a página de cadastro de clientes
                    window.location.href = 'editar_clientes.php';
                }
            });
    }

    // Capturar o envio do formulário e exibir o pop-up de sucesso
    $('#updateForm').submit(function(e) {
        e.preventDefault(); // Impedir o envio do formulário padrão
        // Submeter o formulário via AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(response) {
                showSuccessPopup(); // Exibir o pop-up de sucesso
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); // Exibir erro no console
            }
        });
    });
</script>

</body>
</html>
