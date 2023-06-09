<script>
    let cart = new Vue({
        el: '#cart-el',
        data: {
            totalIdr: currencyIDR({{ $cart_total }})
        },
        methods: {
            decreaseQty: function() {
                const $input = $(event.target).closest('.pro-qty').find('input');
                $input.val($input.val() - 1);
                if ($input.val() < 1)
                    $input.val(1);
                this.updatePrice($input);

            },
            increaseQty: function() {
                const $input = $(event.target).closest('.pro-qty').find('input');
                $input.val(parseInt($input.val()) + 1);
                if (parseInt($input.val()) > parseInt($input.data("maxqty")))
                    $input.val($input.data("maxqty"));
                this.updatePrice($input);

            },
            onlyNumber: function() {
                const $input = $(event.target);
                const regex = /^[1-9]\d*$/;
                let value = $input.val().toString();


                // Remove any non-digit characters
                value = value.replace(/\D/g, '');
                // Update the input value

                if (value == '')
                    $input.val(1);
                else
                    $input.val(value);
                if (parseInt($input.val()) > parseInt($input.data("maxqty")))
                    $input.val($input.data("maxqty"));

                $input.trigger('change')
                this.updatePrice($input);

            },
            updatePrice: function($input) {
                const price = parseFloat($input.data("price"));
                const qty = $input.val();
                const total = price * qty;
                $input.closest("tr").find(".shoping__cart__total").html(currencyIDR(total));
            },
            removeItem: function() {
                cartAndFavorite.$data.counterCart--;
                $(event.target).closest('tr').remove();
            }
        }
    });

    $(document).on('click', '#update-cart', function() {
        const formData = new FormData($("#cart-form")[0]);

        $.ajax({
            url: "{{ route('update-cart') }}",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                showLoading();
            },
            success: function(response) {
                const data = response;
                cart.$data.totalIdr = currencyIDR(response.data.total);
                Swal.fire(
                    response.status,
                    response.message,
                    'success'
                );

                if (response.data.total === 0)
                    window.location.reload()
            },
            error: function(xhr, status, error) {
                console.log(xhr);
                console.log(status);
                console.log(error);
                Swal.fire(
                    "Failed",
                    xhr.responseJSON.message,
                    'error'
                );
            },
            complete: function() {
                hideLoading()
            }
        });
    })
</script>
