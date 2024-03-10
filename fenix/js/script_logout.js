document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.logout').addEventListener('click', function(event) {
        event.preventDefault(); // Evita que o link execute a ação padrão de redirecionamento

        // Exibe o popup de confirmação
        var popup = document.createElement('div');
        popup.classList.add('popup-container');
        popup.innerHTML = `
            <div class="popup-message">Tem certeza que deseja sair?</div>
            <div class="popup-buttons">
                <button onclick="logout()">Sim</button>
                <button class="cancel" onclick="cancelLogout()">Cancelar</button>
            </div>
        `;
        document.body.appendChild(popup);
    });
});

function logout() {
    // Substitua esta função pela lógica de logout adequada
    console.log('Realizando logout...');
    closePopup();
}

function cancelLogout() {
    console.log('Cancelou o logout.');
    closePopup();
}

function closePopup() {
    var popup = document.querySelector('.popup-container');
    if (popup) {
        popup.parentNode.removeChild(popup);
    }
}
