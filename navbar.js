$(document).ready(function() {
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
});