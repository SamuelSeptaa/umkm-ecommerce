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
                    <div class="col-md-6 col-sm-12">
                        <div class="float-right">
                            <a href="{{ route('add-product') }}" class="btn btn-info">Tambah Produk</a>
                        </div>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="filter-list mb-2">
                        <button type="button" class="btn btn-outline-primary mr-1 my-1 btn-sm btn-filter"
                            data-status="ALL">Semua</button>
                        @foreach ($status as $s)
                            <button type="button" class="btn btn-outline-primary mr-1 my-1 btn-sm btn-filter"
                                data-status="{{ $s }}"><b>{{ $s }}</b></button>
                        @endforeach
                    </div>
                </div>
                <div class="tab-content rounded-bottom">
                    <div class="tab-pane p-3 active preview" role="tabpanel">
                        <table class="table table-striped" id="the-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Gambar Produk</th>
                                    <th>Nama Produk</th>
                                    <th>Harga Produk</th>
                                    <th>Diskon</th>
                                    <th>Stok</th>
                                    <th>Total Terjual</th>
                                    <th>Status</th>
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
