<script>
    function resetPassword(id) {
        Swal.fire({
            icon: "question",
            title: `Reset Password user ini?`,
            text: 'Proses ini tidak dapat diurungkan',
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
                    url: "{{ route('reset-password-admin') }}",
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
                    error: function(jqXHR, status, error) {
                        Swal.fire(
                            status,
                            jqXHR.responseJSON.message,
                            'error'
                        );
                    },
                });
            }
        });
    }

    $(document).ready(function() {
        let filterValue = [];

        var table = $("#the-table").DataTable({
            pageLength: 30,
            scrollX: true,
            processing: true,
            serverSide: true,
            order: [],
            ajax: {
                url: `{{ route('show-admin-list') }}`,
                type: "POST",
                data: function(d) {
                    // d.filterValue = JSON.stringify(filterValue)
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
                    data: 'name',
                    name: 'name',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'email',
                    name: 'email',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'tipe_admin',
                    name: 'tipe_admin',
                    orderable: false,
                    searchable: false
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
