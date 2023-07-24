<script>
    let index = new Vue({
        el: '#product-featured-list',
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
            }
        }
    })
</script>
