<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.html');
    exit();
}

include('../php/conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber os dados do formulário
    $cliente_id = $_POST['idCliente'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $tipo = $_POST['residencia'];
    $cep = $_POST['cep'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $ponto_referencia = $_POST['referencia'];
    $nome_contato1 = $_POST['nome_contato1'];
    $parentesco_contato1 = $_POST['parentesco_contato1'];
    $numero_contato1 = $_POST['numero_contato1'];
    $nome_contato2 = $_POST['nome_contato2'];
    $parentesco_contato2 = $_POST['parentesco_contato2'];
    $numero_contato2 = $_POST['numero_contato2'];
    $nome_contato3 = $_POST['nome_contato3'];
    $parentesco_contato3 = $_POST['parentesco_contato3'];
    $numero_contato3 = $_POST['numero_contato3'];

    // Query para atualizar os dados
    $query = "UPDATE clientes SET 
              nome='$nome', 
              cpf='$cpf', 
              rg='$rg', 
              email='$email', 
              telefone='$telefone', 
              tipo='$tipo', 
              CEP='$cep', 
              rua='$rua', 
              num='$numero', 
              bairro='$bairro', 
              cidade='$cidade', 
              estado='$estado', 
              pont_ref='$ponto_referencia', 
              nome_contato1='$nome_contato1', 
              parentesco_contato1='$parentesco_contato1', 
              numero_contato1='$numero_contato1', 
              nome_contato2='$nome_contato2', 
              parentesco_contato2='$parentesco_contato2', 
              numero_contato2='$numero_contato2', 
              nome_contato3='$nome_contato3', 
              parentesco_contato3='$parentesco_contato3', 
              numero_contato3='$numero_contato3' 
              WHERE id='$cliente_id'";

    if (mysqli_query($conexao, $query)) {
        // Redirecionar para a página de clientes com um parâmetro indicando sucesso
        header('Location: ../screens/editar_clientes.php?success=true');
        exit();        
    } else {
        echo "Erro ao atualizar os dados: " . mysqli_error($conexao);
    }

}

?>
