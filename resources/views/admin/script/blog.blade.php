<script>
    function deleteBlog(id) {
        Swal.fire({
            icon: "question",
            title: `Hapus blog?`,
            text: `Proses ini tidak dapat diurungkan`,
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
                    url: "{{ route('delete-blog') }}",
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
                            title: `${response.status}`,
                            text: `${response.message}`,
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
        let filterValue = [];
        var table = $("#the-table").DataTable({
            pageLength: 30,
            scrollX: true,
            processing: true,
            serverSide: true,
            order: [],
            ajax: {
                url: `{{ route('show-blogs') }}`,
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
                },
                {
                    data: 'image_url',
                    name: 'image_url',
                    orderable: false,
                },
                {
                    data: 'title',
                    name: 'title',
                    orderable: true,
                },
                {
                    data: 'info',
                    name: 'info',
                    orderable: false,
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
    })
</script>
