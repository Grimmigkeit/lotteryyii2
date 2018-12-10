$( document ).ready( function() {

    $('.-random').on('click', function(e) {
        e.preventDefault();

        var $self = $(this),
            $convert = $('.-convert');

        $self.attr('disabled', true);

        $.post('/index.php?r=post/lottery', function() {})
        .done(function(data) {

            $('.-points').html(data.points);
            $('.-money').html(data.money);
            $('.-prize').html(data.prize);

            if (data.money) {
                $convert.removeClass('hidden');
            } else {
                $convert.addClass('hidden');
            }

        })
        .fail(function() {
            alert('error');
        })
        .always(function() {
            $self.attr('disabled', false);
        });
    });

    $('.-convert').on('click', function(e) {
        e.preventDefault();

        var $self = $(this);

        $self.attr('disabled', true);

        $.post('/index.php?r=post/convert-money', function() {})
        .done(function(data) {

            $('.-points').html(data.points);
            $('.-money').html(data.money);
            $('.-prize').html(data.prize);

            if (data.money) {
                $self.removeClass('hidden');
            } else {
                $self.addClass('hidden');
            }

        })
        .fail(function() {
            alert('error');
        })
        .always(function() {
            $self.attr('disabled', false);
        });
    });

});