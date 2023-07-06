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
                                        <label class="col-3 col-form-label" for="shipping_method">Kurir</label>
                                        <div class="col-9">
                                            <input class="form-control" disabled id="shipping_method" type="text"
                                                value="{{ strtoupper($transaction->shipping_method) }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label" for="total_products">Jumlah Produk</label>
                                        <div class="col-9">
                                            <input class="form-control" disabled id="total_products" type="text"
                                                value="{{ $transaction->total_products }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
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
                                    <h6 class="mb-3">From:</h6>
                                    <div><strong>Your Great Company Inc.</strong></div>
                                    <div>724 John Ave.</div>
                                    <div>Cupertino, CA 95014</div>
                                    <div>Email: email@your-great-company.com</div>
                                    <div>Phone: +1 123-456-7890</div>
                                </div>
                                <!-- /.col-->
                                <div class="col-sm-4">
                                    <h6 class="mb-3">To:</h6>
                                    <div><strong>Acme Inc.</strong></div>
                                    <div>159 Manor Station Road</div>
                                    <div>San Diego, CA 92154</div>
                                    <div>Email: email@acme.com</div>
                                    <div>Phone: +1 123-456-7890</div>
                                </div>
                                <!-- /.col-->
                                <div class="col-sm-4">
                                    <h6 class="mb-3">Details:</h6>
                                    <div>Invoice<strong>#90-98792</strong></div>
                                    <div>March 30, 2020</div>
                                    <div>VAT: EU9877281777</div>
                                    <div>Account Name: ACME</div>
                                    <div><strong>SWIFT code: 99 8888 7777 6666 5555</strong></div>
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
                                            <th>Description</th>
                                            <th class="center">Quantity</th>
                                            <th class="right">Unit Cost</th>
                                            <th class="right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="center">1</td>
                                            <td class="left">Origin License</td>
                                            <td class="left">Extended License</td>
                                            <td class="center">1</td>
                                            <td class="right">$999,00</td>
                                            <td class="right">$999,00</td>
                                        </tr>
                                        <tr>
                                            <td class="center">2</td>
                                            <td class="left">Custom Services</td>
                                            <td class="left">Instalation and Customization (cost per hour)</td>
                                            <td class="center">20</td>
                                            <td class="right">$150,00</td>
                                            <td class="right">$3.000,00</td>
                                        </tr>
                                        <tr>
                                            <td class="center">3</td>
                                            <td class="left">Hosting</td>
                                            <td class="left">1 year subcription</td>
                                            <td class="center">1</td>
                                            <td class="right">$499,00</td>
                                            <td class="right">$499,00</td>
                                        </tr>
                                        <tr>
                                            <td class="center">4</td>
                                            <td class="left">Platinum Support</td>
                                            <td class="left">1 year subcription 24/7</td>
                                            <td class="center">1</td>
                                            <td class="right">$3.999,00</td>
                                            <td class="right">$3.999,00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-sm-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                    veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
                                    eu fugiat nulla pariatur.</div>
                                <div class="col-lg-4 col-sm-5 ms-auto">
                                    <table class="table table-clear">
                                        <tbody>
                                            <tr>
                                                <td class="left"><strong>Subtotal</strong></td>
                                                <td class="right">$8.497,00</td>
                                            </tr>
                                            <tr>
                                                <td class="left"><strong>Discount (20%)</strong></td>
                                                <td class="right">$1,699,40</td>
                                            </tr>
                                            <tr>
                                                <td class="left"><strong>VAT (10%)</strong></td>
                                                <td class="right">$679,76</td>
                                            </tr>
                                            <tr>
                                                <td class="left"><strong>Total</strong></td>
                                                <td class="right"><strong>$7.477,36</strong></td>
                                            </tr>
                                        </tbody>
                                    </table><a class="btn btn-success" href="#">
                                        <svg class="icon">
                                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-dollar"></use>
                                        </svg> Proceed to Payment</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
