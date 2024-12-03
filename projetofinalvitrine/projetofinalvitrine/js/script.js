document.addEventListener('DOMContentLoaded', (event) => {
    const deleteLinks = document.querySelectorAll('.excluir');
    deleteLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            const confirmation = confirm('Você realmente deseja excluir este registro?');
            if (!confirmation) {
                event.preventDefault(); // Impede o redirecionamento
            }
        });
    });
});