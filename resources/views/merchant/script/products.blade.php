<script>
    function togleStatus(id, status) {
        let textAlert = '';
        if (status == "PUBLISH")
            textAlert = 'Draft';
        else
            textAlert = 'Publish';

        Swal.fire({
            icon: "question",
            title: `${textAlert} produk yang dipilih?`,
            showCancelButton: true,
            cancelButtonText: "Batal",
            confirmButtonText: "Ya",
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                showLoading();
                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: "{{ route('toggle-status-product') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: id,
                    },
                    beforeSend: function() {
                        showLoading();
                    },
                    complete: function() {
                        hideLoading();
                    },
                    success: function(response) {
                        Swal.fire({
                            confirmButtonColor: "#3ab50d",
                            icon: "success",
                            title: `${response.message}`,
                        }).then((result) => {
                            $("#the-table").DataTable().ajax.reload();
                        });
                    },
                    error: function(request, status, error) {
                        Swal.fire({
                            confirmButtonColor: "#3ab50d",
                            icon: "error",
                            title: `${status}`,
                            text: `${error}`,
                        });
                    },
                });
            }
        });
    }
    $(document).ready(function() {
        var table = $("#the-table").DataTable({
            pageLength: 30,
            scrollX: true,
            processing: true,
            serverSide: true,
            order: [],
            ajax: {
                url: `{{ route('show-product') }}`,
                type: "POST",
                data: function(d) {
                    d.search = $("#search-column").val()
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            columns: [{
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'image',
                    name: 'image',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'product_name',
                    name: 'product_name',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'discount',
                    name: 'discount'
                },
                {
                    data: 'stock',
                    name: 'stock'
                },
                {
                    data: 'total_sold',
                    name: 'total_sold'
                },
                {
                    data: 'statusbadge',
                    name: 'statusbadge',
                    orderable: false,
                    searchable: false
                },
            ],
            dom: "rtip",
            createdRow: function(row, data, dataIndex) {
                $('td', row).css('vertical-align', 'middle');
            }
        });

        table.on("processing.dt", function(e, settings, processing) {
            if (processing) {
                showLoading();
            } else {
                hideLoading();
            }
        });

        $('#the-table').on('page.dt', function() {
            $('html, body').animate({
                scrollTop: 0
            }, 500);
        });

        $("#search-column").keyup(
            debounce(function() {
                table.ajax.reload();
            }, 1200)
        );
    })
</script>
