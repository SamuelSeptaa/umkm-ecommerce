<script>
    $(document).ready(function() {

        var table = $("#the-table").DataTable({
            pageLength: 30,
            scrollX: true,
            processing: true,
            serverSide: true,
            order: [],
            ajax: {
                url: `{{ route('show-laporan-penjualan') }}`,
                type: "POST",
                data: function(d) {
                    d.year = $("#yearpicker").val()
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            columns: [
                @role('admin')
                    {
                        data: 'shop_name',
                        name: 'shop_name',
                        orderable: false,
                        searchable: false
                    },
                @endrole {
                    data: 'tahun',
                    name: 'tahun',
                    orderable: true,
                    searchable: false
                },
                {
                    data: 'jan',
                    name: 'jan',
                    orderable: false,
                    searchable: false,
                    className: "text-center",
                },
                {
                    data: 'feb',
                    name: 'feb',
                    orderable: false,
                    searchable: false,
                    className: "text-center",
                },
                {
                    data: 'mar',
                    name: 'mar',
                    orderable: false,
                    searchable: false,
                    className: "text-center",
                },
                {
                    data: 'apr',
                    name: 'apr',
                    orderable: false,
                    searchable: false,
                    className: "text-center",
                },
                {
                    data: 'mei',
                    name: 'mei',
                    orderable: false,
                    searchable: false,
                    className: "text-center",
                },
                {
                    data: 'jun',
                    name: 'jun',
                    orderable: false,
                    searchable: false,
                    className: "text-center",
                },
                {
                    data: 'jul',
                    name: 'jul',
                    orderable: false,
                    searchable: false,
                    className: "text-center",
                },
                {
                    data: 'agt',
                    name: 'agt',
                    orderable: false,
                    searchable: false,
                    className: "text-center",
                },
                {
                    data: 'sep',
                    name: 'sep',
                    orderable: false,
                    searchable: false,
                    className: "text-center",
                },
                {
                    data: 'okt',
                    name: 'okt',
                    orderable: false,
                    searchable: false,
                    className: "text-center",
                },
                {
                    data: 'nov',
                    name: 'nov',
                    orderable: false,
                    searchable: false,
                    className: "text-center",
                },
                {
                    data: 'des',
                    name: 'des',
                    orderable: false,
                    searchable: false,
                    className: "text-center",
                },

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

        $("#yearpicker").keyup(
            debounce(function() {
                table.ajax.reload();
            }, 1200)
        );

        $("#yearpicker").datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years",
            autoclose: true,
        }).on('changeYear', debounce(function() {
            table.ajax.reload();
        }, 100));
    })

    @role('admin')
        $(document).on('click', '#download-excell', function() {
            const year = $("#yearpicker").val();
            location.href = `{{ route('export-laporan') }}?year=${year}`;
        })
    @endrole
</script>
