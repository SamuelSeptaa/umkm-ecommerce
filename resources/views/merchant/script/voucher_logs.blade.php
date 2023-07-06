<script>
    $(document).ready(function() {
        var table = $("#the-table").DataTable({
            pageLength: 30,
            scrollX: true,
            processing: true,
            serverSide: true,
            order: [],
            ajax: {
                url: `{{ route('show-voucher-log') }}`,
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            columns: [{
                    data: 'code',
                    name: 'code',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'receipt_number',
                    name: 'receipt_number',
                    orderable: true,
                    searchable: false
                },
                {
                    data: 'discount',
                    name: 'discount',
                    searchable: false,
                    orderable: false,
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    orderable: true,
                    searchable: false
                }
            ],
            order: [
                [3, 'desc']
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
    })
</script>
