$( document ).ready( function() {

    $('.-random').on('click', function(e) {
        e.preventDefault();

        var $self = $(this);

        $self.attr('disabled', true);

        $.post("/index.php?r=post/lottery", function() {})
        .done(function(data) {
            console.log(data);
            alert( "success" );
        })
        .fail(function() {
            alert( "error" );
        })
        .always(function() {
            $self.attr('disabled', false);
        });

    });

});