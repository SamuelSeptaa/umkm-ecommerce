@extends('layout.admin.index')
@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center"><strong>{{ $title }}</strong></strong>
            @role('merchant')
                <a target="_blank" class="btn btn-sm btn-success ms-auto d-print-none"
                    href="{{ route('export-laporan-penjualan') }}">
                    <i class="fa-solid fa-file-csv"></i> Download Sheet
                </a>
            @endrole
            @role('admin')
                <button target="_blank" class="btn btn-sm btn-success ms-auto d-print-none" id="download-excell">
                    <i class="fa-solid fa-file-csv"></i> Download Sheet
                </button>
            @endrole
        </div>
        <div class="card-body">
            <div class="example">
                @role('admin')
                    <div class="row mb-3">
                        <div class="col-md-6 col-sm-12 row">
                            <label class="col-3 col-form-label" for="inputPassword">Tahun</label>
                            <div class="col-9">
                                <input class="form-control" id="yearpicker" type="text">
                            </div>
                        </div>

                    </div>
                @endrole
                <div class="tab-content rounded-bottom">
                    <div class="tab-pane p-3 active preview" role="tabpanel">
                        <table class="table table-striped" id="the-table" style="width:100%">
                            <thead>
                                <tr>
                                    @role('admin')
                                        <th>Nama Toko</th>
                                    @endrole
                                    <th>Tahun</th>
                                    <th>Januari</th>
                                    <th>Februari</th>
                                    <th>Maret</th>
                                    <th>April</th>
                                    <th>Mei</th>
                                    <th>Juni</th>
                                    <th>Juli</th>
                                    <th>Agustus</th>
                                    <th>September</th>
                                    <th>Oktober</th>
                                    <th>November</th>
                                    <th>Desember</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
