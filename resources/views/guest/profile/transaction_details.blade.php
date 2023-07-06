<div class="row">
    <div class="col-lg-6 col-md-6">
        <div class="form-group">
            <p>Nama Penerima<span>*</span></p>
            <input type="text" disabled name="name" class="form-control mb-0" placeholder="Nama Lengkap"
                value="{{ $transaction->name }}" autocomplete="off">
            <div class="invalid-feedback" for="name"></div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <p>Phone<span>*</span></p>
                    <input type="text" disabled name="phone" class="form-control mb-0"
                        placeholder="Nomor Handphone" value="{{ $transaction->phone }}" autocomplete="off">
                    <div class="invalid-feedback" for="phone"></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <p>Email<span>*</span></p>
                    <input type="text" disabled name="email" class="form-control mb-0 " placeholder="Email"
                        value="{{ $transaction->email }}" autocomplete="off">
                    <div class="invalid-feedback" for="email"></div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <p>Alamat<span>*</span></p>
            <textarea class="form-control mb-0 " disabled name="address" id="address" rows="3" placeholder="Alamat Lengkap">{{ $transaction->address }}</textarea>
            <div class="invalid-feedback" for="address"></div>
        </div>
        <div class="form-group"">
            <p>Metode Pengiriman<span>*</span></p>
            <input type="text" disabled name="shipping_method" class="form-control mb-0 "
                placeholder="Method Shipping"
                value="{{ "$transaction->shipping_method - $transaction->shipping_type" }}" autocomplete="off">
        </div>
        <div class="form-group row">
            <div class="col-lg-6">
                <p>Status Pesanan<span>*</span></p>
                <span
                    class="badge {{ in_array($transaction->status, ['PAYMENT', 'PROCESSING']) ? 'badge-warning' : 'badge-success' }}">
                    {{ $transaction->status }}
                </span>
            </div>
            <div class="col-lg-6">
                <p>Status Pembayaran<span>*</span></p>
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
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="checkout__order">
            <h4>Pesanan Kamu</h4>
            <div class="checkout__order__products">Produk <span>Total</span></div>
            <ul>
                @foreach ($transaction_details as $d)
                    <li>{{ $d->product->product_name . ' x ' . $d->qty }} <span>
                            {{ $d->product->discount > 0
                                ? currencyIDR($d->product->price - ($d->product->price * $d->product->discount) / 100) * $d->qty
                                : currencyIDR($d->product->price * $d->qty) }}</span>
                    </li>
                @endforeach
            </ul>

            <div class="checkout__order__subtotal">Subtotal <span>{{ currencyIDR($transaction->sub_total) }}</span>
            </div>
            <div class="checkout__order__shipping">Ongkir <span>{{ currencyIDR($transaction->shipping_fee) }}</span>
            </div>
            <div class="checkout__order__shipping">Diskon Kupon
                <span>{{ currencyIDR($transaction->voucher_discount) }}</span>
            </div>
            <div class="checkout__order__total">Total <span>{{ currencyIDR($transaction->total) }}</span></div>
            <div class="checkout__order__total payment-method">
                <div class="mb-2">Metode Pembayaran</div>
                <div class="row align-items-center">
                    <div class="col-4">
                        <div class="px-3 icon-payment-container row align-items-center">
                            <img src="{{ asset('storage/' . $payment_method->icon_url) }}"
                                alt="{{ $transaction->payment_channel }}">
                        </div>
                    </div>
                </div>
            </div>
            @if ($transaction->payment_status === 'PENDING')
                <div class="text-center">
                    <a href="{{ $transaction->payment_url }}" class="site-btn">Bayar Sekarang</a>
                </div>
            @endif
        </div>
    </div>
</div>
