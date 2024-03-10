<?php
session_start();
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    // Evitar injeção de SQL
    $login = mysqli_real_escape_string($conexao, $login);
    $senha = mysqli_real_escape_string($conexao, $senha);

    $query = "SELECT * FROM usuario WHERE usuario = '$login' AND senha = '$senha'";
    $result = mysqli_query($conexao, $query);

    if (mysqli_num_rows($result) == 1) {
        $login = mysqli_fetch_assoc($result);
        $_SESSION['usuario_id'] = $login['id'];
        $_SESSION['usuario_nome'] = $login['nome'];
        $_SESSION['nivel_acesso'] = $login['nivel_acesso'];

        header('Location: dashboard.php');
        exit();
    } else {
        echo "<h1>Login falhou. Verifique suas credenciais.</h1>";
    }
}
?>
