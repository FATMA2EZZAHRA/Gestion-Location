document.addEventListener('DOMContentLoaded', function () {
    // Confirmation avant suppression
    const deleteButtons = document.querySelectorAll('button[type="submit"]');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            const confirmDelete = confirm("Êtes-vous sûr de vouloir supprimer cet élément ?");
            if (!confirmDelete) {
                event.preventDefault();
            }
        });
    });

    // Formulaire de recherche (optionnel, selon votre besoin)
    const searchInput = document.getElementById('search');
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const searchQuery = searchInput.value.toLowerCase();
            const rows = document.querySelectorAll('table tbody tr');
            rows.forEach(row => {
                const cells = row.getElementsByTagName('td');
                let match = false;
                for (let cell of cells) {
                    if (cell.textContent.toLowerCase().includes(searchQuery)) {
                        match = true;
                        break;
                    }
                }
                row.style.display = match ? '' : 'none';
            });
        });
    }
});
