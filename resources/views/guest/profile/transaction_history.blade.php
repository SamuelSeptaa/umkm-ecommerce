<div class="shoping__cart__table">
    <table>
        <thead>
            <tr>
                <th>Nomor Invoice</th>
                <th>Total</th>
                <th>Jumlah Produk</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $t)
                <tr>
                    <td>
                        <h5>{{ $t->receipt_number }}</h5>
                    </td>
                    <td class="shoping__cart__price">
                        {{ currencyIDR($t->total) }}
                    </td>
                    <td class="">
                        <div class="quantity">
                            <div class="pro-qty">
                                <input type="text" value="{{ $t->total_products }}" disabled>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span
                            class="badge {{ in_array($t->status, ['PAYMENT', 'PROCESSING']) ? 'badge-warning' : 'badge-success' }}">
                            {{ $t->status }}
                        </span>

                    </td>
                    <td>
                        <a class="btn btn-primary rounded"
                            href="{{ route('transaction-history-detail', ['receipt_number' => $t->receipt_number]) }}">Detail</a>
                    </td>
                </tr>
            @endforeach


        </tbody>
    </table>
</div>
