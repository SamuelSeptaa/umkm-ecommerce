<script>
    $(document).ready(function() {
        let filterValue = [];
        let startDate = null;
        let endDate = null;

        const defaultStartDate = moment().subtract(29, 'days');
        const defaultEndDate = moment();

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
                    d.filterValue = JSON.stringify(filterValue);
                    d.search = $("#search-column").val();
                    d.startDate = startDate;
                    d.endDate = endDate;
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
            },
            "language": {
                "lengthMenu": "Menampilkan _MENU_ data per halaman",
                "zeroRecords": "Data tidak ditemukan - maaf",
                "info": "Menampilkan halaman _PAGE_ dari total _PAGES_ halaman",
                "infoEmpty": "Tidak ada data tersedia",
                "infoFiltered": "(Disaring dari _MAX_ total data)"
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

        function getDefaultStartDate() {
            return defaultStartDate.clone();
        }

        function getDefaultEndDate() {
            return defaultEndDate.clone();
        }

        $("#daterangepicker").daterangepicker({
            autoUpdateInput: false,
            startDate: getDefaultStartDate(),
            endDate: getDefaultEndDate(),
            locale: {
                cancelLabel: "Clear",
                format: 'DD-MM-YYYY'
            },
        });

        function filterDateRange(start, end) {
            startDate = start;
            endDate = end;
            if (start && end) {
                startDate = start.format('YYYY-MM-DD');
                endDate = end.format('YYYY-MM-DD');
            }

            table.ajax.reload();
        }

        $("#daterangepicker").on("apply.daterangepicker", function(ev, picker) {
            $(this).val(
                picker.startDate.format("DD-MM-YYYY") +
                " s/d " +
                picker.endDate.format("DD-MM-YYYY")
            );

            filterDateRange(picker.startDate, picker.endDate);
        });

        $("#daterangepicker").on("cancel.daterangepicker", function(ev, picker) {
            filterDateRange(null, null);
            $(this).val("");
        });

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
