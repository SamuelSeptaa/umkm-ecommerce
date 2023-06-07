<script>
    let productDetail = new Vue({
        el: '#product-detail',
        data: {
            quantity: 1,
            max: {{ $product->stock }}
        },
        methods: {
            addFavorit: function(product_id) {
                const $button = $(event.target).closest('button');
                $.ajax({
                    type: "post",
                    url: `{{ route('add-favorit') }}`,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    data: {
                        product_id: product_id,
                    },
                    processData: true,
                    beforeSend: function() {
                        showLoading();
                    },
                    success: function(response) {
                        if (!$button.hasClass('active')) {
                            $button.addClass('active');
                            cartAndFavorite.$data.counterFav++;
                        } else {
                            $button.removeClass('active');
                            cartAndFavorite.$data.counterFav--;
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        const statusCode = jqXHR.status;
                        switch (statusCode) {
                            case 401:
                                Swal.fire(
                                    'Gagal',
                                    'Anda harus login untuk menambahkan ke Favorit',
                                    'error'
                                );
                                break;
                            default:
                                Swal.fire(
                                    textStatus,
                                    jqXHR.responseJSON.message,
                                    'error'
                                );
                        }

                    },
                    complete: function() {
                        hideLoading();
                    }
                });
            },
            decreaseQty: function() {
                this.quantity--;
                if (this.quantity < 1)
                    this.quantity = 1;
            },
            increaseQty: function() {
                this.quantity++;
                if (this.quantity > this.max)
                    this.quantity = this.max;
            },
            onlyNumber: function() {
                const regex = /^[1-9]\d*$/;
                let value = this.quantity.toString();
                // Remove any non-digit characters
                value = value.replace(/\D/g, '');
                // Update the input value
                this.quantity = value;

                if (this.quantity > this.max)
                    this.quantity = this.max;

            },
            addToCart: function(product_id) {
                $.ajax({
                    type: "post",
                    url: `{{ route('check-cart') }}`,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    data: {
                        product_id: product_id,
                        qty: this.quantity
                    },
                    processData: true,
                    beforeSend: function() {
                        showLoading();
                    },
                    success: function(response) {
                        alert('success');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        const statusCode = jqXHR.status;
                        switch (statusCode) {
                            case 401:
                                Swal.fire(
                                    'Gagal',
                                    'Anda harus login untuk menambahkan ke dalam Keranjang',
                                    'error'
                                );
                                break;
                            case 400:
                                break;
                            default:
                                Swal.fire(
                                    textStatus,
                                    jqXHR.responseJSON.message,
                                    'error'
                                );
                        }

                    },
                    complete: function() {
                        hideLoading();
                    }
                });
            }
        }
    })
</script>
