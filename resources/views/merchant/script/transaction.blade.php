<script>
    $(document).ready(function() {
        let filterValue = [];

        var table = $("#the-table").DataTable({
            pageLength: 30,
            scrollX: true,
            processing: true,
            serverSide: true,
            order: [],
            ajax: {
                url: `{{ route('show-transaction') }}`,
                type: "POST",
                data: function(d) {
                    d.filterValue = JSON.stringify(filterValue)
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
                    data: 'receipt_number',
                    name: 'receipt_number',
                },
                {
                    data: 'receiver',
                    name: 'receiver',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    searchable: false
                },
                {
                    data: 'total',
                    name: 'total',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'statusbadge',
                    name: 'statusbadge',
                    orderable: false,
                },
                {
                    data: 'paymentstatusbadge',
                    name: 'paymentstatusbadge',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'paid_date',
                    name: 'paid_date',
                    searchable: false
                },
                {
                    data: 'shipping_method',
                    name: 'shipping_method',
                    searchable: false
                },
            ],
            order: [
                [1, 'desc']
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

        function resetFilterStatus() {
            filterValue = []
            toggleFilterStatus(".btn-filter", false)
            toggleFilterStatus(".btn-filter[data-block_id='all']", true)
            // table.column(10).search(JSON.stringify(filterValue))
        }

        function toggleFilterStatus(selector, status) {
            if (status) {
                $(selector).addClass("active");
            } else {
                $(selector).removeClass("active");
            }
        }

        $(".btn-filter").click(function(e) {
            e.preventDefault();
            let value = $(this).data('status');
            if (value == "ALL") {
                resetFilterStatus()
            } else {
                toggleFilterStatus(".btn-filter[data-status='ALL']", false)
                let filterExist = filterValue.includes(value)
                if (!filterExist) {
                    toggleFilterStatus(this, true)
                    filterValue.push(value);
                } else {
                    toggleFilterStatus(this, false)
                    let index = filterValue.indexOf(value);
                    if (index !== -1) {
                        filterValue.splice(index, 1);
                    }
                }
            }

            if (filterValue.length == 0 || filterValue.length == $('.btn-filter').length - 1) {
                resetFilterStatus();
                toggleFilterStatus(".btn-filter[data-status='ALL']", true)
            }
            table.ajax.reload();

            console.log(filterValue)

        });
    })
</script>
