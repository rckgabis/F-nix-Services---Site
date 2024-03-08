document.querySelector('.login-btn').addEventListener('click', function() {
    var login = document.getElementById('loginInput').value;
    var senha = document.getElementById('passwordInput').value;
    
    // Cria um objeto XMLHttpRequest
    var xhr = new XMLHttpRequest();
    
    // Configura a solicitação
    xhr.open('POST', 'login.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    // Define a função de retorno de chamada quando a solicitação estiver concluída
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Sucesso: redireciona para o dashboard
                window.location.href = '../php/dashboard.php';
            } else {
                // Falha: exibe mensagem de erro
                alert('Login falhou. Verifique suas credenciais.');
            }
        }
    };
    
    // Envia a solicitação com os dados do formulário
    xhr.send('login=' + encodeURIComponent(login) + '&senha=' + encodeURIComponent(senha));
});

// Adiciona o evento de clique no input de login
document.getElementById('loginInput').addEventListener('click', function() {
    // Remove o texto de placeholder quando o input é clicado
    this.placeholder = '';
});

// Adiciona o evento de clique no input de senha
document.getElementById('passwordInput').addEventListener('click', function() {
    // Remove o texto de placeholder quando o input é clicado
    this.placeholder = '';
});
