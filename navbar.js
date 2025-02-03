const productInput = $('#query');
const datalist = $('#data-list');

productInput.on('input', function() {
    const query = productInput.val();

    if (query.length > 0) {
        $.ajax({
            url: 'recup_animals.php',
            method: 'GET',
            dataType: 'json',
            data: { search: query },
            cache: false,
            success: function(response) {
                datalist.empty(); // Nettoyer avant d'ajouter les nouvelles options
                if (response.length > 0) {
                    response.forEach(function(item) {
                        datalist.append(`<option value="${item.typeAnimals}"></option>`);
                    });
                } else {
                    datalist.append('<option value="">Aucun résultat</option>');
                }
            },
            error: function() {
                console.error('Erreur de la requête AJAX.');
            }
        });
    } else {
        datalist.empty();
    }
});
