<!DOCTYPE html>
<html>

<head>
    <style>
        html * {
            font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif !important;
        }

        h2 {
            color: #1a5276;
            background-color: #7fad39;
            text-align: center;
            padding: 6px;
        }

        thead {
            display: table-header-group;
        }

        #products {
            font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #products td,
        #products th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #products tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #products tr:hover {
            background-color: #ddd;
        }

        #products th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #a569bd;
            color: white;
        }

        .d-flex-center {
            display: flex;
            align-items: center;
        }
    </style>
</head>

<body>
    <h2>Laporan Perpajakan Tahun {{ $tahun }}</h2>
    <div>
        <p>Dicetak Pada {{ date('Y-m-d H:i:s') }}</p>
    </div>
    <div>
        <b>{{ $shop->shop_name }}</b><br>
        <p>{{ $shop->address }}</p>
    </div>
    <table id='products'>
        <thead>
            <th style="width: 5%">No.</th>
            <th style="width: 55%">Bulan</th>
            <th style="width: 20%">Omset Bruto</th>
            <th style="width: 20%">Pembayaran PPH Final (0.5%)</th>
        </thead>
        <tbody>
            @php
                $i = 0;
                $total_pendapatan = 0;
                $total_pph = 0;
            @endphp
            @foreach ($data_pajak as $d)
                @php
                    $i++;
                    $total_pendapatan += $d->jumlah_pendapatan;
                    $total_pph += $d->pph;
                @endphp
                <tr>
                    <td style="text-align: center">{{ $i }}</td>
                    <td>{{ $d->month_name }}</td>
                    <td>{{ currencyIDR($d->jumlah_pendapatan) }}</td>
                    <td>{{ currencyIDR($d->pph) }}</td>
                </tr>
            @endforeach
            <tr>
                <th colspan="2" style="text-align: center">Jumlah</th>
                <th>{{ currencyIDR($total_pendapatan) }}</th>
                <th>{{ currencyIDR($total_pph) }}</th>
            </tr>
        </tbody>
    </table>
</body>

</html>
