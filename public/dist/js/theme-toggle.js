document.addEventListener('DOMContentLoaded', (event) => {
    const toggleButton = document.getElementById('theme-toggle');
    const themeIcon = document.getElementById('theme-icon');
    const themeText = document.getElementById('theme-text');
    const body = document.body;

    // Função para atualizar o ícone e texto
    const updateTheme = () => {
        if (body.classList.contains('dark-mode')) {
            themeIcon.classList.remove('fa-moon', 'text-primary');
            themeIcon.classList.add('fa-sun', 'text-warning');
            themeText.textContent = 'Ativar modo claro';
        } else {
            themeIcon.classList.remove('fa-sun', 'text-warning');
            themeIcon.classList.add('fa-moon', 'text-primary');
            themeText.textContent = 'Ativar modo escuro';
        }
    };

    // Verifique a preferência armazenada no localStorage
    if (localStorage.getItem('dark-mode') === 'true') {
        body.classList.add('dark-mode');
        updateTheme();
    }

    // Adicione o evento de clique ao botão de alternância
    toggleButton.addEventListener('click', () => {
        body.classList.toggle('dark-mode');
        updateTheme();
        
        // Armazene a preferência no localStorage
        if (body.classList.contains('dark-mode')) {
            localStorage.setItem('dark-mode', 'true');
        } else {
            localStorage.setItem('dark-mode', 'false');
        }
    });
});
