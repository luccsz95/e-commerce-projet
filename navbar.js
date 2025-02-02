const productInput = $('#query');
const datalist = $('#data-list');

productInput.on('input', function() {
    const query = productInput.val();

    if (query.length > 0) {
        $.ajax({
            url: 'recup_animals.php',
            method: 'GET',
            dataType: 'json',
            data: {
                search: query
            },
            cache: false,
            success: function (response) {
                datalist.html(response);
                error: function toto (response) {
                    console.error('Erreur de la requête.');
                    console.error('<option value="">Erreur lors de la récupération des suggestions.</option>');
                }
            }
        });
    } else {
    datalist.html('');
}
    });

   /* $(document).ready(function() {
        $('input[name="query"]').on('input', function() {
            var searchInput = $(this).val();

            if (searchInput.length > 0) {
                $.ajax({
                    url: 'recup_animals.php',
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        search: searchInput
                    },
                    success: function(data) {
                        console.log(data); // Debugging: log the response data
                        $('#data-list').empty();
                        $.each(data, function(index, product) {
                            $('#data-list').append(
                                $('<option>', {
                                    value: product.typeAnimals
                                })
                            );
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error: ' + textStatus + ' - ' + errorThrown); // Debugging: log any errors
                    }
                });
            }
        });
    });*/