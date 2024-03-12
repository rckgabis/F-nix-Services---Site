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
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $tipo = $_POST['residencia'];
    $cep = $_POST['cep'];
    $rua = $_POST['rua'];
    $num = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $pont_ref = $_POST['referencia'];

    // Novos campos adicionados
    $nome_contato1 = $_POST['nome_contato1'];
    $parentesco_contato1 = $_POST['parentesco_contato1'];
    $numero_contato1 = $_POST['numero_contato1'];
    $nome_contato2 = $_POST['nome_contato2'];
    $parentesco_contato2 = $_POST['parentesco_contato2'];
    $numero_contato2 = $_POST['numero_contato2'];
    $nome_contato3 = $_POST['nome_contato3'];
    $parentesco_contato3 = $_POST['parentesco_contato3'];
    $numero_contato3 = $_POST['numero_contato3'];

    // Inserir os dados no banco de dados
    $query = "INSERT INTO clientes (nome, cpf, rg, email, telefone, tipo, CEP, rua, num, bairro, cidade, estado, pont_ref, nome_contato1, parentesco_contato1, numero_contato1, nome_contato2, parentesco_contato2, numero_contato2, nome_contato3, parentesco_contato3, numero_contato3) VALUES ('$nome', '$cpf', '$rg', '$email', '$telefone', '$tipo', '$cep', '$rua', '$num', '$bairro', '$cidade', '$estado', '$pont_ref', '$nome_contato1', '$parentesco_contato1', '$numero_contato1', '$nome_contato2', '$parentesco_contato2', '$numero_contato2', '$nome_contato3', '$parentesco_contato3', '$numero_contato3')";
    $resultado = mysqli_query($conexao, $query);

    // Verifica se a inserção foi bem-sucedida
    if ($resultado) {
        // Define a mensagem na sessão
        $_SESSION['mensagem'] = array(
            'titulo' => 'Sucesso!',
            'texto' => 'Cliente cadastrado com sucesso!',
            'tipo' => 'success'
        );
    } else {
        // Define a mensagem de erro na sessão
        $_SESSION['mensagem'] = array(
            'titulo' => 'Erro!',
            'texto' => 'Erro ao cadastrar o cliente.',
            'tipo' => 'error'
        );
    }

    // Redireciona de volta para a página de cadastro de clientes
    header('Location: cadastrar_clientes.php');
    exit();
} else {
    // Se a requisição não for POST, redireciona de volta para a página de cadastro de clientes
    header('Location: cadastrar_clientes.php');
    exit();
}
