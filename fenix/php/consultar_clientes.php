<?php
session_start();
include('conexao.php');

// Verifique se o ID do cliente foi recebido via POST
if(isset($_POST['idCliente'])) {
    $idCliente = $_POST['idCliente'];

    // Consulta SQL para obter os detalhes do cliente com base no ID
    $query = "SELECT id, nome, cpf, rg, email, telefone, tipo, CEP, rua, num, bairro, cidade, estado, pont_ref, nome_contato1, parentesco_contato1, numero_contato1, nome_contato2, parentesco_contato2, numero_contato2, nome_contato3, parentesco_contato3, numero_contato3 FROM clientes WHERE id = $idCliente";
    $resultado = mysqli_query($conexao, $query);

    if($resultado) {
        // Verifique se o cliente foi encontrado
        if(mysqli_num_rows($resultado) > 0) {
            // Extrair os dados do cliente
            $cliente = mysqli_fetch_assoc($resultado);
            // Retorne os detalhes do cliente como JSON
            echo json_encode($cliente);
        } else {
            // Se o cliente não foi encontrado, retorne uma resposta vazia
            echo json_encode(array());
        }
    } else {
        // Se houver um erro na consulta, retorne uma mensagem de erro
        echo "Erro ao executar a consulta: " . mysqli_error($conexao);
    }
} else {
    // Se o ID do cliente não foi recebido, retorne uma mensagem de erro
    echo "ID do cliente não foi recebido.";
}
?>
