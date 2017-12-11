/**
 * Created by neil on 10/12/2017.
 */
$(document).ready( function() {
    $('#brewery-beers').on('click', function(e) {
        e.preventDefault();
        var id = $(this).closest('a').data('id');
        var success = function( resp ) {
            console.log(resp);
            $('#more-beers').html(resp);
        };
        var err = function( req, status, err ) {
            console.log(status);
            $('#more-beers').html(status);
        };
        $.ajax({
            type: 'get',
            url: '/brewery/'+id

        }).done(success).fail(err);
    });
});
