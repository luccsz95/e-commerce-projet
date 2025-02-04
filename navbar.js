const productInput = $('#product');
const datalist = $('#products');

productInput.on('input', function() {
    const query = productInput.val().trim();

    if (query.length > 0) {
        $.ajax({
            url: 'recup_animals.php',
            type: 'GET',
            data: { search_term: query, timestamp: new Date().getTime() },
            dataType: 'html', // Assure que la réponse est du HTML
            cache: false,
            success: function(response) {
                console.log("Réponse AJAX :", response);
                datalist.html(response);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Erreur de la requête.');
                console.error('Statut :', textStatus);
                console.error('Erreur :', errorThrown);
                console.error('Réponse serveur :', jqXHR.responseText);
                datalist.html('<option value="">Erreur lors de la récupération des suggestions.</option>');
            }
        });
    } else {
        datalist.empty();
    }
});
