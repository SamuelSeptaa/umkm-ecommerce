@extends('layout.admin.index')
@section('content')
    <div class="card mb-4">
        <div class="card-header"><strong>{{ $title }}</strong></div>
        <div class="card-body">
            <div class="example">
                <div class="row mb-3">
                    <div class="col-md-6 col-sm-12 row">
                        <label class="col-3 col-form-label" for="inputPassword">Cari</label>
                        <div class="col-9">
                            <input class="form-control" id="search-column" type="text">
                        </div>
                    </div>
                </div>
                <div class="tab-content rounded-bottom">
                    <div class="tab-pane p-3 active preview" role="tabpanel">
                        <table class="table table-striped" id="the-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nama Toko</th>
                                    <th>Kode Voucher</th>
                                    <th>Nominal Diskon</th>
                                    <th>Tanggal Berlaku</th>
                                    <th>Jumlah Penggunaan</th>
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
