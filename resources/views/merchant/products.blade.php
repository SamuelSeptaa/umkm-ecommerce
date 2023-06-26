@extends('layout.admin.index')
@section('content')
    <div class="card mb-4">
        <div class="card-header"><strong>{{ $title }}</strong></div>
        <div class="card-body">
            <div class="example">
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
