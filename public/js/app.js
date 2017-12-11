/**
 * Created by neil on 10/12/2017.
 */
$(document).ready(function () {
    $('#brewery-beers').on('click', function (e) {
        e.preventDefault();
        var id = $(this).closest('a').data('id');
        var success = function (resp) {
            console.log(resp);
            $('#searchResults').html(resp);
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
            var success = function (resp) {
                console.log(resp);
                $('#searchResults').html(resp);
            };
            var err = function (req, status, err) {
                console.log(status);
                $('#formError').html(status);
            };
            $.ajax({
                type: $(this).attr('method'),
                url: '/search',
                data: formSerialize

            }).done(success).fail(err)
        }
    );
});
