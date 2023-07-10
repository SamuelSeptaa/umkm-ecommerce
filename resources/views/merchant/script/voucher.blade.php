<script>
    $(document).ready(function() {
        var table = $("#the-table").DataTable({
            pageLength: 30,
            scrollX: true,
            processing: true,
            serverSide: true,
            order: [],
            ajax: {
                url: `{{ route('show-voucher') }}`,
                type: "POST",
                data: function(d) {
                    d.search = $("#search-column").val()
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            columns: [{
                    data: 'code',
                    name: 'code',
                    orderable: false,
                    searchable: true
                },
                {
                    data: 'discount',
                    name: 'discount',
                    orderable: true,
                    searchable: false
                },
                {
                    data: 'tanggal_berlaku',
                    name: 'tanggal_berlaku',
                    searchable: false,
                    orderable: false,
                },
                {
                    data: 'jumlah_penggunaan',
                    name: 'jumlah_penggunaan',
                    orderable: false,
                    searchable: false,
                    className: "text-center",
                }
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
    })
</script>
