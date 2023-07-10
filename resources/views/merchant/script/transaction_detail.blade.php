<script>
    $(document).on('click', '#request-pickup', function() {
        const id = {{ $transaction->id }};
        $.ajax({
            type: "post",
            url: `{{ route('request-pickup') }}`,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                id: id,
            },
            processData: true,
            beforeSend: function() {
                showLoading();
            },
            success: function(response) {
                Swal.fire(
                    response.status,
                    response.message,
                    'success'
                ).then((result) => {
                    location.reload();
                })
            },
            error: function(jqXHR, textStatus, errorThrown) {
                const response = jqXHR.responseJSON;
                Swal.fire(
                    response.status,
                    response.message,
                    'error'
                );
            },
            complete: function() {
                hideLoading();
            }
        });
    });
</script>
