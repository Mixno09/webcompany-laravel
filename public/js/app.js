(function ($) {
    $(function () {
        $('input[name="orderBy"]').on('click', function () {
            let orderBy = $(this).val();

            console.log(this);
        });

        $('input[name="order"]').on('click', function () {
            let order = $(this).val();

            console.log(order);
        });
    });
})(jQuery);



