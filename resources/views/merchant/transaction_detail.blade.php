@extends('layout.admin.index')
@section('content')
    <div class="card mb-4">
        <div class="card-header"><strong>{{ $title }}</strong></div>
        <div class="card-body">
            <div class="tab-content rounded-bottom">
                <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-931">
                    <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="summary-tab" data-coreui-toggle="tab"
                                data-coreui-target="#summary" type="button" role="tab" aria-controls="summary"
                                aria-selected="true">Ringkasan Belanja</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="details-tab" data-coreui-toggle="tab" data-coreui-target="#details"
                                type="button" role="tab" aria-controls="details" aria-selected="false">Detail
                                Pembelian</button>
                        </li>
                        @if ($transaction->shipping_log->count() !== 0)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="shipping-log-tab" data-coreui-toggle="tab"
                                    data-coreui-target="#shipping-logs" type="button" role="tab"
                                    aria-controls="shipping-logs" aria-selected="false">Riwayat Pengiriman</button>
                            </li>
                        @endif

                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade active show" id="summary" role="tabpanel" aria-labelledby="summary-tab">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label" for="nomor-invoice">Nomor Invoice</label>
                                        <div class="col-9">
                                            <input class="form-control" disabled id="nomor-invoice" type="text"
                                                value="{{ $transaction->receipt_number }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label" for="name">Nama Penerima</label>
                                        <div class="col-9">
                                            <input class="form-control" disabled id="name" type="text"
                                                value="{{ $transaction->name }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label" for="email">Email Penerima</label>
                                        <div class="col-9">
                                            <input class="form-control" disabled id="email" type="text"
                                                value="{{ $transaction->email }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label" for="phone">Nomor HP</label>
                                        <div class="col-9">
                                            <input class="form-control" disabled id="phone" type="text"
                                                value="{{ $transaction->phone }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label" for="address">Alamat Pemesanan</label>
                                        <div class="col-9">
                                            <textarea class="form-control" disabled id="address">{{ $transaction->address }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label" for="location">Lokasi</label>
                                        <div class="col-9">
                                            <a target="_blank"
                                                href="{{ "https://www.google.com/maps/search/?api=1&query=$transaction->latitude%2C$transaction->longitude" }}"><i
                                                    class="fa-solid fa-up-right-from-square"></i> Maps</a>
                                        </div>
                                    </div>
                                    <div class="form-group align-items-center row">
                                        <label class="col-3 col-form-label" for="total_products">Status Pesanan</label>
                                        <div class="col-9">
                                            <span
                                                class="badge {{ in_array($transaction->status, ['PAYMENT', 'PROCESSING']) ? 'badge-warning' : 'badge-success' }}">
                                                {{ $transaction->status }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label" for="updated_at">Diperbarui Pada</label>
                                        <div class="col-9">
                                            <input class="form-control" disabled id="updated_at" type="text"
                                                value="{{ parseTanggal($transaction->updated_at) }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label" for="shipping_method">Kurir</label>
                                        <div class="col-9">
                                            <input class="form-control" disabled id="shipping_method" type="text"
                                                value="{{ strtoupper("$transaction->shipping_method - $transaction->shipping_type") }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label" for="waybill">waybill ID</label>
                                        <div class="col-9">
                                            <input class="form-control" disabled id="waybill" type="text"
                                                value="{{ $transaction->waybill }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label" for="total_products">Jumlah Produk</label>
                                        <div class="col-9">
                                            <input class="form-control" disabled id="total_products" type="text"
                                                value="{{ $transaction->total_products }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label" for="sub_total">Subtotal Belanja</label>
                                        <div class="col-9">
                                            <input class="form-control" disabled id="sub_total" type="text"
                                                value="{{ currencyIDR($transaction->sub_total) }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label" for="shipping_fee">Ongkos Kirim</label>
                                        <div class="col-9">
                                            <input class="form-control" disabled id="shipping_fee" type="text"
                                                value="{{ currencyIDR($transaction->shipping_fee) }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label" for="voucher_discount">Voucher Diskon</label>
                                        <div class="col-9">
                                            <input class="form-control" disabled id="voucher_discount" type="text"
                                                value="{{ currencyIDR($transaction->voucher_discount) . " - $transaction->code" }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label" for="total">Total</label>
                                        <div class="col-9">
                                            <input class="form-control" disabled id="total" type="text"
                                                value="{{ currencyIDR($transaction->total) }}">
                                        </div>
                                    </div>
                                    <div class="form-group align-items-center row">
                                        <label class="col-3 col-form-label" for="total">Status Bayar</label>
                                        <div class="col-9">
                                            @php
                                                $badge = 'badge-success';
                                            @endphp
                                            @if (in_array($transaction->payment_status, ['PENDING']))
                                                @php $badge = "badge-warning"; @endphp
                                            @elseif (in_array($transaction->payment_status, ['FAILED', 'EXPIRE']))
                                                @php $badge = "badge-danger"; @endphp
                                            @endif
                                            <span class="badge {{ $badge }}">
                                                {{ $transaction->payment_status }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label" for="paid_date">Tanggal Bayar</label>
                                        <div class="col-9">
                                            <input class="form-control" disabled id="paid_date" type="text"
                                                value="{{ parseTanggal($transaction->paid_date) }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label" for="paid_date">Metode Bayar</label>
                                        <div class="col-9">
                                            <img src="{{ asset('storage/' . $transaction->icon_url) }}" width="80"
                                                alt="{{ $transaction->payment_channel }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
                            <div class="row mb-4">
                                <div class="col-sm-4">
                                    <h6 class="mb-3">Dari:</h6>
                                    <div><strong>{{ $shop->shop_name }}</strong></div>
                                    <div>{{ $shop->address }}</div>
                                    <div>Email: {{ $shop->user->email }}</div>
                                </div>
                                <!-- /.col-->
                                <div class="col-sm-4">
                                    <h6 class="mb-3">Kepada:</h6>
                                    <div><strong>{{ $transaction->name }}</strong></div>
                                    <div>{{ $transaction->address }}</div>
                                    <div>Email: {{ $transaction->email }}</div>
                                    <div>Phone: {{ $transaction->phone }}</div>
                                </div>
                                <!-- /.col-->
                                <div class="col-sm-4">
                                    <h6 class="mb-3">Detail:</h6>
                                    <div>Invoice #<strong>{{ $transaction->receipt_number }}</strong></div>
                                    <div>{{ parseTanggal($transaction->created_at) }}</div>
                                </div>
                                <!-- /.col-->
                            </div>
                            <!-- /.row-->
                            <div class="table-responsive-sm">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="center">#</th>
                                            <th>Item</th>
                                            <th class="center">Jumlah</th>
                                            <th class="right">Harga</th>
                                            <th class="right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($transaction->transaction_detail as $td)
                                            @php
                                                $i++;
                                            @endphp
                                            <tr>
                                                <td class="center">{{ $i }}</td>
                                                <td class="left">{{ $td->product_name }}</td>
                                                <td class="center">{{ $td->qty }}</td>
                                                <td class="right">{{ currencyIDR($td->price) }}</td>
                                                <td class="right">{{ currencyIDR($td->sub_total) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-sm-5">Receipt ini merupakan receipt yang sah</div>
                                <div class="col-lg-6 col-sm-5 ms-auto">
                                    <table class="table table-clear">
                                        <tbody>
                                            <tr>
                                                <td class="left"><strong>Subtotal</strong></td>
                                                <td class="right">{{ currencyIDR($transaction->sub_total) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="left"><strong>Diskon</strong></td>
                                                <td class="right">{{ currencyIDR($transaction->voucher_discount) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="left"><strong>Ongkos Kirim
                                                        ({{ strtoupper("$transaction->shipping_method - $transaction->shipping_type") }})</strong>
                                                </td>
                                                <td class="right">{{ currencyIDR($transaction->shipping_fee) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="left"><strong>Total</strong></td>
                                                <td class="right"><strong>{{ currencyIDR($transaction->total) }}</strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    @role('merchant')
                                        @if (in_array($transaction->status, ['PROCESSING']))
                                            <btn class="btn btn-warning" id="request-pickup">
                                                <i class="fa-solid fa-truck-pickup"></i> Request Pick Up Barang
                                            </btn>
                                        @endif
                                    @endrole
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="shipping-logs" role="tabpanel"
                            aria-labelledby="shipping-logs-tab">
                            <!-- /.row-->
                            <div class="table-responsive-sm">
                                <table class="table table-hover w-50">
                                    <thead>
                                        <tr>
                                            <th class="center">Nomor</th>
                                            <th class="center">Status</th>
                                            <th class="center">Deskripsi</th>
                                            <th>Waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($transaction->shipping_log as $sl)
                                            @php
                                                $i++;
                                            @endphp
                                            @php
                                                $badge = 'badge-success';
                                            @endphp
                                            @if (in_array($sl->status, ['REQUESTED']))
                                                @php $badge = "badge-primary"; @endphp
                                            @elseif (in_array($sl->status, ['CANCELLED']))
                                                @php $badge = "badge-danger"; @endphp
                                            @endif

                                            <tr>
                                                <td class="center">{{ $i }}</td>
                                                <td class="center">
                                                    <span class="badge {{ $badge }}">
                                                        {{ $sl->status }}
                                                    </span>
                                                </td>
                                                <td class="left">{{ $sl->description }}</td>
                                                <td class="left">{{ parseTanggal($sl->created_at) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
