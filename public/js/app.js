/**
 * Created by neil on 10/12/2017.
 *
 * Jquery methods to update the search results section with results from the API.
 *
 */

$(document).ready(function () {
    $('#brewery-beers').on('click', function (e) {
        e.preventDefault();
        // get the brewery id from the data attribute
        var id = $(this).closest('a').data('id');
        // run this code if we get a successful response
        var success = function (resp) {
            console.log(resp);
            // fill our div with the response
            $('#searchResults').html(resp);
            // clear any errors or inputs still lingering
            $('#search-form').trigger('reset');
            $('#error').html('');
        };
        var err = function (req, status, err) {
            console.log(status);
            $('#searchResults').html(status);
        };
        $.ajax({
            type: 'get',
            url: '/brewery/' + id

        }).done(success).fail(err);
    });

    $('#search-form').submit(function (e) {
            e.preventDefault();
            var formSerialize = $(this).serialize();
            var success = function (resp, status, jqXHR) {
                console.log(jqXHR);
                if (jqXHR.status == 200) {
                    $('#searchResults').html(resp);
                    $('#error').html('');
                }
            };
            var err = function (req, status, err) {
                console.log(status);
            };
            $.ajax({
                type: $(this).attr('method'),
                url: '/search',
                data: formSerialize,
                statusCode: {
                    400: function () {
                        $('#error').html('Thats not a valid input. Please try again');
                        $('#search-form').trigger('reset')
                    }
                }
            }).done(success).fail(err)
        }
    );
});
