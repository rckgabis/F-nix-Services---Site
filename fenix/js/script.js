document.querySelector('.login-btn').addEventListener('click', function() {
    var email = document.querySelector('input[type="email"]').value;
    var senha = document.querySelector('input[type="password"]').value;
    
    // Aqui você pode adicionar a lógica para verificar as credenciais, por exemplo, enviando-as para um servidor.
    // Neste exemplo, apenas exibiremos as credenciais no console.
    console.log('Email:', email);
    console.log('Senha:', senha);
});

// Adiciona o evento de clique no input de email
document.getElementById('emailInput').addEventListener('click', function() {
    // Remove o texto de placeholder quando o input é clicado
    this.placeholder = '';
});

// Adiciona o evento de clique no input de senha
document.getElementById('passwordInput').addEventListener('click', function() {
    // Remove o texto de placeholder quando o input é clicado
    this.placeholder = '';
});

// Adiciona o evento de clique em qualquer lugar da tela
window.addEventListener('click', function(event) {
    // Verifica se o clique ocorreu fora do input de email e se o input está vazio
    if (event.target.id !== 'emailInput' && document.getElementById('emailInput').value === '') {
        // Adiciona o texto de placeholder de volta ao input de email
        document.getElementById('emailInput').placeholder = 'INSIRA SEU E-MAIL';
    }

    // Verifica se o clique ocorreu fora do input de senha e se o input está vazio
    if (event.target.id !== 'passwordInput' && document.getElementById('passwordInput').value === '') {
        // Adiciona o texto de placeholder de volta ao input de senha
        document.getElementById('passwordInput').placeholder = 'INSIRA SUA SENHA';
    }
});
